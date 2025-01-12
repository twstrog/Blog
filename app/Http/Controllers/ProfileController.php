<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // Profile
    public function edit()
    {
        $userId = Auth::id();
        $profile = User::find($userId);
        return view('auth.profile', compact("profile"));
    }

    // Update profile
    public function update(Request $request)
    {
        $userId = Auth::id();
        $profile = User::find($userId);
        $profile->name = $request->input('name');

        $description = $request->input('description');
        $maxLength = 255; // Độ dài tối đa của cột description
        if (strlen($description) > $maxLength) {
            $description = substr($description, 0, $maxLength);
        }
        $profile->description = $description;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $old_avatar = 'uploads/avatar/' . $profile->avatar;
            if (File::exists($old_avatar)) {
                File::delete($old_avatar);
            }
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/avatar/', $filename);
            $profile->avatar = $filename;
        }
        $profile->save();
        return redirect()->back()->with('status', 'Update Profile Successful');
    }
}
