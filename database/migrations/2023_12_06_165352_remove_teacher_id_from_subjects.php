<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('subjects', function (Blueprint $table) {
        $table->dropColumn('teacher_id');
    });
}

public function down()
{
    Schema::table('subjects', function (Blueprint $table) {
        $table->foreignId('teacher_id')->references('id')->on('Classrooms')->onDelete('cascade');
    });
}

};
