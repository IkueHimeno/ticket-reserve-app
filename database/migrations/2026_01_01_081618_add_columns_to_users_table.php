<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kana')->nullable()->after('name');
            $table->string('tel')->nullable()->after('kana');
            $table->string('postcode', 7)->nullable()->after('tel');
            $table->string('address')->nullable()->after('postcode');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['kana', 'tel', 'postcode', 'address']);
        });
    }
};
