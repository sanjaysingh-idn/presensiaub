<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function dosen()
    {
        return view('page.data_dosen', [
            'title'     => 'Data Dosen',
            'user'      => User::where('role', 'dosen')->get(),
            // 'jurusan'   => Jurusan::all(),
        ]);
    }

    public function dosen_store(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'nip'           => 'required|max:255',
            'jabatan'       => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tempat'        => 'required|max:255',
            'tgl_lahir'     => 'required',
            'kontak'        => 'required|max:255',
            'alamat'        => 'required|max:255',
            'email'         => 'required|email|max:255',
            'password'      => 'required',
        ]);

        $attr['password'] = Hash::make($request->password);

        $attr['role'] = 'dosen';

        try {
            User::create($attr);
            return redirect()->back()->with('message', 'Dosen berhasil ditambah');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                return redirect()->back()->with('error', 'Email Sudah Dipakai. Gunakan alamat email lain');
            }
            // Handle other possible database errors
            return redirect()->back()->with('error', 'There was an error adding the mahasiswa. Please try again.');
        }
    }

    public function mahasiswa()
    {
        return view('page.data_mahasiswa', [
            'title'     => 'Data mahasiswa',
            'user'      => User::where('role', 'mahasiswa')->get(),
            'jurusan'   => Jurusan::all(),
            'fakultas'  => Fakultas::all(),
        ]);
    }

    public function mahasiswa_store(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'nim'           => 'required|max:255',
            'fakultas'      => 'required|max:255',
            'jurusan'       => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tempat'        => 'required|max:255',
            'tgl_lahir'     => 'required',
            'kontak'        => 'required|max:255',
            'alamat'        => 'required|max:255',
            'email'         => 'required|email|max:255',
            'password'      => 'required',
        ]);

        $attr['prodi']      = $request->jurusan;
        $attr['password']   = Hash::make($request->password);

        $attr['role']       = 'mahasiswa';

        try {
            User::create($attr);
            return redirect()->back()->with('message', 'Mahasiswa berhasil ditambah');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                return redirect()->back()->with('error', 'Email Sudah Dipakai. Gunakan alamat email lain');
            }
            // Handle other possible database errors
            return redirect()->back()->with('error', 'There was an error adding the mahasiswa. Please try again.');
        }
    }

    public function mahasiswa_update(Request $request, $id)
    {
        // Validasi data
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'nim'           => 'required|max:255',
            'fakultas'      => 'required|max:255',
            'jurusan'       => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tempat'        => 'required|max:255',
            'tgl_lahir'     => 'required',
            'kontak'        => 'required|max:255',
            'alamat'        => 'required|max:255',
            'email'         => 'required|email|max:255',
            'password'      => 'sometimes|nullable',
        ]);

        // Cari user berdasarkan id
        $user = User::findOrFail($id);

        // Jika password disertakan dan tidak kosong, hash password baru
        if (!empty($request->password)) {
            $attr['password'] = Hash::make($request->password);
        } else {
            // Jika password tidak disertakan, tetap gunakan password lama
            unset($attr['password']);
        }

        // Update data mahasiswa
        $attr['prodi'] = $request->jurusan;
        $user->update($attr);

        return redirect()->back()->with('message', 'Mahasiswa berhasil diperbarui');
    }

    public function profil($id)
    {
        $getProfil = User::findOrFail($id);
        return view('page.profil', [
            'title'     => 'Data mahasiswa',
            'profil'    => $getProfil,
            'jurusan'   => Jurusan::all(),
            'fakultas'  => Fakultas::all(),
        ]);
    }

    public function updateprofil(Request $request)
    {
        // $attr = $request->validate([
        //     'name'      => 'required|max:255',
        //     'nip'       => 'required', 'unique:users,nip,' . auth()->user()->nip, 'max:30',
        //     'contact'   => 'required|min:10|max:15',
        //     'email'     => 'required|email:dns|max:150',
        //     'address'   => 'required|max:255',
        //     'image'     => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000,ratio=1/1',
        // ]);

        // if ($request->file('image')) {
        //     Storage::delete(Auth::user()->image);
        //     $attr['image'] = $request->file('image')->store('profile-image');
        // } else {
        //     $attr['image'] = Auth::user()->image;
        // }

        // auth()->user()->update($attr);

        // return back()->with('message', 'Profil berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'Data Mahasiswa/Dosen berhasil dihapus');
    }
}
