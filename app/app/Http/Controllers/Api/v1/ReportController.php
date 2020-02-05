<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\CreateRequest;
use App\Report;
use App\ReportQuestion;
use App\ReportSection;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $model_report;
    protected $model_report_section;
    protected $model_report_question;
    protected $model_user;

    public function __construct(Report $report, ReportQuestion $report_question, ReportSection $report_section, User $user)
    {
        $this->model_report = new ModelRepository($report);
        $this->model_report_section = new ModelRepository($report_section);
        $this->model_report_question = new ModelRepository($report_question);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $issue = $this->model_report->getById($id);

        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['data'] = $issue;
        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_report->get();
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
            $report = $this->model_report->create(
                [
                    'title' => $title,
                    'user_id' => $user->id,
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['data'] = $report;

        // if the report has sections, populate the tables for sections and questions
        if ($sections) {
            foreach ($sections as $sect => $value) {
                // create the section
                try {
                    $section = $this->model_report_section->create(
                        [
                            'title' => $sect,
                            'report_id' => $report->id,
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
                        $question = $this->model_report_question->create(
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
        $result['message'] = 'Created report document succesfully!';
        return response($result, 200);
    }

    public function update_section(UpdateRequest $request)
    {

    }

    public function update_question(UpdateRequest $request)
    {

    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_report->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Report deleted succesfully.';
        return response($result, 200);
    }
}
