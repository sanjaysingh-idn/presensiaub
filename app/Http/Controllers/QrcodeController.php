<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Log;
use App\Models\User;
use App\Models\Makul;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Qrcode as QrcodeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index()
    {
        // Mengambil ID QR code dari session
        $createdQrCodeId = Session::get('createdQrCodeId');

        return view('qrcode.index', [
            'title'     => 'QR Code',
            'qr'        => QrcodeModel::all(),
            'makul'     => Makul::all(),
            'dosen'     => User::where('role', 'dosen')->get(),
            'qrcode'    => QrcodeModel::find($createdQrCodeId)
        ]);
    }

    function generate(Request $request)
    {
        $getAuthor = Auth::user()->id;
        $getIdMakul = $request->id_makul;
        $getDay = $request->day;
        $getHour = Carbon::now()->format('H:i');

        $getMakul = Makul::findOrFail($getIdMakul);

        // Create a new QR code record
        $qrcode = QrcodeModel::create([
            'id_makul' => $getIdMakul,
            'author' => $getAuthor,
            'kode_makul' => $getMakul->kode_makul,
            'nama_makul' => $getMakul->nama_makul,
            'prodi' => $getMakul->prodi,
            'kelas' => $getMakul->kelas,
            'dosen' => $getMakul->nama_dosen,
            'ruangan' => $getMakul->ruangan,
            'hari' => $getDay,
            'jam' => $getHour,
            'qrcode' => '', // This will be updated with the actual QR code string
        ]);

        // Generate the QR code with only the `id` of the QrcodeModel record
        $qrcodeData = $qrcode->id;
        $qrCodeSvg = QrCode::size(300)->generate($qrcodeData);

        // Update the QrcodeModel record with the QR code string
        $qrcode->update(['qrcode' => $qrCodeSvg]);

        // Pass the Makul data and QR code SVG to the view
        return view('qrcode.show', [
            'title' => 'QR Code',
            'makul' => $getMakul,
            'qrcode' => $qrCodeSvg,
            'day' => $getDay,
            'hour' => $getHour,
        ]);
    }

    public function scanpage()
    {
        return view('qrcode.scan', [
            'title'  => 'Scan QR Code',
        ]);
    }

    public function scanqrcode(Request $request)
    {
        $getIdMahasiswa = Auth::user()->id; // Get the authenticated user ID
        $getIdQrCode = $request->qr_code; // Get the scanned QR code ID

        // Save QR code information to the database
        $absensi = new Absensi();
        $absensi->id_mahasiswa = $getIdMahasiswa;
        $absensi->id_qrcode = $getIdQrCode;
        $absensi->hari = now()->toDateString();
        $absensi->jam = now()->toTimeString();
        $absensi->save();

        return back()->with('message', 'Absensi berhasil');
        // return response()->json(['message' => 'Absensi Berhasil']);
    }

    public function store(Request $request)
    {
    }

    public function show(Qrcode $qrcode)
    {
        //
    }

    public function edit(Qrcode $qrcode)
    {
        //
    }

    public function update(Request $request, Qrcode $qrcode)
    {
        //
    }

    public function destroy(QrcodeModel $qrcode)
    {
        // Hapus mata kuliah
        $qrcode->delete();

        return redirect()->route('qrcode.index')->with('success', 'QRCode berhasil dihapus');
    }
}
