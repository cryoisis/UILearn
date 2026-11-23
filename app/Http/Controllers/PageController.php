<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'courses' => config('courses'),
            'presets' => collect(config('uilearn.presets'))->map(fn ($p, $slug) => ['id' => $slug, 'q' => $p['q'], 'a' => $p['a']])->values(),
        ]);
    }

    public function about()
    {
        return view('about', ['courses' => config('courses')]);
    }

    public function courses()
    {
        return view('kursus.index', ['courses' => config('courses')]);
    }

    public function lesson(string $slug)
    {
        $courses = config('courses');
        abort_unless(isset($courses[$slug]), 404);

        return view('kursus.materi', ['slug' => $slug, 'course' => $courses[$slug]]);
    }

    public function exercise(string $slug)
    {
        $courses = config('courses');
        abort_unless(isset($courses[$slug]), 404);

        $course = $courses[$slug];
        $user = auth()->user();
        $plans = config('uilearn.plans');

        return view('kursus.latihan', [
            'slug' => $slug,
            'course' => $course,
            'aiAllowed' => $plans[$user->plan]['exercise_ai'] ?? false,
        ]);
    }

    public function subscription()
    {
        return view('berlangganan', ['plans' => config('uilearn.plans'), 'price' => config('uilearn.price_pro')]);
    }
}
