<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('report_questions');
        Schema::create('report_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->integer('answer')->default(0);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('report_section_id');
            // $table->foreign('report_section_id')->references('id')->on('report_sections')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_questions');
    }
}
