<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService; // Import service FirebaseService

class SettingController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $jadwalPakan = $this->firebase->getJadwalPakan();


        return view('setting', compact('jadwalPakan'));
    }

    public function simpanJadwal(Request $request)
{
    $jadwalPagi = $request->input('jadwal_pagi');
    $jadwalSore = $request->input('jadwal_sore');
    $jadwalMalam = $request->input('jadwal_malem'); // Tambahan
    $jumlahTakar = $request->input('jumlah_takar');

    // Simpan data ke Firebase
    $this->firebase->getJadwalPakan()->set([
        'pagi' => $jadwalPagi,
        'sore' => $jadwalSore,
        'malem' => $jadwalMalam, // Tambahan
        'jumlah_takar' => $jumlahTakar
    ]);

    // Ambil jadwal pakan terbaru setelah update
    $jadwalPakan = $this->firebase->getJadwalPakan()->getValue();

    return redirect()->back()->with('message', 'Jadwal pakan berhasil disimpan ke Firebase!')
                         ->with('jadwalPakan', $jadwalPakan);
}
}
