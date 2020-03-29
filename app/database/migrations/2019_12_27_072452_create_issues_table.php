<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('room');
            $table->string('room', 400);
            $table->string('status');
            $table->string('title');
            $table->string('severity');
            $table->date('due_date');
            $table->string('description');
            //$table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('assigned_to');            
            $table->unsignedBigInteger('user_id');            
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users');//->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
