<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Report;
use App\ReportQuestion;
use App\ReportSection;
use App\Repositories\ModelRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;

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

    protected function foreign_data($report, $result)
    {
        $result['data'] = [
            $report->title =>
                [
                    'id' => $report->id,
                    'title' => $report->title,
                    'user_id' => $report->user_id,
                    'created_at' => $report->created_at,
                    'updated_at' => $report->updated_at,
                    'report_template_id' => $report->report_template_id,
                    'room' => $report->room
                ]
        ];
        foreach ($report->sections as $section) {
            $result['data'][$report->title]['ref'][$section->title] = [
                'id' => $section->id,
                'report_id' => $section->report_id,
                'created_at' => $section->created_at,
                'updated_at' => $section->updated_at,
                'report_section_template_id' => $section->report_section_template_id
            ];

            foreach ($section->questions as $question) {
                $result['data'][$report->title]['ref'][$section->title]['ref'][$question->question] = [
                    'id' => $question->id,
                    'question' => $question->question,
                    'report_section_id' => $question->report_section_id,
                    'created_at' => $question->created_at,
                    'updated_at' => $question->updated_at,
                    'report_question_template_id' => $question->report_question_template_id,
                    'answer' => $question->answer,
                    'description' => $question->description,
                ];
            }
        }
        return $result;
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $report = $this->report_model->getById($id);
            $result = $this->foreign_data($report, $result);
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $reports = $this->report_model->get();
        foreach ($reports as $report)
            $result = $this->foreign_data($report, $result);

        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Reports retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];

        $user = AuthHelper::instance()->user($request,$this->user_model);
        $sections = $request->sections;

        // create the report
        try {
            $report = $this->report_model->updateOrCreate(
                ['id' => $request->id],
                [
                    'title' => $request->title,
                    'report_template_id' => $request->template_id,
                    'user_id' => $user->id,
                    'room' => $request->room,
                    'due_date' => $request->due_date
                ]
            );

            $result['data'] = [
                'id' => $report->id,
                'title' => $report->title,
                'user_id' => $report->user_id,
                'created_at' => $report->created_at,
                'updated_at' => $report->updated_at,
                'report_template_id' => $report->report_template_id,
                'room' => $report->room,
                'due_date' => $report->due_date
            ];
        } catch (QueryException $ex) {
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

                    $result['data']['ref'][$sect_key] = [
                        'id' => $section->id,
                        'title' => $section->title,
                        'report_id' => $section->report_id,
                        'created_at' => $section->created_at,
                        'updated_at' => $section->updated_at,
                        'report_section_template_id' => $section->report_template_section_id
                    ];
                } catch (QueryException $ex) {
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

                        $result['data']['ref'][$sect_key]['ref'][$question_key] = $question;
                    } catch (QueryException $ex) {
                        $result['message'] = $ex->getMessage();
                        return ['response' => $result, 'status' => 400];
                    }
                }
            }
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created report document successfully!';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->report_model->deleteById($id);
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report deleted successfully.';
        return ['response' => $result, 'status' => 200];
    }
}
