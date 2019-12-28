<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inspection\CreateRequest;
use App\Inspection;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    protected $model_inspection;
    protected $model_user;

    public function __construct(Inspection $inspection, User $user)
    {
        $this->model_inspection = new ModelRepository($inspection);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $issue = $this->model_inspection->getById($id);

        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['data'] = $issue;
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_inspection->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Inspection assignments retrieved succesfully.';
        return response($result, 200);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');

        try {
            $result['data'] = $this->model_inspection->create(
                [
                    'room' => $request->room,
                    'report_id' => $request->report_id,
                    'assigned_to' => $request->assigned_to,
                    'user_id' => $user->id,
                    'due_date' => $request->due_date,
                    'status' => 'incomplete',
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created inspection assignment succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_inspection->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment deleted succesfully.';
        return response($result, 200);
    }
}
