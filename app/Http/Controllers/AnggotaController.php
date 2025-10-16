<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('anggota.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update(['role_id' => $request->role_id]);

        return back()->with('success', 'Role user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Cek apakah user mencoba menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // Cek apakah user yang dihapus adalah admin terakhir
        if ($user->role->nama === 'Admin' && User::where('role_id', $user->role_id)->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus admin terakhir!');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} berhasil dihapus!");
    }
}