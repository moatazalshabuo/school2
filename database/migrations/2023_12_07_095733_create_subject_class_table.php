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
        Schema::create('subject_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_subject_id')->constrained('main_subjects')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('Classrooms')->cascadeOnDelete();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('subjec_class');
    }
};
