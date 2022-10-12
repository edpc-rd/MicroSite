<?php

namespace App\Repositories\Backend\Jsn;

use App\Exceptions\GeneralException;
use App\Models\Jsn\Jsn;
use Log;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentJsnRepository implements JsnRepositoryContract
{
    const TYPE_IMAGE = 'IMAGE';
    const TYPE_JPEG = 'JPEG';
    const TYPE_HTML = 'HTML';
    const TYPE_EXCEL = 'EXCEL';
    const TYPE_TEXT = 'TEXT';
    const TYPE_CSV = 'CSV';

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $Jsn = new Jsn;
        $Jsn->type = $input['type'];
        $Jsn->code = json_encode($input);
        if ($Jsn->save()) {
            return true;
        }
    }
}
