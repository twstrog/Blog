<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function lastActive()
    {
        $activeThreshold = now()->subMinutes(5);
        $activeUsers = User::where('last_active', '>=', $activeThreshold)->get();

        return view('admin.users.index', compact('users'));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($user_id)
    {
        $users = User::find($user_id);
        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $user_id)
    {
        $users = User::find($user_id);
        if ($users) {
            $users->role_as = $request->role_as;
            $users->save();
            return redirect('admin/users')->with('status', 'User role updated successfully');
        }
        return redirect('admin/users')->with('error', 'User role not updated');
    }

    public function destroy($user_id)
    {
        $users = User::find($user_id);
        if ($users) {
            $users->delete();
            return redirect('admin/users')->with('status', 'User deleted successfully');
        }
        return redirect('admin/users')->with('error', 'User not found');
    }
}
