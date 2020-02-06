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
        $res = $this->issue_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->issue_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
