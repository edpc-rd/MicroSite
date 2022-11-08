<?php

namespace App\Repositories\Backend\Report\ReportReadLogs;

use App\Exceptions\GeneralException;
use App\Models\Report\ReportReadLogs;
use Stoneworld\Wechat\Utils\Http;

/**
 * Class EloquentRoleRepository
 * @package App\Repositories\Role
 */
class EloquentReportReadLogsRepository implements ReportReadLogsRepositoryContract
{
    /**
     * @param  $per_page
     * @param  mixed $order_by
     * @param  string $sort
     * @return mixed
     */
    public function getReportsPaginated($per_page, $order_by = 'id', $sort = 'desc',$start = '' ,$end = '')
    {
        //获取时间范围内的数据
        if(!empty($start) && !empty($start)){
            return ReportReadLogs::orderBy($order_by, $sort)->where('created_at','>=',$start. ' 00:00:00')
                ->where('created_at','<=',$end. ' 23:59:59')
                ->paginate($per_page);
        }

        return ReportReadLogs::orderBy($order_by, $sort)
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
            return ReportReadLogs::orderBy($order_by, $sort)
                ->get();
        }

        return ReportReadLogs::orderBy($order_by, $sort)
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
        return ReportReadLogs::orderBy($order_by, $sort)
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
        if (!is_null(ReportReadLogs::find($id))) {
            if ($withParameters) {
                return ReportReadLogs::find($id);
            }

            return ReportReadLogs::find($id);
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

    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function explodeExcel($start,$end){

        //导出字段
        $dataSort = [
            'title' => ['報表ID','報表名稱','用戶','動作','查看時間'],
            'fileds' => ['report_id','name','user_name','action','created_at']
        ];

        //获取时间范围内的数据
        if(!empty($start) && !empty($start)){
            $data = ReportReadLogs::orderBy('id', 'desc')->where('created_at','>=',$start. ' 00:00:00')
                ->where('created_at','<=',$end. ' 23:59:59')
                ->get();
        }else{
            $data = ReportReadLogs::orderBy('id', 'desc')
                ->get();
        }

        //导出内容
        foreach ($data as &$val){
            $report = $val->report()->first();
            $val['name'] = $report['name'];
        }

        require_once(base_path() . '/vendor/PHPExcel-1.8/Classes/PHPExcel.php');
        $objPHPExcel = new \PHPExcel();
        $sheet = $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('导出列表');
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal("center");
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical("center");
//        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
//        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
//        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
//        $objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode("@");

//        $dataArray = [$title];
//        foreach ($data as $val){
//            array_push($dataArray,$val);
//        }

//        $objPHPExcel->getActiveSheet()->fromArray($dataArray, null, 'A1');

        //导出字段标题数据重组
        //$columns[] = array( "title" => "商户名称", "field" => "merchname", "width" => 24 );
        $columns = [];
        foreach ($dataSort['title'] as $key => $val){
            $columns[] = array( "title" => $val, "field" => $dataSort['fileds'][$key], "width" => 24 );
        }

        $this->setExcelCell($data,$columns,$sheet);



        $objWorkSheet = $objPHPExcel->createSheet();
        $sheet2 = $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setTitle('统计');
        //统计数据
        if(!empty($start) && !empty($start)){
            $dataCount = \DB::select(' SELECT b.`name`,count(*) as num ' .
                ' FROM ms_reports_read_logs a ' .
                ' JOIN ms_reports b on a.report_id = b.report_id ' .
                ' WHERE start >= :start and end <= :end' .
                ' GROUP BY name ' .
                ' ORDER BY b.name DESC ',[':start' => $start. ' 00:00:00',':end' => $end. ' 23:59:59' ]);
        }else{
            $dataCount = \DB::select(' SELECT b.`name`,count(*) as num ' .
                ' FROM ms_reports_read_logs a ' .
                ' JOIN ms_reports b on a.report_id = b.report_id ' .
                ' GROUP BY name ' .
                ' ORDER BY b.name DESC ');
        }

        $dataCountSort = [
            'title' => ['報表名稱','次數'],
            'fileds' => ['name','num']
        ];
        $columns = [];
        foreach ($dataCountSort['title'] as $key => $val){
            $columns[] = array( "title" => $val, "field" => $dataCountSort['fileds'][$key], "width" => 24 );
        }

        $this->setExcelCell(json_decode(json_encode($dataCount),true),$columns,$sheet2);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.date('Y-m-d').'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997$hourValueGMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        $objPHPExcel->disconnectWorksheets();
    }

    /**
     * @param $data     需导出的数据
     * @param $columns  导出字段及字段设置
     * @param $sheet
     */
    public function setExcelCell($data,$columns,&$sheet){
        //设置A1字段
        $rownum = 1;
        foreach ($columns as $key => $column )
        {
            $sheet->setCellValue($this->column($key, $rownum), $column['title']);
            if (!(empty($column['width'])))
            {
                $sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
            }
        }
        ++$rownum;

        //导出数据
        $len = count($columns);
        //设置为数值类型的字段
        $numField = ['V','W','X','Y','Z','AA','AB'];
        foreach ($data as $row )
        {
            $i = 0;
            while ($i < $len)
            {
                $value = ((isset($row[$columns[$i]['field']]) ? $row[$columns[$i]['field']] : ''));
//                $sheet->setCellValue($this->column($i, $rownum), $value);
                if(in_array($this->column_str($i),$numField)){
                    $sheet->setCellValueExplicit($this->column($i, $rownum),trim($value),\PHPExcel_Cell_DataType::TYPE_NUMERIC);
                }else{
                    $sheet->setCellValueExplicit($this->column($i, $rownum),trim($value),\PHPExcel_Cell_DataType::TYPE_STRING);
                }
                ++$i;
            }
            ++$rownum;
        }
    }

    public function column_str($key)
    {
        $array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ');
        return $array[$key];
    }
    public function column($key, $columnnum = 1)
    {
        return $this->column_str($key) . $columnnum;
    }
}
