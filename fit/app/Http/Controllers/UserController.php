<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/users'), $photoName);
            $user->photo = 'uploads/users/' . $photoName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('admin.users.index');
    }

    public function list()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    public function updateStatus(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully', 'user' => $user]);
    }

    public function updateRole(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $request->validate([
            'role' => ['required', 'string', Rule::in(['user', 'admin'])],
        ]);

        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'User role updated successfully', 'user' => $user]);
    }
}