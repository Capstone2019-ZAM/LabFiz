<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_questions', function (Blueprint $table) {
            $table->foreign('report_section_id')->references('id')->on('report_sections')->onDelete('cascade');
            // $table->unsignedBigInteger('report_question_template_id');
            // $table->foreign('report_question_template_id')->references('id')->on('question_templates')->onDelete('cascade');
            //$table->string('answer');
            //$table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_questions', function (Blueprint $table) {
            //
        });
    }
}
