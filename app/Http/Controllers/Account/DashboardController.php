<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Domain\Courses\Models\CourseAccessGrant;

class DashboardController extends Controller
{
    public function index(): View
    {
        $grants = CourseAccessGrant::with('course')
            ->where('user_id', auth()->id())
            ->active()
            ->get();

        return view('account.dashboard', compact('grants'));
    }

    public function courses(): View
    {
        $grants = CourseAccessGrant::with(['course.modules.publishedLessons'])
            ->where('user_id', auth()->id())
            ->active()
            ->get();

        return view('account.courses', compact('grants'));
    }

    public function profile(): View
    {
        return view('account.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->name  = $data['name'];
        $user->phone = $data['phone'] ?? $user->phone;

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return back()->with('success', 'Профиль обновлён.');
    }

    public function orders(): View
    {
        $orders = auth()->user()->orders()->with('course')->orderByDesc('created_at')->paginate(10);
        return view('account.orders', compact('orders'));
    }
}
