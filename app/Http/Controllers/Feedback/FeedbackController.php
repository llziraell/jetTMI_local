<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedbackController extends Controller
{
    public function create()
    {
        return inertia('Landing/HomePage');
    }

    public function store(Request $request)
    {
        $recaptchaToken = $request->input('recaptcha_token');

        if (!$recaptchaToken) {
            return back()->withErrors(['captcha' => 'Токен reCAPTCHA отсутствует.']);
        }

        $recaptchaResponse = Http::asForm()->withOptions(['verify' => false])->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptchaToken,
            'remoteip' => $request->ip(),
        ]);

        $recaptchaResult = $recaptchaResponse->json();

        if (!isset($recaptchaResult['success']) || !$recaptchaResult['success']) {
            return back()->withErrors(['captcha' => 'Ошибка проверки reCAPTCHA. Пожалуйста, попробуйте еще раз.']);
        }


        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|max:600',
            'phone_number' => 'required|string',
        ]);

        $validated['ip_address'] = $request->ip()?? '127.0.0.1';

        $validated['created_at'] = now();

        $validated['website'] = $request->getHost();

        Feedback::create($validated);

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв!');
    }


    public function index()
    {
        $feedbacks = Feedback::all();

        $websites = Feedback::query()
            ->groupBy('website')
            ->pluck('website');
        return inertia('Admin/AdminPage', ['feedbacks' => $feedbacks, 'websites' => $websites]);
    }


    public function created_at(Request $request)
    {
        $datetime = $request->query('date');

        if ($datetime) {

            $results = Feedback::whereDate('created_at', $datetime)->get();

            return inertia('Admin/AdminPage', ['results' => $results]);
        }

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв!');
    }

    public function uniqueWebsites() {
        $websites = Feedback::query()
            ->groupBy('website')
            ->pluck('website');

        return inertia('Admin/AdminPage', ['websites' => $websites]);
    }

    public function byWebsite(Request $request) {
        if ($request->has('website')) {
            $website = Feedback::query()
                ->where('website', $request->get('website'))
                ->get();

            return inertia('Admin/AdminPage', ['website' => $website]);
        }

        return inertia('Admin/AdminPage', ['websites' => []]);
    }
}
