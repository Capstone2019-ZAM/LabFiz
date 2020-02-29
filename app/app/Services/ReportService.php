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

    public function get_all_deleted()
    {
        $result = ['status' => '200 (Ok)', 'message' => 'All Deleted Reports retrieved successfully.', 'data' => ''];
        $result['data'] = $this->report_model->onlyTrashed()->get();
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $user = Auth::guard('api')->user();
        $sections = $request->sections;

        // create the report
        try {
            $report = $this->report_model->updateOrCreate(
                ['id' => $request->id],
                [
                    'title' => $request->title,
                    'report_template_id' => $request->template_id,
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

        // if the report has sections, populate the tables for sections and questions
        if ($sections) {
            foreach ($sections as $sect_key => $sect_val) {

                // create the section
                try {
                    $section = $this->report_section_model->updateOrCreate(
                        ['report_id' => $request->id, 'title' => $sect_key],
                        [
                            'title' => $sect_key,
                            'report_id' => $report->id,
                            'user_id' => $user->id,
                            'report_section_template_id' => $sect_val['template_id']
                        ]
                    );

                    $result['data']['sections'][$sect_key] = $section;
                } catch (Exception $ex) {
                    $result['message'] = $ex->getMessage();
                    return ['response' => $result, 'status' => 400];
                }

                // create any questions
                foreach ($sect_val['qs'] as $question_key => $question_val) {
                    try {
                        $question = $this->report_question_model->updateOrCreate(
                            [
                                'report_section_id' => $section->id,
                                'question' => $question_key
                            ],
                            [
                                'question' => $question_key,
                                'report_section_id' => $section->id,
                                'report_question_template_id' => $question_val['template_id'],
                                'answer' => $question_val['answer'],
                                'description' => $question_val['description']
                            ]
                        );

                        $result['data']['sections'][$sect_key]['questions'][$question_key] = $question;
                    } catch (Exception $ex) {
                        $result['message'] = $ex->getMessage();
                        return ['response' => $result, 'status' => 400];
                    }
                }
            }
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = ($report->wasRecentlyCreated ? 'Created' : 'Updated') .' report document successfully!';
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

    public function undelete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->report_model->restoreById($id);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find report record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report restored successfully.';
        return ['response' => $result, 'status' => 200];
    }
}
