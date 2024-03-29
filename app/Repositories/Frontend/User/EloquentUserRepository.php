<?php

namespace App\Repositories\Frontend\User;

use App\Exceptions\GeneralException;
use App\Models\Access\User\SocialLogin;
use App\Models\Access\User\User;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\Frontend\User
 */
class EloquentUserRepository implements UserContract
{

    /**
     * @var RoleRepositoryContract
     */
    protected $role;

    /**
     * @param RoleRepositoryContract $role
     */
    public function __construct(RoleRepositoryContract $role)
    {
        $this->role = $role;
    }

    /**
     * @param $data
     * @param $provider
     * @return EloquentUserRepository
     */
    public function findOrCreateSocial($data, $provider)
    {
        /**
         * Check to see if there is a user with this email first
         */
        $user = $this->findByEmail($data->email);

        /**
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (!$user) {
            $user = $this->create([
                'user_name' => $data->name,
                'email' => $data->email,
            ], true);
        }

        /**
         * See if the user has logged in with this social account before
         */
        if (!$user->hasProvider($provider)) {
            /**
             * Gather the provider data for saving and associate it with the user
             */
            $user->providers()->save(new SocialLogin([
                'provider' => $provider,
                'provider_id' => $data->id,
            ]));
        }

        /**
         * Return the user object
         */
        return $user;
    }

    /**
     * @param $email
     * @return bool
     */
    public function findByEmail($email) {
        $user = User::where('email', $email)->first();

        if ($user instanceof User)
            return $user;

        return false;
    }

    /**
     * @param array $data
     * @param bool $provider
     * @return static
     */
    public function create(array $data, $provider = false)
    {
        if ($provider) {
            $user = User::create([
                'user_name' => $data['user_name'],
                'user_nick' => $data['user_nick'],
                'email' => $data['email'],
                'weixin_id' => $data['weixin_id'],
                'password' => null,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => 1,
                'status' => 1,
                'login_ip' => $_SERVER["REMOTE_ADDR"],
            ]);
        } else {
            $user = User::create([
                'user_name' => $data['user_name'],
                'user_nick' => $data['user_nick'],
                'email' => $data['email'],
                'weixin_id' => $data['weixin_id'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => config('access.users.confirm_email') ? 0 : 1,
                'status' => 1,
                'login_ip' => $_SERVER["REMOTE_ADDR"],
            ]);
        }

        /**
         * Add the default site role to the new user
         */
        $user->attachRole($this->role->getDefaultUserRole());

        /**
         * If users have to confirm their email and this is not a social account,
         * send the confirmation email
         *
         * If this is a social account they are confirmed through the social provider by default
         */
        if (config('access.users.confirm_email') && $provider === false) {
            $this->sendConfirmationEmail($user);
        }

        /**
         * Return the user object
         */
        return $user;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user)
    {
        //$user can be user instance or id
        if (!$user instanceof User) {
            $user = $this->find($user);
        }

        return Mail::send('frontend.auth.emails.confirm', ['token' => $user->confirmation_code], function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('exceptions.frontend.auth.confirmation.confirm'));
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param $token
     * @return bool
     * @throws GeneralException
     */
    public function confirmAccount($token)
    {
        $user = $this->findByToken($token);

        if ($user->confirmed == 1) {
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code == $token) {
            $user->confirmed = 1;
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.confirmation.mismatch'));
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function findByToken($token)
    {
        $user = User::where('confirmation_code', $token)->first();

        if (!$user instanceof User)
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.not_found'));

        return $user;
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function resendConfirmationEmail($token) {
        return $this->sendConfirmationEmail($this->findByToken($token));
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function updateProfile($id, $input)
    {
        $user = $this->find($id);
        $user->user_nick = $input['user_nick'];

        if ($user->canChangeEmail()) {
            //Address is not current address
            if ($user->email != $input['email']) {
                //Emails have to be unique
                if ($this->findByEmail($input['email'])) {
                    throw new GeneralException(trans('exceptions.frontend.auth.email_taken'));
                }

                $user->email = $input['email'];
            }
        }

        return $user->save();
    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function changePassword($input)
    {
        $user = $this->find(access()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.password.change_mismatch'));
    }
    
    /**
     * @param $name
     * @return bool
     */
    public function findByName($name) {
        $user = User::where('user_name', $name)->first();

        if ($user instanceof User)
            return $user;

        return false;
    }


}