<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('template_id');
            $table->string('status')->default('Pending');
            $table->string('lab',400);
            $table->date('due_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_to');
            $table->foreign('assigned_to')->references('id')->on('users');                    
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');
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
        Schema::dropIfExists('reports');
    }
}
