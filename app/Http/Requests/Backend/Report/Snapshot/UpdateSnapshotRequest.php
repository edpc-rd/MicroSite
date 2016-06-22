<?php

namespace App\Http\Requests\Backend\Report\Snapshot;

use App\Http\Requests\Request;

/**
 * Class UpdateSnapshotRequest
 * @package App\Http\Requests\Backend\Report\Snapshot
 */
class UpdateSnapshotRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-report-snapshot');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expiration_at' => 'date',
            'file_name' => 'string|max:50',
            'file_path' => 'string|max:200',
            'file_type' => 'required|string|max:10',
            'status' => 'required|integer',
            'abstract' => 'string|max:200',
            'client_ip' => 'string|max:50',
        ];
    }
}
