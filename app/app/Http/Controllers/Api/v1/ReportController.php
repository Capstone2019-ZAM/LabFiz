<?php

namespace App\Http\Controllers\api\v1;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Report\CreateRequest;

class ReportController extends Controller
{
    protected $report_service;

    public function __construct(RestServiceContract $service)
    {
        $this->report_service = $service;
    }

    public function get($id)
    {
        $res = $this->report_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->report_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function create(CreateRequest $request)
    {
        $res = $this->report_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->report_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
