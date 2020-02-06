<?php

namespace App\Http\Controllers\api\v1;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lab\CreateRequest;

class LabController extends Controller
{
    protected $lab_service;

    public function __construct(RestServiceContract $service)
    {
        $this->lab_service = $service;
    }

    public function get($id)
    {
        $res = $this->lab_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->lab_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function create(CreateRequest $request)
    {
        $res = $this->lab_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->lab_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
