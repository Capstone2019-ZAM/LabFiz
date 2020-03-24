<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Report;
use App\ReportQuestion;
use App\ReportSection;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
//TODO : remove this import and its usage with models
use Illuminate\Support\Facades\DB;


class ReportService implements RestServiceContract
{
    protected $report_model, $report_section_model, $report_question_model, $user_model;

    public function __construct(Report $report, ReportQuestion $report_question, ReportSection $report_section, User $user)
    {
        $this->report_model = new ModelRepository($report);
        $this->report_section_model = new ModelRepository($report_section);
        $this->report_question_model = new ModelRepository($report_question);
        $this->user_model = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->report_model->with(['sections','sections.questions'])->getById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find report record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all()
    {
        $result = ['status' => '200 (Ok)', 'message' => 'All Reports retrieved successfully.', 'data' => ''];
        $result['data'] = $this->report_model->with(['sections','sections.questions'])->get();
        return ['response' => $result, 'status' => 200];
    }

    public function get_all_by_user()
    {
        $user = Auth::guard('api')->user();        
        $result = ['status' => '200 (Ok)', 'message' => 'All Reports retrieved successfully.', 'data' => ''];
        $result['data'] =$this->report_model->where('assigned_to',$user->id)->get();
        //$result['data'] = $this->report_model->with(['sections','sections.questions'])->get();
        return ['response' => $result, 'status' => 200];
    }

    public function get_all_deleted()
    {
        $result = ['status' => '200 (Ok)', 'message' => 'All Deleted Reports retrieved successfully.', 'data' => ''];
       //TODO use onlyTrashed() with model
        //$result['data'] = $this->report_model->onlyTrashed()->get();
        $result['data'] = DB::table('reports')->whereNotNull('deleted_at')->get();
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $user = Auth::guard('api')->user();

        // create the report
        try {
            $report = $this->report_model->updateOrCreate(
                ['id' => $request->id],
                [
                    'title' => $request->title,
                    'template_id' => $request->template_id,
                    'user_id' => $user->id,
                    'assigned_to' => $request->assigned_to,
                    'lab' => $request->lab,
                    'due_date' => $request->due_date
                ]
            );

            $result['data'] = $report;
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $schema = DB::table('templates')->where('id',$request->template_id)->value('schema');
        $sections = json_decode($schema);  

        // if the report has sections, populate the tables for sections and questions
            foreach ($sections as $sect_key => $sect_val) {
                // create the section
                try {
                    $section = $this->report_section_model->updateOrCreate(
                        ['report_id' => $request->id, 'title' => $sect_key],
                        [
                            'title' => $sect_val->section_nm,
                            'report_id' => $report->id,
                            'user_id' => $user->id
                        
                        ]
                    );

                    $result['data']['sections'][$sect_key] = $section;
                } catch (Exception $ex) {
                    $result['message'] = $ex->getMessage();
                    return ['response' => $result, 'status' => 400];
                }
            
                // create any questions
                foreach ($sect_val->questions as $question_key => $question_val) {
                    try {
                        $question = $this->report_question_model->updateOrCreate(
                            [
                                'report_section_id' => $section->id,
                                'question' => $question_key
                            ],
                            [
                                'question' => $question_val,
                                'report_section_id' => $section->id,
                               // 'report_question_template_id' => $question_val['template_id'],
                                //'answer' => $question_val['answer'],
                                //'description' => $question_val['description']
                            ]
                        );

                        $result['data']['sections'][$sect_key]['questions'][$question_key] = $question;
                    } catch (Exception $ex) {
                        $result['message'] = $ex->getMessage();
                        return ['response' => $result, 'status' => 400];
                    }
                }
            }
        // }

        $result['status'] = '200 (Ok)';
        $result['message'] = ($report->wasRecentlyCreated ? 'Created' : 'Updated') .' report document successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function update(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $user = Auth::guard('api')->user();
        $sections = $request->sections;
        
        //only update status in assigned reports
        if ( isset($request->status) ){
            try {
                
                DB::table('reports')->where('id', $request->id)->update(['status' => $request->status]);              
   
                $result['data']["status"]= $request->status;
            } catch (Exception $ex) {
                $result['message'] = $ex->getMessage();
                return ['response' => $result, 'status' => 400];
            }
        }

        $s=0;
        foreach ( $sections as $section){
            try{    

                $section = (object)$section;                
                foreach($section->questions as $q){
                    $q= (object)$q;
                    $question = $this->report_question_model->updateOrCreate(
                        [
                            'report_section_id' => $q->report_section_id,
                            'question' => $q->question
                        ],
                        [
                            'answer' => $q->answer,
                            'description' =>$q->description
                        ]
                    );
            }
            $result['data']['sections'][$s] = $section;
            $s++;
            }
            catch( Exception $ex){
                $result['message'] = $ex->getMessage();
                return ['response' => $result, 'status' => 400];
            }
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = ($question->wasRecentlyCreated ? 'Created' : 'Updated') .' report document successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->report_model->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find report record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report deleted successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function restore($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $report=DB::table('reports')->where('id',$id)->update(['deleted_at'=>null]);            
            $result['data'] = $this->report_model->getById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find report record to delete.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report restored successfully.';
        return ['response' => $result, 'status' => 200];
    }
}
