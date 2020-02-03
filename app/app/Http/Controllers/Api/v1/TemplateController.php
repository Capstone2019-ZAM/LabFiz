<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Template\CreateRequest; 
use App\Template;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    protected $model_template;
    protected $model_user;

    public function __construct(Template $template, User $user)
    {
        $this->model_template = new ModelRepository($template);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $template = $this->model_template->getById($id);
            $result['data'] = $template;
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Template retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_template->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Templates retrieved succesfully.';
        return response($result, 200);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');

        try {
            $result['data'] = $this->model_template->create(
                [
                    
                    'user_id' => $user->id,                    
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created template succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_template->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Template deleted succesfully';
        return response($result, 200);
    }
    public function update(Request $request,$id)
    {
        // $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        // try {
        //     $template = $template->model_template->update($request->only($this->model_template) ,
        //     $id);
        //     $result['data'] = $this->model_template->getById($id);
        // } catch (Exception $ex) {
        //     $result['message'] = $ex->getMessage();
        //     return response($result, 400);
        // }
        // $result['status'] = '200 (Ok)';
        // $result['message'] = 'Template updated succesfully';
        // return response($result, 200);   
    
    }

    

}

