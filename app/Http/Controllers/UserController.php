<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = Role::query()->get();
        return view('users.form', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,'.$user->id,
            'role_id' => 'int',
        ]);

        $user->fill($validated_data);

        $user->save();

        session()->flash('message', 'User information has been updated successfully!');

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function delete(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        session()->flash('message', 'User has been deleted successfully!');

        return Redirect::back();
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new UsersExport(), 'HRMS-users-' . now()->toDateString() .'.xlsx');
    }
}
