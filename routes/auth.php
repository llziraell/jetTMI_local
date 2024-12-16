<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailCheckController;
use App\Http\Controllers\Feedback\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {


    Route::get('/admin/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/admin/register', [RegisteredUserController::class, 'store']);

    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/admin/login/check-email', [AuthenticatedSessionController::class, 'checkEmail'])->name('login.checkEmail');

    Route::get('/admin/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/admin/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/admin/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::put('/admin/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::post('/admin/email/check', [EmailCheckController::class, 'check'])
        ->name('email.check');

});

Route::middleware('auth')->group(function () {
    Route::get('/admin/verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('/admin/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/admin/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/admin/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('/admin/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('/admin/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('logout');

    Route::get('/admin/admin-panel', [FeedbackController::class, 'index'])->name('adminpanel');
    Route::get('/admin/admin-panel/{created_at}', [FeedbackController::class, 'created_at'])->name('feedbacks.filterByDate');
});
