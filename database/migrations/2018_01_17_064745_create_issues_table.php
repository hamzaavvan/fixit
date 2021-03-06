<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('projectname', 250);
            $table->string('title', 500);
            $table->longText('description')->nullable();
            $table->longText('summary')->nullable();
            $table->string('slug')->nullable();
            $table->longText('fix')->nullable();
            $table->tinyInteger('fixed')->default(1);
            $table->tinyInteger('visibility')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_to');
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
