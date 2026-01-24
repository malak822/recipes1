<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->integer('prep_time')->unsigned()->after('instructions');
            $table->integer('cook_time')->unsigned()->nullable()->after('prep_time');
            $table->string('category', 100)->nullable()->after('cook_time');
            $table->enum('difficulty', ['سهل', 'متوسط', 'صعب'])->default('سهل')->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['prep_time', 'cook_time', 'category', 'difficulty']);
        });
    }
};