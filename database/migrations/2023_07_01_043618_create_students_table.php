<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $timestamps = true;
    public function up(): void
    {
       
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('sname');
            $table->string('semail')->unique();
            $table->bigInteger('smobile')->nullable()->unique();
            $table->enum('sgender', ['f', 'm', 'o']);
            $table->boolean('status')->default(true);
            $table->string('profile_picture')->nullable();
            $table->timestamps(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
