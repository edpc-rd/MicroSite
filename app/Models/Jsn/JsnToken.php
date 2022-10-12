<?php

namespace App\Models\Jsn;

use Illuminate\Database\Eloquent\Model;

class JsnToken extends Model
{

    protected $table = 'ms_platform_token';

    protected $guarded = ['id','created_at','updated_at'];

}
