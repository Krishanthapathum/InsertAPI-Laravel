<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permit_users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_names');
            $table->date('dob');
            $table->string('sl_license_no');
            $table->string('int_permit_no')->unique();
            $table->date('date_issued');
            $table->date('date_expiry');
            $table->string('vehicle_types');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_users');
    }
};
