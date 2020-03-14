<?php

namespace App\Repositories\Backend\Wxconfig;

use App\Exceptions\GeneralException;
use App\Models\Wxconfig\Wxconfig;
use Log;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentWxconfigRepository implements WxconfigRepositoryContract
{
    const TYPE_IMAGE = 'IMAGE';
    const TYPE_JPEG = 'JPEG';
    const TYPE_HTML = 'HTML';
    const TYPE_EXCEL = 'EXCEL';
    const TYPE_TEXT = 'TEXT';
    const TYPE_CSV = 'CSV';

    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getWxconfigsPaginated($per_page, $order_by = 'id', $sort = 'asc')
    {
        return Wxconfig::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  string $order_by
     * @param  string $sort
     * @param  bool $withParameters
     * @return mixed
     */
    public function getAllWxconfigs($order_by = 'id', $sort = 'asc')
    {
        return Wxconfig::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        if (Wxconfig::where('appid', $input['appid'])->first()) {
            throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.already_exists'));
        }

        $wxconfig = new Wxconfig;
        $wxconfig->name = $input['name'];
        $wxconfig->appid = $input['appid'];
        $wxconfig->appsecret = $input['appsecret'];
        $wxconfig->token = $input['token'];
//        $wxconfig->status = intval($input['status']);
        $wxconfig->aeskey = $input['aeskey'];
        $wxconfig->agentid = $input['agentid'];

        if ($wxconfig->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function update($id, $input)
    {
        $wxconfig = $this->findOrThrowException($id);
        $wxconfig->name = $input['name'];
        $wxconfig->appid = $input['appid'];
        $wxconfig->appsecret = $input['appsecret'];
        $wxconfig->token = $input['token'];
//        $wxconfig->status = intval($input['status']);
        $wxconfig->aeskey = $input['aeskey'];
        $wxconfig->agentid = $input['agentid'];

        $file = $wxconfig->file;   //获取旧的校验文件
        $wxconfig->file = $this->uploadFile($id, $input);

        //删除旧的校验文件
        @unlink(base_path() . DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$file);

        if ($wxconfig->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.update_error'));
    }

    /**
     * @param  $id
     * @param  bool $withParameters
     * @throws GeneralException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function findOrThrowException($id, $withParameters = false)
    {
        if (!is_null(Wxconfig::find($id))) {
            return Wxconfig::find($id);
        }

        if(!is_null(Wxconfig::where('status',1)->first()) && $id == 0){
            return Wxconfig::where('status',1)->first();
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.not_found'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {

        $wxconfig = $this->findOrThrowException($id);

        //Don't delete the role is there are users associated
//        if ($wxconfig->users()->count() > 0) {
//            throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.has_users'));
//        }

        if ($wxconfig->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfigs.delete_error'));
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {

        $wxconfig = $this->findOrThrowException($id);
        $wxconfig->status = $status;
        if(intval($status) == 1){
            Wxconfig::where('status',1)->update(array('status' => 0));
        }

        if ($wxconfig->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfig.mark'));
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function check($id)
    {

        $wxconfig = $this->findOrThrowException($id);
        app('weixin')->setWxconfig($wxconfig->id);

        $content = '和營運信息分發平台對接成功！';
        $result = app('weixin')->sendMsgToUser($content);
        if ($result['errmsg'] == 'ok' && $result['errcode'] == 0) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.wxconfig.wxconfig.check'));
    }

    public function uploadFile($id,$input)
    {
        $file = $input['file'];
        $clientName = $file->getClientOriginalName();
        $clientType = $file->getClientMimeType();
        $fileSize = $file->getSize() / 1024;

        if ($fileSize > 10000) {
            throw new GeneralException('上傳校驗文件失敗，文件不能大於10M', 30002);
        }

        switch ($clientType) {
            case 'text/plain':
                $filePath = base_path() . DIRECTORY_SEPARATOR.'public';
                $fileType = self::TYPE_TEXT;
                break;
            default:
                Log::info('上傳校驗文件：文件名稱[' . $clientName . ']、類型[' . $clientType . ']');
                throw new GeneralException('上傳校驗文件不支持此類型：' . $clientType , 30003);
        }

        $file->move($filePath, $clientName);

        Log::info('上傳報表文件成功：文件名稱[' . $clientName . ']、類型[' . $fileType . ']、存放路徑[' . $filePath . ']');
        return $clientName;
    }
}
