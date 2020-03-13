<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dashboard;
use App\Repositories\ModelRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

use Exception;


class DashboardController extends Controller
{
    protected $model_dashboard;
    protected $model_user;

    public function __construct(Dashboard $tile, User $user)
    {
        $this->model_dashboard = new ModelRepository($tile);
        $this->model_user = new ModelRepository($user);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all()
    {
        $user = Auth::guard('api')->user();
        $role =  $user->getRoleNames();
        //dd($role[0]);
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        if ($role[0]=="admin" ){
            $result['data'] = $this->model_dashboard->get();
        }
        else{
            $result['data'] = $this->model_dashboard->where('accessible_to',2)->get();

        }
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Dashboard options retrieved succesfully.';
        return response($result, 200);
    }

}
