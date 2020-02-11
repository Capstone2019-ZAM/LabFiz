<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('report_template_id');
            $table->foreign('report_template_id')->references('id')->on('report_templates')->onDelete('cascade');
            $table->string('room');
            //$table->date('due_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('due_date')->useCurrent();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
}
