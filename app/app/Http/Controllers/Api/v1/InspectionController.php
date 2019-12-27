<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Inspection;
use App\User;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function __construct()
    {

    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Inspection::where('id', $id)->first();
        if (!$report) {
            return response($result, 400);
        }
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Inspection::all();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Inspection assignments retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function create(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => []];
        $header = $request->header('Authorization');
        $user = User::where('api_token', $header)->first();

        // create the inspection assignment
        $inspection = new Inspection();
        $inspection->room = $request->room;
        $inspection->report_id = $request->report_id;
        $inspection->assigned_to = $request->assigned_to;
        $inspection->user_id = $user->id;
        $inspection->due_date= $request->due_date;
        $inspection->status = 'incomplete';
        if(!$inspection->save()){
            $result['message'] = 'Failed to persist changes.';
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['data'] = $inspection;
        $result['message'] = 'Created inspection assignment succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Could not find report to be deleted by id', 'data' => ''];
        $inspection = Inspection::where('id', $id)->first();
        if (!$inspection) {
            return response($result, 400);
        }

        $inspection->delete();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment deleted succesfully.';
        $result['data'] = $inspection;
        return response($result, 200);
    }
}
