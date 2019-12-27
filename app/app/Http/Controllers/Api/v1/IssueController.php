<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Issue;
use App\User;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {

    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Issue::where('id', $id)->first();
        if (!$report) {
            return response($result, 400);
        }
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => ''];
        $report = Issue::all();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Issues retrieved succesfully.';
        $result['data'] = $report;
        return response($result, 200);
    }

    public function create(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Ill formed input', 'data' => []];
        $header = $request->header('Authorization');
        $user = User::where('api_token', $header)->first();

        // create the inspection assignment
        $issue = new Issue();
        $issue->title = $request->title;
        $issue->room = $request->room;
        $issue->user_id = $user->id;
        $issue->severity= $request->severity;
        $issue->status = 'incomplete';
        $issue->description = $request->description;
        $issue->comments = $request->comments;
        if(!$issue->save()){
            $result['message'] = 'Failed to persist changes.';
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['data'] = $issue;
        $result['message'] = 'Created issue succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => 'Could not find issue to be deleted by id', 'data' => ''];
        $issue = Issue::where('id', $id)->first();
        if (!$issue) {
            return response($result, 400);
        }

        $issue->delete();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue deleted succesfully.';
        $result['data'] = $issue;
        return response($result, 200);
    }
}
