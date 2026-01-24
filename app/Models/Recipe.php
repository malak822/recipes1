<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'ingredients',
        'instructions',
        'prep_time',
        'cook_time',
        'category',
        'difficulty',
        'image',
    ];
    /**
     * الحقول التي يجب تحويلها إلى أنواع معينة تلقائياً
     */
    protected $casts = [
        'prep_time'   => 'integer',
        'cook_time'   => 'integer',
        'difficulty'  => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    /**
     * علاقة مع المستخدم الذي أضاف الوصفة
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة اختيارية: إذا أردت إضافة تعليقات أو تقييمات لاحقاً
     * مثال:
     * public function comments()
     * {
     *     return $this->hasMany(Comment::class);
     * }
     */

    /**
     * Accessor لعرض وقت التحضير بشكل جميل (اختياري)
     */
    public function getPrepTimeDisplayAttribute()
    {
        return $this->prep_time . ' دقيقة';
    }

    /**
     * Accessor لعرض وقت الطبخ بشكل جميل (إذا موجود)
     */
    public function getCookTimeDisplayAttribute()
    {
        return $this->cook_time 
            ? $this->cook_time . ' دقيقة' 
            : 'غير محدد';
    }

    /**
     * Accessor لعرض مستوى الصعوبة مع ألوان أو أيقونات (اختياري)
     */
    public function getDifficultyBadgeAttribute()
    {
        $badges = [
            'سهل'    => 'bg-success',
            'متوسط' => 'bg-warning',
            'صعب'    => 'bg-danger',
        ];

        $color = $badges[$this->difficulty] ?? 'bg-secondary';
        return "<span class='badge $color'>{$this->difficulty}</span>";
    }

    /**
     * Scope للبحث حسب الفئة (مفيد لاحقاً)
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope لترتيب حسب الأحدث
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}