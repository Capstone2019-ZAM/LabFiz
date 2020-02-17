<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Inspection;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class InspectionService implements RestServiceContract
{
    protected $inspection_model, $user_model;

    public function __construct(User $user, Inspection $inspection)
    {
        $this->inspection_model = new ModelRepository($inspection);
        $this->user_model = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->inspection_model->getById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find inspection record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all()
    {
        $result = ['status' => '200 (Ok)', 'message' => 'All Inspection assignments retrieved successfully.', 'data' => ''];
        $result['data'] = $this->inspection_model->get();
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $user = AuthHelper::instance()->user($request,$this->user_model);

        try {
            $result['data'] = $this->inspection_model->updateOrCreate(
                [
                    'id' => $request->id
                ],
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
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created inspection assignment successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->inspection_model->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find inspection record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Inspection assignment deleted successfully.';
        return ['response' => $result, 'status' => 200];
    }
}
