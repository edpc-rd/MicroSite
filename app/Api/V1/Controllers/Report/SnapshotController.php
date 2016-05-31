<?php

namespace  App\Api\V1\Controllers\Report;

use App\Api\V1\Controllers\BaseController;
use App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract;
use App\Repositories\Backend\Report\ReportRepositoryContract;
use App\Repositories\Backend\User\UserContract;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
/**
 * Class UserController
 */
class SnapshotController extends BaseController
{
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
     * @param UserContract                 $users
     * @param ReportSnapshotRepositoryContract       $snapshots
     * @param ReportRepositoryContract $reports
     */
    public function __construct(
        UserContract $users,
        ReportSnapshotRepositoryContract $snapshots,
        ReportRepositoryContract $reports
    )
    {
        $this->users       = $users;
        $this->snapshots       = $snapshots;
        $this->reports = $reports;
    }

    public function uploadFile(Request $request) {

        try{
            $report = $this->reports->findOrThrowException($request->get('report_id'));
        }catch (\Exception $e){
            return response()->json(array('Error'=>"Report Not Found"));
        }

        $file = $request->File('file');
        $clientIP =$request->getClientIp();
        $clientName = $file->getClientOriginalName();
        $clientType = $file->getMimeType();
        $expiration_at = strtotime($request->get('expiration_at'));
        $fileSize = $file->getSize() / 1024;

        if($fileSize>5000){
            return response()->json(array('Error'=>"File Too Large!"));
        }

        switch ($clientType){
            case 'application/vnd.ms-excel':$filePath = 'uploads\reports\excel';break;
            case 'text/html':$filePath = 'uploads\reports\html';break;
            case 'image/jpeg':
            case 'image/gif':
            case 'image/png':$filePath = 'uploads\reports\img';break;
            default:
                return response()->json(array('Error'=>'No Support This FileType!'));
        }

        $file->move($filePath,$clientName);

        $data = array(
            "file_name" => $clientName,
            "file_path" => $filePath,
            "report_id" => $report->report_id,
            "expiration_at" => $expiration_at,
            "client_ip" => $clientIP,
        );
        $this->snapshots->create($data);

        return response()->json(compact('data'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
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