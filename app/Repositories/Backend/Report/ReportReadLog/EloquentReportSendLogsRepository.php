<?php

namespace App\Repositories\Backend\Report\ReportReadLog;

use App\Exceptions\GeneralException;
use App\Models\Report\ReportReadLog;
use Stoneworld\Wechat\Utils\Http;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentReportReadLogRepository implements ReportReadLogRepositoryContract
{
    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getReportsPaginated($per_page, $order_by = 'id', $sort = 'desc')
    {
        return ReportReadLog::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllLogs($order_by = 'id', $sort = 'desc', $withParameters = false)
    {
        if ($withParameters) {
            return ReportReadLog::orderBy($order_by, $sort)
                ->get();
        }

        return ReportReadLog::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  integer $status
     * @param  string $sort
     * @return mixed
     */
    public function getLogsByStatus($per_page, $status = 1, $order_by = 'id', $sort = 'desc')
    {
        return ReportReadLog::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        return true;
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        return true;
    }

    /**
     * @param  $id
     * @param  bool $withParameters
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withParameters = false)
    {
        if (!is_null(ReportReadLog::find($id))) {
            if ($withParameters) {
                return ReportReadLog::find($id);
            }

            return ReportReadLog::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.report.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        return true;
    }

}
