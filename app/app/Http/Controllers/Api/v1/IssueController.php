<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\CreateRequest;
use App\Issue;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    protected $model_issue;
    protected $model_user;

    public function __construct(Issue $issue, User $user)
    {
        $this->model_issue = new ModelRepository($issue);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $issue = $this->model_issue->getById($id);
            $result['data'] = $issue;
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_issue->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Issues retrieved succesfully.';
        return response($result, 200);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');
        try {
            $result['data'] = $this->model_issue->updateOrCreate(
                ['user_id,resolution_date'],
                [
                    'title' => $request->title,
                    'room' => $request->room,
                    'user_id' => $user->id,
                    'severity' => $request->severity,
                    'status' => 'incomplete',
                    'resolution_date' => $request->resolution_date,
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
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_issue->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue deleted succesfully';
        return response($result, 200);
    }
}
