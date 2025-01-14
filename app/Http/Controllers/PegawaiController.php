<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'nullable|string',
            'password' => 'required|min:8',
            'role' => 'required|in:Inspektur,Ketua Tim,Pegawai',
        ]);

        DB::transaction(function () use ($request) {
            $pegawai = Pegawai::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'role' => $request->role,
            ]);

            $user = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            $user->assignRole($request->role);
        });

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai dan akun berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:pegawais,username,' . $id,
        'email' => 'required|email|unique:pegawais,email,' . $id,
        'role' => 'required|in:Inspektur,Ketua Tim,Pegawai',
    ]);

    DB::transaction(function () use ($request, $id) {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->only(['nama', 'jabatan', 'username', 'email', 'alamat', 'role']));

        $user = User::where('email', $pegawai->email)->first();
        if ($user) {
            $user->update([
                'name' => $request->nama,
                'username' => $request->username,
                'role' => $request->role,
            ]);

            // Update role
            $user->syncRoles([$request->role]);
        }
    });

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
}


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pegawai = Pegawai::findOrFail($id);
            $user = User::where('email', $pegawai->email)->first();
            if ($user) {
                $user->delete();
            }
            $pegawai->delete();
        });

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}