<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Matpel;
use App\Models\DataGuru;
use App\Models\Dashboard;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Models\AbsensiMatpel;
use App\Models\FingerprintGuru;
use App\Models\JadwalPelajaran;
use App\Models\DataAbsensiSiswa;
use App\Models\FingerprintModul;
use App\Models\FingerprintSiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->roles->contains('name', 'guru')) {
            $data = User::where('id', Auth::user()->id)->first();
            $idGuru = $data->guru->id;

            $now = Carbon::now();
            $hari = $now->isoFormat('dddd');
            // $hari = "Jumat";

            $dataMatpel = JadwalPelajaran::where('hari', $hari)
                ->where('id_guru', $idGuru)
                ->first();

            return view('dashboard.data', compact('dataMatpel'));
        } else {
            return view('dashboard.data');
        }
        // if (auth()->user()->role == 'guru') {
        //     $dataGuru = DataGuru::where('id_user', auth()->user()->id)->first();
        //     return view('dashboard.data', compact('dataGuru'));
        // }
        // $siswa = DataAbsensiSiswa::where('keterangan', 'terlambat')
        //     ->orWhere('keterangan', 'tanpa_keterangan')->get();

        // return view('dashboard.data', compact('siswa'));
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
        $totalUsers = User::count();
        $totalAbsensiMatpel = AbsensiMatpel::count();
        $totalJadwal = JadwalPelajaran::where('id_matpel', '!=', 28)->count(); // 28 adalah id untuk "Istirahat"

        return response()->json([
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalMatpel' => $totalMatpel,
            'totalJadwal' => $totalJadwal,
            'totalKelas' => $totalKelas,
            'totalFingerprintGuru' => $totalFingerprintGuru,
            'totalFingerprintSiswa' => $totalFingerprintSiswa,
            'totalAbsensiMatpel' => $totalAbsensiMatpel,
            'totalUsers' => $totalUsers
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $absensi = DataAbsensiSiswa::findOrFail($id);
        return response()->json($absensi);
    }

    public function cekStatusModul()
    {
        $statusModul = FingerprintModul::all();
        $currentTime = Carbon::now('Asia/Makassar');

        $fiveSecondsAgo = $currentTime->copy()->subSeconds(5);

        foreach ($statusModul as $modul) {
            $updatedAt = $modul->updated_at;

            if ($updatedAt->greaterThanOrEqualTo($fiveSecondsAgo)) {
                $modul->active = true;
            } else {
                $modul->active = false;
            }
        }

        return response()->json($statusModul);
    }

    public function cekOneStatusModul($modul)
    {
        $statusModul = FingerprintModul::where('modul_fingerprint', $modul)->first();
        $currentTime = Carbon::now('Asia/Makassar');

        $fiveSecondsAgo = $currentTime->copy()->subSeconds(5);

        $updatedAt = $statusModul->updated_at;

        if ($updatedAt->greaterThanOrEqualTo($fiveSecondsAgo)) {
            $statusModul->active = true;
        } else {
            $statusModul->active = false;
        }

        return response()->json($statusModul);
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
