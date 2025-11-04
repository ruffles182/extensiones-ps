<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToExtensionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('extensiones', function (Blueprint $table) {
            $table->string('host', 45)->default('200.94.158.82');
            $table->unsignedInteger('puerto')->default(5060);
            $table->string('password', 10)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('extensiones', function (Blueprint $table) {
            $table->dropColumn(['host', 'puerto', 'password']);
        });
    }
}
