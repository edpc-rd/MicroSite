<?php

namespace App\Repositories\Backend\Report\Parameter;

use App\Exceptions\GeneralException;
use App\Models\Report\ReportParameter;

/**
 * Class EloquentReportParameterRepository
 * @package App\Repositories\Backend\Report
 */
class EloquentReportParameterRepository implements ReportParameterRepositoryContract
{
    /**
     * @param  $per_page
     * @param  string $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getParametersPaginated($per_page, $order_by = 'parameter_id', $sort = 'asc')
    {
        return Role::with('report')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withReport
     * @return mixed
     */
    public function getAllParameters($order_by = 'parameter_id', $sort = 'asc', $withReport = false)
    {
        if ($withReport) {
            return ReportParameter::with('report')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return ReportParameter::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $parameter = new ReportParameter;
        $parameter->name = $input['name'];
        $parameter->display_name = $input['display_name'];
        $parameter->multi_value = isset($input['multi_value']) ? 'true' : 'false';
        $parameter->nullable = isset($input['nullable']) ? 'true' : 'false';
        $parameter->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $parameter->default_value = $input['default_value'];
        $parameter->data_type = $input['data_type'];

        if ($parameter->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.report.parameter.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $parameter = $this->findOrThrowException($id);
        $parameter->name = $input['name'];
        $parameter->display_name = $input['display_name'];
        $parameter->multi_value = isset($input['multi_value']) ? 'true' : 'false';
        $parameter->nullable = isset($input['nullable']) ? 'true' : 'false';
        $parameter->report_id = isset($input['report_id']) && strlen($input['report_id']) > 0 ? (int)$input['report_id'] : null;
        $parameter->default_value = $input['default_value'];
        $parameter->data_type = $input['data_type'];

        if ($parameter->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.parameter.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withReport
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withReport = false)
    {
        if (!is_null(ReportParameter::find($id))) {
            if ($withReport) {
                return ReportParameter::with('report')
                    ->find($id);
            }

            return ReportParameter::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.report.parameter.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        $parameter = $this->findOrThrowException($id);

        if ($parameter->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.report.parameter.delete_error'));
    }

}
