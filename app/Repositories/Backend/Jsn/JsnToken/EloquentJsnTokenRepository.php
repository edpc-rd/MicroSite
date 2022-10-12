<?php

namespace App\Repositories\Backend\Jsn\JsnToken;

use App\Exceptions\GeneralException;
use App\Models\Jsn\JsnToken;
use Log;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentJsnTokenRepository implements JsnTokenRepositoryContract
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
        $JsnToken = new JsnToken;
        $JsnToken->type = $input['type'];
        $JsnToken->token = json_encode($input);
        if ($JsnToken->save()) {
            return true;
        }
    }
}
