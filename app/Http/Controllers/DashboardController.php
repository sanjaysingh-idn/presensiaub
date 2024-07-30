<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('page.dashboard', [
            'title'     => 'Dashboard',
            'dosen'     => User::where('role', 'dosen')->count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'fakultas'  => Fakultas::count(),
            'fakultas'  => Fakultas::count(),
            'jurusan'   => Jurusan::count(),
        ]);
    }
}
