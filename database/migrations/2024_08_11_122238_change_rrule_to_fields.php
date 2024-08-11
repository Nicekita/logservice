<?php

use App\Enums\Frequency;
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
        Schema::table('services', function (Blueprint $table) {
           $table->dropColumn('rrule');
           $table->integer('interval');
           $table->enum('freq',['SECONDLY', 'MINUTELY', 'HOURLY', 'DAILY', 'WEEKLY', 'MONTHLY', 'YEARLY']);
           $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->json('rrule');
            $table->dropColumn('interval');
            $table->dropColumn('freq');
            $table->dropColumn('count');
        });
    }
};
