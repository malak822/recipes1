<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            if (! Schema::hasColumn('recipes', 'prep_time')) {
                $table->integer('prep_time')->unsigned()->after('instructions');
            }
            if (! Schema::hasColumn('recipes', 'cook_time')) {
                $table->integer('cook_time')->unsigned()->nullable()->after('prep_time');
            }
            if (! Schema::hasColumn('recipes', 'category')) {
                $table->string('category', 100)->nullable()->after('cook_time');
            }
            if (! Schema::hasColumn('recipes', 'difficulty')) {
                $table->enum('difficulty', ['سهل', 'متوسط', 'صعب'])->default('سهل')->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $columns = array_filter(
                ['prep_time', 'cook_time', 'category', 'difficulty'],
                fn (string $col) => Schema::hasColumn('recipes', $col)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
