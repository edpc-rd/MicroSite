<?php

namespace App\Models\Wxconfig;

use App\Models\Wxconfig\Traits\Attribute\WxconfigAttribute;
use Illuminate\Database\Eloquent\Model;

class Wxconfig extends Model
{
    use WxconfigAttribute;

    protected $table = 'ms_wx_config';

    protected $guarded = ['id','created_at','updated_at'];

}
