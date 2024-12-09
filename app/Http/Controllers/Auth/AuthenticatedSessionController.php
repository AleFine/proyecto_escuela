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

        $user = Auth::user();

        return match ($user->rol) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'profesor' => redirect()->intended(route('profesor.dashboard', ['gmail' => $request->email])),
            'padre_familia' => redirect()->intended(route('padre_familia.dashboard', ['gmail' => $request->email])),
            default => throw new \Exception('Rol de usuario no válido'),
        };
    }


    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return match ($user->rol) {
                'admin' => redirect()->route('admin.dashboard'),
                'profesor' => redirect()->route('profesor.dashboard',['gmail' => $user->email]),
                'padre_familia' => redirect()->route('padre_familia.dashboard', ['gmail' => $user->email]),
                default => throw new \Exception('Rol de usuario no válido'),
            };
        }

        return redirect("login")->withSuccess('No tienes acceso.');
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
