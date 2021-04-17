<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatedColumnContents2FromNodeLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('node_lesson', function (Blueprint $table) {
            $table->text('content')->change();
            $table->text('content_english')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('node_lesson', function (Blueprint $table) {
            $table->string('content', 255)->change();
            $table->string('content_english', 255)->change();
        });
    }
}
