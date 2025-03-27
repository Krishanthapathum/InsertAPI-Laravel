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
            $table->boolean('printed')->default(false);
        });
    }

    public function down()
    {
        Schema::table('permit_users', function (Blueprint $table) {
            $table->dropColumn('printed');
        });
    }
    };
