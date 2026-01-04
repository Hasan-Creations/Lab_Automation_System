<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    // manage users and depts
    public function index()
    {
        $all_users = User::with('dept')->orderBy('full_name')->get();
        $depts = Department::all();
        return view('admin.settings.index', compact('all_users', 'depts'));
    }

    // add a new person
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'full_name' => 'required',
            'email' => 'nullable|email',
            'user_type' => 'required|in:admin,tester',
            'password' => 'required|min:6',
            'department_id' => 'required|exists:departments,id'
        ]);

        $dept = Department::findOrFail($request->department_id);

        User::create([
            'name' => $request->full_name,
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'department' => $dept->name,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->password),
            'is_active' => true
        ]);

        return back()->with('success', 'user added!');
    }

    // change user role or dept
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_type' => 'required|in:admin,tester',
            'department_id' => 'required|exists:departments,id'
        ]);

        $dept = Department::findOrFail($request->department_id);

        $user->update([
            'user_type' => $request->user_type,
            'department' => $dept->name,
            'department_id' => $request->department_id
        ]);

        return back()->with('success', 'updated.');
    }

    // delete someone
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // don't delete yourself lol
        if (Auth::id() == $id) {
            return back()->with('error', 'wait, you cant delete yourself.');
        }

        $user->delete();

        return back()->with('success', 'gone!');
    }
}
