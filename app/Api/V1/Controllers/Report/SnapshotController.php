<?php

namespace App\Api\V1\Controllers\Report;

use App\Api\V1\Controllers\BaseController;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Stoneworld\Wechat\Exception;
use Log;
/**
 * Class SnapshotController
 */
class SnapshotController extends BaseController
{
    const TYPE_IMAGE = 'IMAGE';
    const TYPE_JPEG = 'JPEG';
    const TYPE_HTML = 'HTML';
    const TYPE_EXCEL = 'EXCEL';
    const TYPE_TEXT = 'TEXT';
    const TYPE_CSV = 'CSV';
    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var ReportSnapshotRepositoryContract
     */
    protected $snapshots;

    /**
     * @var ReportRepositoryContract
     */
    protected $reports;

    /**
     * @param UserContract $users
     * @param ReportSnapshotRepositoryContract $snapshots
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserContract $users,
        ReportSnapshotRepositoryContract $snapshots,
        ReportRepositoryContract $reports
    )
    {
        $this->users = $users;
        $this->snapshots = $snapshots;
        $this->reports = $reports;
    }

    public function uploadFile(Request $request)
    {
        try {
            $report = $this->reports->findOrThrowException($request->get('report_id'));
        } catch (\Exception $e) {
            throw new Exception('獲取報表失敗，請檢查report_id是否正確', 30001);
        }

        $file = $request->File('file');
        $abstract = $request->get('abstract');
        $clientIP = $request->getClientIp();
        $clientName = $file->getClientOriginalName();
        $clientType = $file->getClientMimeType();
        $expiration_at = strtotime($request->get('expiration_at'));
        $fileSize = $file->getSize() / 1024;

        if ($fileSize > 20000) {
            throw new Exception('上傳報表文件失敗，文件不能大於20M', 30002);
        }

        switch ($clientType) {
            case 'application/vnd.ms-excel':
                $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'excel';
                $fileType = self::TYPE_EXCEL;
                break;
            case 'text/html':
                $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'html';
                $fileType = self::TYPE_HTML;
                break;
            case 'text/csv':
                $filePath = public_path() . DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'csv';
                $fileType = self::TYPE_CSV;
                break;
            case 'image/jpeg':
                $filePath = public_path() . DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'img';
                $fileType = self::TYPE_JPEG;
                break;
            case 'image/gif':
            case 'image/png':
                $filePath = base_path() . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'reports'.DIRECTORY_SEPARATOR.'image';
                $fileType = self::TYPE_IMAGE;
                break;
            default:
                Log::info('上傳報表文件：文件名稱[' . $clientName . ']、類型[' . $clientType . ']');
                throw new Exception('上傳報表文件不支持此類型：' . $clientType , 30003);
        }

        $file->move($filePath, $clientName);

        $data = array(
            "file_name" => $clientName,
            "file_path" => $filePath,
            "file_type" => $fileType,
            "abstract" => $abstract,
            "report_id" => $report->report_id,
            "expiration_at" => $expiration_at,
            "client_ip" => $clientIP,
        );
        $this->snapshots->create($data);

        $result = array(
            'message' => 'ok',
            'code' => 0,
            'status_code' => 0,
            'uploadFile_Response' => array("file_name" => $clientName,
                                           "report_id" => $report->report_id)
        );

        Log::info('上傳報表文件成功：文件名稱[' . $clientName . ']、類型[' . $fileType . ']、存放路徑[' . $filePath . ']');
        return response()->json($result);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
        //return $this->response->item(compact('user'), new UserTransformer);
    }

}