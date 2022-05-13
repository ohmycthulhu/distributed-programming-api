<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTagsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projects_tags', function (Blueprint $table) {
      $table->id();
      $table->foreignId('project_id');
      $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
      $table->foreignId('tag_id');
      $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
    Schema::dropIfExists('projects_tags');
  }
}
