<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(route('adminpanel', absolute: false));
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    /**
     * @throws ValidationException
     */
    public function checkEmail(Request $request)
    {
        $email = $request->query('email');
        if ($email) {
            $exists = User::where('email', $email)->exists();
            if (!$exists) {
                throw ValidationException::withMessages([
                    'email' => ['Email не найден.'],
                    'message' => 'Ваш email не зарегестрирован. Обратитесь в поддержку.'
                ]);
            }

            $user = User::where('email', $email)->first();

            if ($user->password == null) {
                return Inertia::render('Auth/Register', [
                    'email' => $email,
                    'status' => session('status'),
                ]);
            }

            return Inertia::render('Auth/Login', [
                'emailExists' => true,
                'message' =>  'Этот email уже зарегистрирован. Авторизуйтесь.',
                'alreadyReg' => true
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['Email в запросе отсутвует.'],
        ]);
    }
}
