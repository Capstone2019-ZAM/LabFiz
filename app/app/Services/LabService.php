<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Lab;
use App\Repositories\ModelRepository;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;

class LabService implements RestServiceContract
{
    protected $lab_model;

    public function __construct(Lab $lab)
    {
        $this->lab_model = new ModelRepository($lab);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->lab_model->getById($id);
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Lab retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->lab_model->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Labs retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];

        try {
            $result['data'] = $this->lab_model->updateOrCreate(
                [
                    'id' => $request->id,
                    'title' => $request->title
                ],
                [
                    'title' => $request->title,
                ]
            );
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created lab successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->lab_model->deleteById($id);
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Lab deleted successfully';
        return ['response' => $result, 'status' => 200];
    }
}
