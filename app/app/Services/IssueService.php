<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Issue;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IssueService implements RestServiceContract
{
    protected $user_model, $issue_model;

    public function __construct(User $user, Issue $issue)
    {
        $this->user_model = new ModelRepository($user);
        $this->issue_model = new ModelRepository($issue);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            
            $result['data'] = $this->issue_model->getById($id);
            $assign_id =$result['data']['assigned_to'];            
            $user_assigned = DB::table('users')->where('id',$assign_id)->first();
            $user_name = $user_assigned->first_name . ' '. $user_assigned->last_name;
            $result['data']['user_name'] =$user_name;
        } catch (Exception $ex) {
            $result['message'] = ' Could not find issue record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all()
    {
        $user = Auth::guard('api')->user();  
        $user_id = $user['id'];
        $role = $user->getRoleNames();
        
        $result = ['status' => '200 (Ok)', 'message' => 'All Issues retrieved successfully.', 'data' => ''];
        if( $role[0]=="admin"){
            $result['data'] = $this->issue_model->get();
            $issues = $result['data'];
            foreach( $issues as $issue){
                $assign_id =$issue->assigned_to;            
                $user_assigned = DB::table('users')->where('id',$assign_id)->first();
                $user_name = $user_assigned->first_name . ' '. $user_assigned->last_name;
                $issue->user_name =$user_name;
            }
        }
        else{
            $result['data'] =DB::table('issues')->where('user_id', $user_id)->orWhere('assigned_to',$user_id)->get();
            $issues = $result['data'];
            foreach( $issues as $issue){
                $assign_id =$issue->assigned_to;            
                $user_assigned = DB::table('users')->where('id',$assign_id)->first();
                $user_name = $user_assigned->first_name . ' '. $user_assigned->last_name;
                $issue->user_name =$user_name;
            }
            
            //$this->issue_model->where('user_id', $user_id)->orWhere('assigned_to',$user_id)->get();
        }
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $user = Auth::guard('api')->user();

        try {
            $issue = $this->issue_model->updateOrCreate(
                ['id' => $request->id],
                [
                    'title' => $request->title,
                    'room' => $request->room,
                    'user_id' => $user->id,
                    'severity' => $request->severity,
                    'status' => $request->status,
                    'due_date' => $request->due_date,
                    'description' => $request->description,
                    'assigned_to' => $request->assigned_to
                ]
            );
            $result['data'] = $issue;
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = ($issue->wasRecentlyCreated ? 'Created' : 'Updated') .' issue successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->issue_model->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find issue record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue deleted successfully';
        return ['response' => $result, 'status' => 200];
    }
}
