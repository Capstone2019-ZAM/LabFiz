<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('report_section_template_id');
            $table->foreign('report_section_template_id')->references('id')->on('section_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_sections', function (Blueprint $table) {
            //
        });
    }
}
