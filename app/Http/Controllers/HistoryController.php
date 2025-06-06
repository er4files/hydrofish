<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index(Request $request)
    {
        // Ambil data history sensor dari Firebase Service
        $sensorLogs = $this->firebaseService->getHistoryData();

        // Pagination manual (10 data per halaman)
        $currentPage = $request->input('page', 1);
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;

        $paginatedData = array_slice($sensorLogs, $offset, $perPage);

        $sensorLogsPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedData,
            count($sensorLogs),
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );

        return view('history', ['sensorLogs' => $sensorLogsPaginated]);
    }
}
