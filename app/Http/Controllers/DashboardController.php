<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class DashboardController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        // ✅ Ambil data sensor dari Firebase
        $sensorData = $this->firebase->getSensorData();

        // ✅ Optional: Ambil jadwal pakan kalau mau
        $jadwalPakan = $this->firebase->getJadwalPakan();

        // ✅ Map data ke object sesuai yang dipakai di view
        $conditions = (object)[
            'tds' => $sensorData['tds'] ?? 0,
            'turbidity' => $sensorData['turbidity'] ?? 0,
            'ph_air' => $sensorData['ph'] ?? 0,
            'suhu_air' => $sensorData['suhu'] ?? 0,
            'tinggi_air' => $sensorData['tinggi_air'] ?? 0,
            'status_pakan' => $sensorData['status_pakan'] ?? false,
        ];        

        return view('dashboard', compact('conditions', 'jadwalPakan'));
    }

    public function getData()
{
    $sensorData = $this->firebase->getSensorData();

    $conditions = [
        'tds' => $sensorData['tds'] ?? 0,
        'turbidity' => $sensorData['turbidity'] ?? 0,
        'ph_air' => $sensorData['ph'] ?? 0,
        'suhu_air' => $sensorData['suhu'] ?? 0,
        'tinggi_air' => $sensorData['tinggi_air'] ?? 0,
        'status_pakan' => $sensorData['status_pakan'] ?? false,
    ];

    return response()->json($conditions);
}

}
