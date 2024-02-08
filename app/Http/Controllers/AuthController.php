<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index(): View
    {
        return view(('welcome'));
    }

    public function loginPage(): View
    {
        return view('auth.login');
    }

    public function registerPage(): View
    {
        return view('auth.register');
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            $data =  $request->only('name', 'email', 'password');
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return redirect("login")->withSuccess('Great! you have successfully registered');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function loginUser(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        try {
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard')
                    ->withSuccess('You have successfully logged in');
            } else {
                return back()->withErrors(['error' => 'You have entered invalid credentials!']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}