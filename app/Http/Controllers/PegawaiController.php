<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Tampilkan daftar pegawai
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Tampilkan form untuk membuat data pegawai baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Simpan data pegawai yang baru dibuat dan buat akun pengguna
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username', // Pastikan username unik di tabel users
            'email' => 'required|email|unique:users,email', // Pastikan email unik di tabel users
            'alamat' => 'nullable|string',
            'password' => 'required|min:8', // Validasi password
        ]);

        // Buat data pegawai baru di tabel `pegawais`
        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => 'pegawai'
        ]);

        // Buat akun pengguna baru di tabel `users`
        User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai', // Atur role default sebagai 'pegawai'
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai dan akun berhasil ditambahkan.');
    }

    /**
     * Tampilkan data pegawai berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Tampilkan form untuk mengedit data pegawai
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Perbarui data pegawai
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:pegawais,username,' . $id,
        'email' => 'required|email|unique:pegawais,email,' . $id,
    ]);

    // Perbarui data pegawai
    $pegawai = Pegawai::findOrFail($id);
    $pegawai->update($request->all());

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
}

    /**
     * Hapus data pegawai
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
