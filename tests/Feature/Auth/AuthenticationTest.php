<?php

use App\Models\User;

// 1. اختبار عرض صفحة تسجيل الدخول
test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

// 2. اختبار تسجيل الدخول باستخدام بيانات اعتماد صالحة
test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

// 3. اختبار الأمان ضد كلمات المرور غير الصحيحة
test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

// 4. اختبار تسجيل الخروج الآمن
test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
