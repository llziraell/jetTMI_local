<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AssignmentCreated;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function store(Request $request): RedirectResponse
    {
        User::query()
            ->where(
                'email', $request->email)->update(
                array(
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                )
            );

        $user = User::query()
            ->where('email', $request->email)
            ->first();



        Mail::to($user->email)->send(new AssignmentCreated($user));

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('adminpanel', absolute: false));
    }
}
