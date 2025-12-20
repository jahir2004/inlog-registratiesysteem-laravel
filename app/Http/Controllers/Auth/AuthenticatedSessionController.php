<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Role-based redirection
        $user = auth()->user();
        if ($user->rolename === 'admin') {
            return redirect()->intended(route('admin.index', absolute: false));
        } elseif ($user->rolename === 'tandarts') {
            return redirect()->intended(route('tandarts.index', absolute: false));
        } elseif ($user->rolename === 'tester') {
            return redirect()->intended(route('tester.index', absolute: false));
        } elseif ($user->rolename === 'tandarts2') {
            return redirect()->intended(route('tandarts2.index', absolute: false));
        } elseif ($user->rolename === 'voorbeeld') {
            return redirect()->intended(route('voorbeeld.index', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
