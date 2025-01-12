<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function tools()
    {
        return view('admin.tools');
    }

    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $users = User::where('role_as', '0')->count();
        $admins = User::where('role_as', '1')->count();
        return view('admin.dashboard', compact('categories', 'posts', 'users', 'admins'));
    }

    // Profile
    public function edit()
    {
        $userId = Auth::id();
        $profile = User::find($userId);
        return view('admin.profile', compact("profile"));
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
