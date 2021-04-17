<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsTitlesAndImageFromNodeLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('node_lesson', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('title_english');
            $table->dropColumn('image');
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
            $table->string('title');
            $table->string('title_english');
            $table->string('image');
        });
    }
}
