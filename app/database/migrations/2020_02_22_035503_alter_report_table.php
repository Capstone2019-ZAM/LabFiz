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
        //
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('lab')->references('location')->on('labs');
            $table->foreign('template_id')->references('id')->on('templates');

        });

        $seederPerm = new PermissionsSeeder();
        $seederRole = new RolesSeeder();
        // $seederUser = new UsersSeeder();
        // $seederLab = new  LabSeeder();
        $seederPerm->run();
        $seederRole->run();
        // $seederUser->run();
        // $seederLab->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
