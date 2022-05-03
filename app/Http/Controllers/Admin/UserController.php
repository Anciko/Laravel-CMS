<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required|min:6|max:15"
        ]);
        if ($validated) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->about = 'About your information';

                if ($profile->save())
                    return redirect()->route('user.index')->with('success', 'User Profile is created successfully!');
                else
                    return redirect()->back()->with('error', 'User Profile is created Fail!');
            } else {
                return redirect()->back()->with('error', 'User Profile is created Fail!');
            }
        }
    }

    public function edit()
    {
        $id = auth()->user()->id;
        $user = User::find($id)->load('profile');
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required",
            "about" => "required|min:10"
        ]);

        if ($validated) {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $profile = Profile::find($user->id);

            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            if ($user->update()) {
                $profile = Profile::find($user->id);
                $profile->about = $request->about;
                $profile->facebook_link = $request->facebook_link;
                $profile->youtube_link = $request->youtube_link;

                if ($request->hasFile('image')) {
                    $file = $request->file('image'); // See from github, i can't keep coding so hot.
                    $imageName = uniqid() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/profile/', $imageName);
                    $profile->profile_image = $imageName;
                }
                $profile->update();
                return redirect()->route('user.index')->with('success', 'User Profile is updated successfully!');
            } else {
                return redirect()->back()->with('error', 'User Profile is updated Fail!');
            }
        }
    }

    public function userPermission($roleid, $userid) {
        $user = User::find($userid);
        $user->is_admin = $roleid;
        $user->update();
        return redirect()->back()->with('success',"Permission access successfully");
    }
}
