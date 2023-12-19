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
        Schema::create('fee_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId("St_id")->constrained("students")->cascadeOnDelete();
            $table->foreignId('Fee_id')->constrained("fees")->cascadeOnDelete();
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('fee_students');
    }
};
