<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

class LabController extends Controller
{
    public function __construct()
    {

    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = ['ED-69','ED-420','RN-69','EB-420','EN-1337']; // TODO: load data dynamically instead of hardcode
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Labs retrieved successfully.';
        return response($result, 200);
    }
}
