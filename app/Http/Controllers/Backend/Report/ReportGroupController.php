<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Report\Group\CreateReportGroupRequest;
use App\Http\Requests\Backend\Report\Group\DeleteReportGroupRequest;
use App\Http\Requests\Backend\Report\Group\EditReportGroupRequest;
use App\Http\Requests\Backend\Report\Group\StoreReportGroupRequest;
use App\Http\Requests\Backend\Report\Group\UpdateReportGroupRequest;
use App\Http\Requests\Backend\Report\Group\SortReportGroupRequest;
use App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;


/**
 * Class ReportController
 */
class ReportGroupController extends Controller
{

    /**
     * @var ReportGroupRepositoryContract
     */
    protected $groups;

    /**
     * @var ReportRepositoryContract
     */
    protected $reports;

    /**
     * @param ReportGroupRepositoryContract $groups
     * @param ReportRepositoryContract $reports
     */
    public function __construct(ReportGroupRepositoryContract $groups,ReportRepositoryContract $reports)
    {
        $this->groups = $groups;
        $this->reports = $reports;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.report.groups.index')
            ->withGroups($this->groups->getAllGroups());
    }

    /**
     * @param  CreateReportGroupRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateReportGroupRequest $request)
    {
        return view('backend.report.groups.create');
    }

    /**
     * @param  StoreReportGroupRequest $request
     * @return mixed
     */
    public function store(StoreReportGroupRequest $request)
    {
        $this->groups->store($request->all());
        return redirect()->route('admin.report.groups.index')->withFlashSuccess(trans('alerts.backend.groups.created'));
    }

    /**
     * @param  $id
     * @param  EditReportGroupRequest $request
     * @return mixed
     */
    public function edit($id, EditReportGroupRequest $request)
    {
        return view('backend.report.groups.edit')
            ->withGroup($this->groups->find($id));
    }

    /**
     * @param  $id
     * @param  UpdateReportGroupRequest $request
     * @return mixed
     */
    public function update($id, UpdateReportGroupRequest $request)
    {
        $this->groups->update($id, $request->all());
        return redirect()->route('admin.report.groups.index')->withFlashSuccess(trans('alerts.backend.groups.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteReportGroupRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteReportGroupRequest $request)
    {
        $this->groups->destroy($id);
        return redirect()->route('admin.report.groups.index')->withFlashSuccess(trans('alerts.backend.groups.deleted'));
    }

    /**
     * @param  SortReportGroupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSort(SortReportGroupRequest $request)
    {
        $this->groups->updateSort($request->get('data'));
        return response()->json(['status' => 'OK']);
    }
}