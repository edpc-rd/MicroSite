<?php

namespace App\Repositories\Backend\Wxconfig;

use App\Exceptions\GeneralException;
use App\Models\Wxconfig\Wxconfig;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentWxconfigRepository implements WxconfigRepositoryContract
{
    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getWxconfigsPaginated($per_page, $order_by = 'id', $sort = 'asc')
    {
        return Wxconfig::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllWxconfigs($order_by = 'id', $sort = 'asc')
    {
        return Wxconfig::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        if (Wxconfig::where('appid', $input['appid'])->first()) {
            throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.already_exists'));
        }

        $wxconfig = new Wxconfig;
        $wxconfig->name = $input['name'];
        $wxconfig->appid = $input['appid'];
        $wxconfig->appsecret = $input['appsecret'];
        $wxconfig->token = $input['token'];
//        $wxconfig->status = intval($input['status']);
        $wxconfig->aeskey = $input['aeskey'];
        $wxconfig->agentid = $input['agentid'];

        if ($wxconfig->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $wxconfig = $this->findOrThrowException($id);
        $wxconfig->name = $input['name'];
        $wxconfig->appid = $input['appid'];
        $wxconfig->appsecret = $input['appsecret'];
        $wxconfig->token = $input['token'];
//        $wxconfig->status = intval($input['status']);
        $wxconfig->aeskey = $input['aeskey'];
        $wxconfig->agentid = $input['agentid'];

        if ($wxconfig->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withParameters
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withParameters = false)
    {
        if (!is_null(Wxconfig::find($id))) {
            return Wxconfig::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {

        $wxconfig = $this->findOrThrowException($id);

        //Don't delete the role is there are users associated
//        if ($wxconfig->users()->count() > 0) {
//            throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.has_users'));
//        }

        if ($wxconfig->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.delete_error'));
    }
}
