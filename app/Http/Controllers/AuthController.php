<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('login');
    }

    public function viewSignup()
    {
        return view('signup');
    }

    public function postSignup(Request $request)
    {
        try {
            $path = null;
            $validate = Validator::make($request->all(), [
                "name" => "required",
                "profilePicture" => "nullable|mimes:png,jpg,jpeg",
                "email" => "required|email",
                "password" => "required"
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if ($request->file('profilePicture')) {
                try {
                    $profile = $request->file('profilePicture');
                    $profileName = time() . '_' . $profile->getClientOriginalName();
                    $path = $profile->storeAs('profiles', $profileName, 'public');
                } catch (\Exception $e) {
                    Storage::disk('public')->delete($path);
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }

            $newUser = new User([
                "name" => $request->name,
                "profile_picture" =>  $path ? $path : null,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
            $newUser->save();
            if ($this->authentiCate($request->email, $request->password)) {
                return redirect()->route('viewDashboard');
            }

            return redirect()->back()->with('error', 'Invalid login credentials...');
        } catch (Exception $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function postLogin(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required"
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if ($this->authentiCate($request->email, $request->password)) {
                return redirect()->route('viewDashboard');
            }

            return redirect()->back()->with('error', 'Invalid login credentials...');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function authentiCate($email, $password)
    {
        $credentials = [
            "email" => $email,
            "password" => $password,
        ];
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }
}
