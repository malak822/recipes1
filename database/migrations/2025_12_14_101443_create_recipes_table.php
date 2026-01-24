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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            
            // علاقة بالمستخدم الذي أضاف الوصفة
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // حذف الوصفات إذا حُذف المستخدم

            $table->string('title', 255); // عنوان الوصفة (حد أقصى 255 حرف)

            // المكونات والخطوات كنصوص طويلة
            $table->text('ingredients');   // المكونات (يفضل فصلها بسطور)
            $table->text('instructions');  // خطوات التحضير

            // الحقول الجديدة
            $table->integer('prep_time')           // وقت التحضير (بالدقائق) - إجباري
                  ->unsigned();                    // لا يقبل قيم سالبة

            $table->integer('cook_time')           // وقت الطبخ/الخبز (بالدقائق) - اختياري
                  ->unsigned()
                  ->nullable();

            $table->string('category', 100)        // الفئة (طبخ جزائري، حلويات، شوربة...)
                  ->index();                       // لتسريع البحث حسب الفئة

            $table->enum('difficulty', ['سهل', 'متوسط', 'صعب'])
                  ->default('سهل');                // مستوى الصعوبة مع قيمة افتراضية

            // الصورة
            $table->string('image')->nullable();   // مسار الصورة في التخزين (storage)

            // إحصائيات إضافية (اختياري - يمكنك إضافتها لاحقاً)
            $table->unsignedInteger('views_count')->default(0);     // عدد المشاهدات
            $table->unsignedInteger('likes_count')->default(0);     // عدد الإعجابات (اختياري)

            $table->timestamps();                  // created_at & updated_at
            $table->softDeletes();                 // deleted_at - لدعم Soft Deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};