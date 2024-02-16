<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Models\DataAbsensiSiswa;
use App\Models\FingerprintSiswa;
use Yajra\DataTables\Facades\DataTables;

class DataAbsensiSiswaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterTanggal = $request->input('tanggal');

            $query = DataAbsensiSiswa::query();
            if ($filterTanggal) {
                $query->whereDate('tanggal_absen', $filterTanggal);
            } else {
                $timezone = 'Asia/Makassar';
                $now = Carbon::now();
                $now->setTimezone($timezone);
                $filterTanggal = $now->toDateString();

                $query->whereDate('tanggal_absen', $filterTanggal);
            }

            $filterTanggal = $query->latest('created_at')->get();
            return DataTables::of($filterTanggal)
                ->addIndexColumn()
                ->addColumn('id_siswa', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="/rekap-absensi-siswa/absensi/' . $row->siswa->id . '">
                   <span class="badge  bg-azure-lt text-bg-danger">Data Absensi</span>
                    </a>
                    <button class="btn btn-sm btn-primary btn-icon" aria-label="Button" onclick="edit(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                </button>
            ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('data_absensi_siswa.data');

        // $data = DataAbsensiSiswa::all();
        // return view('data_absensi_siswa.data', compact('data'));
    }

    public function prosesAbsensi(Request $request)
    {
        // Ambil tanggal absensi dari request
        $tanggalAbsensi = $request->input('tanggal_absensi');

        // Periksa apakah tanggal absensi jatuh pada hari Sabtu
        $hariAbsensi = date('N', strtotime($tanggalAbsensi)); // Mendapatkan hari dalam bentuk angka (1 untuk Senin, 7 untuk Minggu)

        // Jika hari absensi adalah Sabtu (6), tambahkan entri absensi untuk Minggu
        if ($hariAbsensi == 6) {
            // Tambahkan entri absensi untuk Minggu dengan keterangan hari libur
            DataAbsensiSiswa::create([
                'id_siswa' => $request->input('id_siswa'),
                'tanggal_absensi' => Carbon::parse($tanggalAbsensi)->addDay()->format('Y-m-d'), // Menambahkan 1 hari untuk mendapatkan hari Minggu
                'keterangan' => 'Libur'
            ]);
        }

        // Lanjutkan proses absensi seperti biasa
        // ...
    }


    public function absensi($id)
    {
        Carbon::setLocale('id');

        $absensi = DataAbsensiSiswa::where('id_siswa', $id)
            ->orderBy('tanggal_absen', 'desc')
            ->get();

        foreach ($absensi as $data) {
            $tanggalAbsen = Carbon::parse($data->tanggal_absen);
            $data->hari = $tanggalAbsen->isoFormat('dddd');
            $data->tanggal_absen = $tanggalAbsen->format('d-m-Y');
        }

        return response()->json($absensi);
    }

    public function countAbsensi($id)
    {
        $totalAbsen = DataAbsensiSiswa::where('id_siswa', $id)->where('keterangan', 'Hadir')->count();
        $terlambat = DataAbsensiSiswa::where('id_siswa', $id)->where('keterangan', 'Terlambat')->count();
        $izin = DataAbsensiSiswa::where('id_siswa', $id)->where('keterangan', 'Izin')->count();
        $sakit = DataAbsensiSiswa::where('id_siswa', $id)->where('keterangan', 'Sakit')->count();
        $tanpaKeterangan = DataAbsensiSiswa::where('id_siswa', $id)->where('keterangan', 'Tanpa Keterangan')->count();

        $result = [
            'total_absen' => $totalAbsen,
            'terlambat' => $terlambat,
            'izin' => $izin,
            'sakit' => $sakit,
            'tanpa_keterangan' => $tanpaKeterangan,
        ];

        return response()->json($result);
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
    public function show(DataAbsensiSiswa $dataAbsensiSiswa, $id)
    {
        $data = DataSiswa::find($id);
        return view('data_absensi_siswa.absensi', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }
}
