<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {

    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Report::where('id', $id)->first();
        if (!$report) {
            return response($result, 400);
        }
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Report::all();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Reports retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function create(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => []];
        $header = $request->header('Authorization');
        $user = User::where('api_token', $header)->first();

        $sections = $request->sections;
        $title = $request->title;

        // create the report
        $report = new Report();
        $report->title = $title;
        $report->user_id = $user->id;
        if (!$report->save()) {
            $result['message'] = 'Invalid input provided for section:' . $title;
            return response($result, 400);
        }

        $result['data'][$title] = $report;

        // create sections and bind questions
        if ($sections) {
            foreach ($sections as $sect => $value) {
                $section = new ReportSection();
                $section->title = $sect;
                $section->report_id = $report->id;
                if (!$section->save()) {
                    $result['message'] = 'Invalid input provided for section:' . $sect;
                    return response($result, 400);
                }
                $result['data']['$sect'] = $section;
                foreach ($value['qs'] as $q) {
                    $question = new ReportQuestion();
                    $question->question = $q;
                    $question->report_section_id = $section->id;
                    if (!$question->save()) {
                        $result['message'] = 'Invalid input provided for question:' . $q;
                        return response($result, 400);
                    }
                    $result['data'][$q] = $question;
                }
            }
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created report document succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Could not find report to be deleted by id', 'data' => ''];
        $report = Report::where('id', $id)->first();
        if (!$report) {
            return response($result, 400);
        }

        $report->delete();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report deleted succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }
}
