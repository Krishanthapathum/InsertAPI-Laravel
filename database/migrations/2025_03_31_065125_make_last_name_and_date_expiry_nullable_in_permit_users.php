<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('permit_users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->change();
            $table->date('date_expiry')->nullable()->change();
            $table->date('dob')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('permit_users', function (Blueprint $table) {
            $table->string('last_name')->nullable(false)->change();
            $table->date('date_expiry')->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
        });
    }
};
