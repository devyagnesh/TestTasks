<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $isUserAdmin = Auth::user()->isAdmin;

        if ($isUserAdmin) {
            $otherUsers = User::where('id', '!=', auth()->user()->id)->get()->toArray();
            return view('admin.dashboard', compact('otherUsers'));
        }
        $me = auth()->user();
        return view('dashboard', compact('me'));
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'logged out !');
    }


    public function deleteUser($id)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'user not found with id ' . $id);
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'user not found with id ' . $id);
        }

        $user->delete();
        return redirect()->back()->with('success', 'user has been deleted !');
    }


    //Updating


    public function viewUpdateProfile(Request $request, $id)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'user not found with id ' . $id);
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'user not found with id ' . $id);
        }


        return view('admin.update', compact('user'));
    }

    public function postUpdateProfile(Request $request)
    {
        try {
            $userid = $request->id;
            if (!$userid) {
                return redirect()->back()->with('error', 'user not found with id ' . $userid);
            }

            $user = User::find($userid);
            $validate = Validator::make($request->all(), [
                "profilePicture" => "mimes:png,jpg,jpeg",
                "name" => "required",
                "email" => "required|email",
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            if ($request->file('profilePicture')) {
                try {
                    $profile = $request->file('profilePicture');
                    $profileName = time() . '_' . $profile->getClientOriginalName();
                    $path = $profile->storeAs('profiles', $profileName, 'public');
                    $user->profile_picture ? Storage::delete($user->profile_picture) : null;
                    $user->profile_picture = $path;
                } catch (\Exception $e) {
                    Storage::disk('public')->delete($path);
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
           
          
           
            $user->name = $request->name;
            $user->email = $request->email;
           

            //remove old profile picture from storage
           
            $user->save();
            return redirect()->route('viewDashboard')->with('success', 'user updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
