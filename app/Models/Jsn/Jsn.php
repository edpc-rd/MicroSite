<?php

namespace App\Models\Jsn;

use App\Models\Jsn\Traits\Attribute\JsnAttribute;
use Illuminate\Database\Eloquent\Model;

class Jsn extends Model
{
    use JsnAttribute;

    protected $table = 'ms_platform_code';

    protected $guarded = ['id','created_at','updated_at'];

}
