<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {

    }

    public function get($id){
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Report::where('id',$id)->first();
        if(!$report){
            return response($result,400);
        }
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved succesfully.';
        $result['data'] = $report;
        return response($result,200);
    }

    public function get_all(){
        return 'todo';
    }

    public function create(){
        return 'todo';
    }

    public function delete(){
        return 'todo';
    }
}
