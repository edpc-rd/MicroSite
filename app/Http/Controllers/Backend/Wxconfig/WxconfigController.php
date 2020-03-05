<?php

namespace App\Http\Controllers\Backend\Wxconfig;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Wxconfig\CreateWxconfigRequest;
use App\Http\Requests\Backend\Wxconfig\DeleteWxconfigRequest;
use App\Http\Requests\Backend\Wxconfig\EditWxconfigRequest;
use App\Http\Requests\Backend\Wxconfig\MarkWxconfigRequest;
use App\Http\Requests\Backend\Wxconfig\UpdateWxconfigRequest;
use App\Http\Requests\Backend\Wxconfig\StoreWxconfigRequest;
use App\Repositories\Backend\Wxconfig\WxconfigRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use View;

/**
 * Class WxconfigController
 */
class WxconfigController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var WxconfigParameterRepositoryContract
     */
    protected $parameters;

    /**
     * @var WxconfigRepositoryContract
     */
    protected $wxconfigs;

    /**
     * @param UserContract $users
     * @param WxconfigRepositoryContract $wxconfig
     */
    public function __construct(
        UserContract $users,
        WxconfigRepositoryContract $wxconfig

    )
    {
        $this->users = $users;
        $this->wxconfigs = $wxconfig;
    }

    /**
     * @return mixed
     */
    public function index()
    {
//        var_dump($this->wxconfigs->getWxconfigsPaginated(50));die;
        return view('backend.wxconfig.wxconfigs.index')
            ->withWxconfigs($this->wxconfigs->getWxconfigsPaginated(50));
    }

    /**
     * @param  CreateWxconfigRequest $request
     * @return mixed
     */
    public function create(CreateWxconfigRequest $request)
    {
        return view('backend.wxconfig.wxconfigs.create');
    }

    /**
     * @param  StoreWxconfigRequest $request
     * @return mixed
     */
    public function store(StoreWxconfigRequest $request)
    {
        $this->wxconfigs->create($request->all());
        return redirect()->route('admin.wxconfig.wxconfigs.index')->
        withFlashSuccess(trans('alerts.backend.wxconfigs.created'));
    }

    /**
     * @param  $id
     * @param  $status
     * @param  MarkReportRequest $request
     * @return mixed
     */
    public function mark($id, $status, MarkWxconfigRequest $request)
    {
        $this->wxconfigs->mark($id, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.wxconfigs.updated'));
    }

    /**
     * @param  $id
     * @param  EditWxconfigRequest $request
     * @return mixed
     */
    public function edit($id, EditWxconfigRequest $request)
    {
        $wxconfig = $this->wxconfigs->findOrThrowException($id, true);
        return view('backend.wxconfig.wxconfigs.edit')
            ->withWxconfig($wxconfig);
    }

    /**
     * @param  $id
     * @param  UpdateWxconfigRequest $request
     * @return mixed
     */
    public function update($id, UpdateWxconfigRequest $request)
    {
        $this->wxconfigs->update($id, $request->all());
        return redirect()->route('admin.wxconfig.wxconfigs.index')->withFlashSuccess(trans('alerts.backend.wxconfigs.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteWxconfigRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteWxconfigRequest $request)
    {
        $this->wxconfigs->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.wxconfigs.deleted_permanently'));
    }

    /**
     * @param string $fileName
     * @return mixed
     */
    public function viewHtmlWxconfig($fileName)
    {
        View::addExtension('html', 'php');
        return view($fileName);
    }

    public  function viewImageWxconfig($fileName)
    {
        View::addExtension('jpeg','php');
        return view($fileName);
    }
}