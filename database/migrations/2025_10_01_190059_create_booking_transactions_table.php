<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            // maksud constrained adalah mereferensikan tabel yg sesuai, laravel berasumsi bahwa user_id mereferensikan dari tabel user dan field id pada tabel tersebut  
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->date('started_at')->index(); //index untuk mempercepat query
            $table->time('time_at');
            $table->integer('sub_total');
            $table->integer('tax_total');
            $table->integer('grand_total');
            $table->string('proof');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
