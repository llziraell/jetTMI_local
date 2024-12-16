<?php

use App\Http\Controllers\Feedback\FeedbackController;
use Illuminate\Support\Facades\Route;


Route::get('/home', [FeedbackController::class, 'create'])->name('feedback.create');

Route::post('/home', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/admin/admin-panel');
    }
    return redirect('/home');
});

Route::get('/admin', function () {
    if (auth()->check()) {
        return redirect('/admin/admin-panel');
    }
    return redirect('/admin/login');
});

Route::get('/admin/login', function () {
        if (auth()->check()) {
            return redirect('/admin/admin-panel');
        }
        return app(App\Http\Controllers\Auth\AuthenticatedSessionController::class)->create();
    })->name('login');

Route::fallback(function () {
    $currentPath = request()->path(); // Получаем текущий путь

    if (str_starts_with($currentPath, 'admin')) {
        return redirect('/admin');
    }

    return redirect('/home');
});

require __DIR__.'/auth.php';
