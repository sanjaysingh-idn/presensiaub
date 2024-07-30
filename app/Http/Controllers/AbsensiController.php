<?php

namespace App\Http\Controllers;

use App\Models\Makul;
use App\Models\Absensi;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        //
    }

    public function riwayatabsensi()
    {
        $getUserId = Auth::user()->id;
        $getAbsensi = Absensi::with('r_qrcode')->where('id_mahasiswa', $getUserId)->get();
        // dd($getAbsensi);
        return view('absensi.riwayatabsensi', [
            'title'     => 'Riwayat Absensi ' . Auth::user()->name,
            // 'qrcode'    => $getQrCode,
            'absensi'   => $getAbsensi,
        ]);
    }

    public function daftarabsensi()
    {
        $getUserId = Auth::user()->id;
        $getQrCode = Qrcode::with('r_author')
            ->where('author', $getUserId)
            ->get();
        // dd($getQrCode);
        // $getAbsensi = Absensi::where('id_qrcode', $getQrCode->id)->get();
        return view('absensi.daftarabsensi', [
            'title'     => 'Daftar Mata Kuliah Absensi',
            'qrcode'    => $getQrCode,
            // 'absensi'   => $getAbsensi,
        ]);
    }

    public function listabsen($id)
    {
        $getQrCode = Qrcode::with('r_author')
            ->where('id', $id)
            ->get();
        $getAbsensi = Absensi::with('r_mahasiswa')
            ->where('id_qrcode', $id)
            ->get();
        // dd($getQrCode);
        return view('absensi.listabsensi', [
            'title'     => 'Daftar Absensi',
            'qrcode'    => $getQrCode,
            'absensi'   => $getAbsensi,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    }

    public function show(Absensi $absensi)
    {
        //
    }

    public function edit(Absensi $absensi)
    {
        //
    }

    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    public function destroy(Absensi $absensi)
    {
        //
    }
}
