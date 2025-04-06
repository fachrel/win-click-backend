<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     */
    public function index()
    {
        $users = User::latest()->get();
        
        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     *
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'user' => $user
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     *
     */
    public function show(User $user)
    {
        if (request()->ajax()) {
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at->format('F d, Y'),
                'updated_at' => $user->updated_at->format('F d, Y')
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Only update password if a new one is provided
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'user' => $user
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     */
    public function destroy(User $user)
    {
        $user->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}