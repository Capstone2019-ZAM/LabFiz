<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\CreateRequest;
use App\ReportTemplate;
use App\QuestionTemplate;
use App\SectionTemplate;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    protected $model_template_report;
    protected $model_template_section;
    protected $model_template_question;
    protected $model_user;

    public function __construct(ReportTemplate $report_template, QuestionTemplate $t_question, SectionTemplate $t_section, User $user)
    {
        $this->model_report = new ModelRepository($report_template);
        $this->model_report_section = new ModelRepository($t_section);
        $this->model_report_question = new ModelRepository($t_question);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $template = $this->model_template_report->getById($id);

        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['data'] = $template;
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_template_report->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Reports retrieved succesfully.';
        return response($result, 200);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');
        $sections = $request->sections;
        $title = $request->title;

        // create the report
        try {
            $report_template = $this->model_template_report->create(
                [
                    'title' => $title,
                    'user_id' => $user->id,
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['data'] = $report_template;

        // if the report has sections, populate the tables for sections and questions
        if ($sections) {
            foreach ($sections as $sect => $value) {
                // create the section
                try {
                    $section = $this->model_template_section->create(
                        [
                            'title' => $sect,
                            'report_id' => $report_template->id,
                            'user_id' => $user->id,
                        ]
                    );
                } catch (Exception $ex) {
                    $result['message'] = $ex->getMessage();
                    return response($result, 400);
                }

                $result['data']['$sect'] = $section;

                // create any questions
                foreach ($value['qs'] as $q) {
                    try {
                        $question = $this->model_template_question->create(
                            [
                                'question' => $q,
                                'report_section_id' => $section->id,
                            ]
                        );
                    } catch (Exception $ex) {
                        $result['message'] = $ex->getMessage();
                        return response($result, 400);
                    }

                    $result['data'][$q] = $question;
                }
            }
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created Template document succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_template_report->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Template deleted succesfully.';
        return response($result, 200);
    }
}
