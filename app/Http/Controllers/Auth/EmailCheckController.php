<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class EmailCheckController extends Controller
{
    /**
     * Проверка существования email.
     * @throws ValidationException
     */
  public function check(Request $request)
  {

    $request->validate([
      'email' => 'required|email',
    ]);

    $exists = User::where('email', $request->email)->exists();

    if (!$exists) {
      throw ValidationException::withMessages([
        'email' => ['Email не найден.'],
      ]);
    }

    return Inertia::render('Auth/Login', [
      'emailExists' => true,
    ]);
  }
}
