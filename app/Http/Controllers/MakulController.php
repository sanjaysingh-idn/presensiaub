<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Makul;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MakulController extends Controller
{
    public function index()
    {
        return view('makul.index', [
            'title'     => 'Mata Kuliah',
            'makul'     => Makul::all(),
            'jurusan'   => Jurusan::all(),
            'dosen'     => User::where('role', 'dosen')->get(),
        ]);
    }

    public function create()
    {
        // Menampilkan form untuk menambahkan mata kuliah baru
        return view('makul.create');
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data mata kuliah baru
        $request->validate([
            'kode_makul'    => 'required|string|max:255',
            'nama_makul'    => 'required|string|max:255',
            'prodi'         => 'required',
            'kelas'         => 'required',
            'nama_dosen'    => 'required',
            'ruangan'       => 'required',
            'jam'           => 'required'
        ]);

        Makul::create($request->all());

        return redirect()->route('makul.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function edit(Makul $makul)
    {
        // Menampilkan form untuk mengedit mata kuliah
        return view('makul.edit', compact('makul'));
    }

    public function update(Request $request, Makul $makul)
    {
        // Validasi dan update data mata kuliah
        $request->validate([
            'kode_makul'    => 'required|string|max:255',
            'nama_makul'    => 'required|string|max:255',
            'prodi'         => 'required',
            'kelas'         => 'required',
            'nama_dosen'    => 'required',
            'ruangan'       => 'required',
            'jam'           => 'required'
        ]);

        $makul->update($request->all());

        return redirect()->route('makul.index')->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy(Makul $makul)
    {
        // Hapus mata kuliah
        $makul->delete();

        return redirect()->route('makul.index')->with('success', 'Mata kuliah berhasil dihapus');
    }
}
