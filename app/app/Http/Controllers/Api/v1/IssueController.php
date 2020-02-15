<?php

namespace App\Http\Controllers\api\v1;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\CreateRequest;

class IssueController extends Controller
{
    protected $issue_service;

    public function __construct(RestServiceContract $service)
    {
        $this->issue_service = $service;
    }

    public function get($id)
    {
        $res = $this->issue_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->issue_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');

        try {
            $result['data'] = $this->model_issue->create(
                [
                    'title' => $request->title,
                    'room' => $request->room,
                    'user_id' => $user->id,
                    'severity' => $request->severity,
                    'status' => 'Open',
                    'due_date'=> $request->due_date,
                    'description' => $request->description,
                    'comments' => $request->comments
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created issue succesfully!';
        return response($result, 200);
        $res = $this->issue_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->issue_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
