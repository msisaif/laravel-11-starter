<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return
        $users = User::query()
            ->latest()
            ->paginate();

        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();

        return view("admin.users.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $user = User::create(
            $this->getValidatedData($request)
            + $this->getValidatedPasswordData($request)
        );

        return to_route('dashboard.users.show', $user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return to_route('dashboard.users.index', [
            'user' => $user->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update(
            $this->getValidatedData($request, $user->id)
            + ($request->password
                ? $this->getValidatedPasswordData($request)
                : [])
        );

        return to_route('dashboard.users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    protected function getValidatedData($request, $id = '')
    {
        return $request->validate([
            "name" => "required|string",
            "email" => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
        ]);
    }

    protected function getValidatedPasswordData($request)
    {
        $validated_data = $request->validate([
            "password" => "required|string|confirmed|min:3",
        ]);

        return [
            "password" => Hash::make($validated_data["password"]),
        ];
    }
}
