<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::with('branch');

        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // Filter by role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // Filter by branch
        if ($request->branch_id) {
            $query->where('branch_id', $request->branch_id);
        }

        // Sort
        $sortField = $request->sort_by ?? 'created_at';
        $sortDirection = $request->sort_direction ?? 'desc';
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate($request->per_page ?? 10);
        $branches = Branch::all();

        return view('admin.users.index', compact('users', 'branches'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        // Verificar si el usuario tiene permiso para crear usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.users.index')
                ->with('error', __('users.unauthorized_edit'));
        }
        
        $branches = Branch::all();
        return view('admin.users.create', compact('branches'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        // Verificar si el usuario tiene permiso para crear usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.users.index')
                ->with('error', __('users.unauthorized_edit'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:super_admin,manager,supervisor,user'],
            'branch_id' => ['required', 'exists:branches,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.user_created'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        // Verificar si el usuario tiene permiso para editar usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.users.index')
                ->with('error', __('users.unauthorized_edit'));
        }
        
        $branches = Branch::all();
        return view('admin.users.edit', compact('user', 'branches'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        // Verificar si el usuario tiene permiso para actualizar usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.users.index')
                ->with('error', __('users.unauthorized_edit'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:super_admin,manager,supervisor,user'],
            'branch_id' => ['required', 'exists:branches,id'],
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->branch_id = $request->branch_id;
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.user_updated'));
    }

    /**
     * Toggle user status
     */
    public function toggleStatus(User $user)
    {
        // Verificar si el usuario tiene permiso para cambiar el estado de los usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return response()->json([
                'success' => false,
                'message' => __('users.unauthorized_edit')
            ], 403);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => __('users.success.status_updated'),
            'is_active' => $user->is_active
        ]);
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Verificar si el usuario tiene permiso para eliminar usuarios
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.users.index')
                ->with('error', __('users.unauthorized_edit'));
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', __('messages.cannot_delete_self'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.user_deleted'));
    }
}
