<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnglishToNodeLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('node_lesson', function (Blueprint $table) {
            $table->string('content_english');
            $table->string('title_english');
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
            $table->dropColumn('content_english');
            $table->dropColumn('title_english');
        });
    }
}
