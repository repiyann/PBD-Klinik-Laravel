<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function viewProfile(): View
    {
        return view('user.profile');
    }

    public function viewRecord(): View
    {
        return view('user.record');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user = User::find($user->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('viewProfile')->with('success', 'Account settings updated successfully.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|confirmed',
        ]);

        $user = User::find($user->id);

        #Match The Old Password
        if (!Hash::check($request->input('oldPassword'), $user->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with("status", "Password changed successfully!");
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $user = User::find($user->id);
        $user->delete();

        return redirect()->route('/')->with('success', 'Account deleted successfully.');
    }
}
