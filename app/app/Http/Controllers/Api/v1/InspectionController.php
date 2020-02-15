<?php

namespace App\Http\Controllers\api\v1;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inspection\CreateRequest;


class InspectionController extends Controller
{
    protected $inspection_service;

    public function __construct(RestServiceContract $service)
    {
        $this->inspection_service = $service;
    }

    public function get($id)
    {
        $res = $this->inspection_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->inspection_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function create(CreateRequest $request)
    {
        $res = $this->inspection_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->inspection_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
