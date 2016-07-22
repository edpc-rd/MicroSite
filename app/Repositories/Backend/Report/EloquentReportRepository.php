<?php

namespace App\Repositories\Backend\Report;

use App\Exceptions\GeneralException;
use App\Models\Report\Report;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentReportRepository implements ReportRepositoryContract
{
    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getReportsPaginated($per_page, $order_by = ['group', 'report_no'], $sort = 'asc')
    {
        return Report::with('group')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllReports($order_by = 'sort_order', $sort = 'asc', $withParameters = false)
    {
        if ($withParameters) {
            return Report::with('parameters')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return Report::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        if (Report::where('report_no', $input['report_no'])->first()) {
            throw new GeneralException(trans('exceptions.backend.report.report.already_exists'));
        }

        $report = new Report;
        $report->report_no = $input['report_no'];
        $report->name = $input['name'];
        $report->format = $input['format'];
        $report->allow_subscribe = $input['allow_subscribe'];
        $report->allow_query = $input['allow_query'];
        $report->group_id = isset($input['group_id']) && strlen($input['group_id']) > 0 ? (int)$input['group_id'] : null;
        $report->schedule = $input['schedule'];
        $report->status = $input['status'];
        $report->receive_mode = $input['receive_mode'];
        $report->query_url = $input['query_url'];
        $report->description = $input['description'];

        if ($report->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.report.report.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $report = $this->findOrThrowException($id);

        $report->name = $input['name'];
        $report->format = $input['format'];
        $report->report_no = $input['report_no'];
        $report->allow_subscribe = $input['allow_subscribe'];
        $report->allow_query = $input['allow_query'];
        $report->group_id = isset($input['group_id']) && strlen($input['group_id']) > 0 ? (int)$input['group_id'] : null;
        $report->schedule = $input['schedule'];
        $report->status = $input['status'];
        $report->receive_mode = $input['receive_mode'];
        $report->query_url = $input['query_url'];
        $report->description = $input['description'];

        if ($report->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.report.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withParameters
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withParameters = false)
    {
        if (!is_null(Report::find($id))) {
            if ($withParameters) {
                return Report::with('parameters')
                    ->find($id);
            }

            return Report::find($id);
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

        $report = $this->findOrThrowException($id);

        //Don't delete the role is there are users associated
        if ($report->users()->count() > 0) {
            throw new GeneralException(trans('exceptions.backend.report.report.has_users'));
        }

        if ($report->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.report.delete_error'));
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {

        $report = $this->findOrThrowException($id);
        $report->status = $status;

        if ($report->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.report.mark'));
    }

}
