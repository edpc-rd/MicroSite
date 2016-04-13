<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.users_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.users_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.users_table') . ' CASCADE');
        }

        //Add the master administrator, user id of 1
        $users = [
            [
                'user_name' => 'Admin Istrator',
                'user_nick' => 'LinHuiMin',
                'weixin_id' => '18318900010',
                'email'             => 'lam.waiman@qq.com',
                'password'          => bcrypt('edpcrd_admin'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'login_at' => Carbon::now(),
                'login_ip' => 'Localhost',
                'remark' => 'AdminIstrator',
            ],
            [
                'user_name' => 'User',
                'user_nick' => 'LamWaiMan',
                'weixin_id' => '18300082013',
                'email'             => 'linhuimin@glorisun.com',
                'password'          => bcrypt('edpcrd_user'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'login_at' => Carbon::now(),
                'login_ip' => 'Localhost',
                'remark' => 'User',
            ],
        ];

        DB::table(config('access.users_table'))->insert($users);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}