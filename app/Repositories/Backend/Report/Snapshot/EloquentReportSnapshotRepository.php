<?php

namespace App\Repositories\Backend\Report\Snapshot;

use App\Exceptions\GeneralException;
use App\Models\Report\ReportSnapshot;
/**
 * Class EloquentReportSnapshotRepository
 * @package App\Repositories\Backend\Report\Snapshot
 */
class EloquentReportSnapshotRepository implements ReportSnapshotRepositoryContract
{
    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getSnapshotsPaginated($per_page, $order_by = 'snapshot_id', $sort = 'asc')
    {
        return ReportSnapshot::with('report')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withReport
     * @return mixed
     */
    public function getAllSnapshots($order_by = 'snapshot_id', $sort = 'asc', $withReport = false)
    {
        if ($withReport) {
            return ReportSnapshot::with('report')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return ReportSnapshot::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $snapshot = new ReportSnapshot;
        $snapshot->file_name = $input['file_name'];
        $snapshot->file_path = $input['file_path'];
        $snapshot->file_type = $input['file_type'];
        $snapshot->abstract = $input['abstract'];
        $snapshot->expiration_at = $input['expiration_at'];
        $snapshot->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $snapshot->client_ip = $input['client_ip'];
        if ($snapshot->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.report.snapshot.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $snapshot = $this->findOrThrowException($id);

        $snapshot->file_name = $input['file_name'];
        $snapshot->file_path = $input['file_path'];
        $snapshot->expiration_at = $input['expiration_at'];
        $snapshot->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $snapshot->client_ip = $input['client_ip'];
        if ($snapshot->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.snapshot.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withReport
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withReport = false)
    {
        if (!is_null(ReportSnapshot::find($id))) {
            if ($withReport) {
                return ReportSnapshot::with('report')
                    ->find($id);
            }

            return ReportSnapshot::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.snapshot.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {

        $snapshot = $this->findOrThrowException($id);
        if ($snapshot->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.snapshot.delete_error'));
    }

}
