<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function viewProfile(): View
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'errorUpdateProfile')->withInput();
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return redirect()->back()->with('success', 'Account settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating account settings.');
        }
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'oldPassword' => 'required',
                'newPassword' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'errorUpdatePassword')->withInput();
            }

            #Match The Old Password
            if (!Hash::check($request->input('oldPassword'), $user->password)) {
                return back()->with("error", "Old Password Doesn't match!");
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();

            return back()->with("status", "Password changed successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the password.');
        }
    }

    public function deleteAccount(): RedirectResponse
    {
        try {
            $user = Auth::user();
            $user->delete();

            return redirect()->route('/')->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the account.');
        }
    }
}
