<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wxconfig extends Model
{
    protected $table = 'ms_wx_config';

    protected $guarded = ['id','created_at','updated_at'];

}
