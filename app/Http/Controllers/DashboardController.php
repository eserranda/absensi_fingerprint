<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Matpel;
use App\Models\DataGuru;
use App\Models\Dashboard;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Models\FingerprintGuru;
use App\Models\JadwalPelajaran;
use App\Models\FingerprintSiswa;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data');
    }

    // DashboardController.php

    public function count_data()
    {
        $totalGuru = DataGuru::count();
        $totalSiswa = DataSiswa::count();
        $totalMatpel = Matpel::count();
        $totalKelas = Kelas::count();
        $totalFingerprintGuru = FingerprintGuru::count();
        $totalFingerprintSiswa = FingerprintSiswa::count();
        // $totalJadwal = JadwalPelajaran::count();
        $totalJadwal = JadwalPelajaran::where('id_matpel', '!=', 28)->count();


        return response()->json([
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalMatpel' => $totalMatpel,
            'totalJadwal' => $totalJadwal,
            'totalKelas' => $totalKelas,
            'totalFingerprintGuru' => $totalFingerprintGuru,
            'totalFingerprintSiswa' => $totalFingerprintSiswa
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
