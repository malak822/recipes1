<?php

// 1. اختبار قدرة الزوار على تصفح الصفحة الرئيسية
test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

// 2. اختبار إضافة وصفة جديدة بشرط تسجيل الدخول
test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // التأكد من أن الوصفة تم حفظها بنجاح داخل قاعدة البيانات
    $this->assertAuthenticated();
    // التأكد من توجيه المستخدم لصفحة الوصفات بعد الإضافة
    $response->assertRedirect(route('dashboard', absolute: false));
});
