<?php

namespace App\Http\Requests\Backend\Report\Snapshot;

use App\Http\Requests\Request;

/**
 * Class CreateSnapshotRequest
 * @package App\Http\Requests\Backend\Report\Snapshot
 */
class CreateSnapshotRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-report-snapshot');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
