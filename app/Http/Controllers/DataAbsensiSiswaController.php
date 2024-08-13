<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\AbsensiMatpel;
use App\Models\JadwalPelajaran;
use Illuminate\Validation\Rule;
use App\Models\DataAbsensiSiswa;
use App\Models\FingerprintSiswa;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DataAbsensiSiswaController extends Controller
{

    public function rekapKehadiranSiswaPerSemester(Request $request)
    {
        $id_guru = Auth::user()->id_guru;
        $kelas = Kelas::where('id_guru', $id_guru)->first();

        return view('rekap-absensi-kehadiran.index', compact('kelas'));
    }

    public function rekapAbsesniMatpelSiswaPerSemester(Request $request)
    {
        $id_guru = Auth::user()->id_guru;

        $matpel = JadwalPelajaran::where('id_guru', $id_guru)
            ->select('id_guru', 'id_matpel', 'kelas')
            ->groupBy('id_guru', 'id_matpel', 'kelas')
            ->get();

        return view('rekap-absensi-matpel.index', compact('matpel'));
    }


    public function getWithFilterMatpel(Request $request)
    {
        if ($request->ajax()) {
            $id_guru = Auth::user()->id_guru;

            $kelas = $request->input('kelas');
            $semester = $request->input('semester');
            $tahunAjaran = $request->input('tahun_ajaran');

            // Query dasar
            $query = AbsensiMatpel::where('id_guru', $id_guru);

            // dd($query);
            if ($kelas) {
                $query->where('kelas', $kelas);
            }
            if ($semester) {
                $query->where('semester', $semester);
            }
            if ($tahunAjaran) {
                $query->where('tahun_ajaran', $tahunAjaran);
            }
            // Eksekusi query dan ambil data
            // $data = $query->latest('created_at')->get();
            $data = $query->select('id_siswa', 'id_matpel', 'id_guru',  'kelas', 'semester', 'tahun_ajaran')
                ->selectRaw('SUM(CASE WHEN keterangan = "Hadir" THEN 1 ELSE 0 END) as total_hadir')
                ->selectRaw('SUM(CASE WHEN keterangan = "Sakit" THEN 1 ELSE 0 END) as total_sakit')
                ->selectRaw('SUM(CASE WHEN keterangan = "Izin" THEN 1 ELSE 0 END) as total_izin')
                ->selectRaw('SUM(CASE WHEN keterangan = "Tanpa Keterangan" THEN 1 ELSE 0 END) as total_tanpa_keterangan')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('id_siswa', 'id_matpel', 'id_guru', 'kelas', 'semester', 'tahun_ajaran')
                ->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_siswa', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('id_matpel', function ($row) {
                    if ($row->id_matpel) {
                        return $row->matpel->nama_matpel;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->guru->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('semester', function ($row) {
                    return $row->semester . ' - ' . $row->tahun_ajaran;
                })
                ->addColumn('hadir', function ($row) {
                    return $row->total_hadir;
                })
                ->addColumn('sakit', function ($row) {
                    return $row->total_sakit;
                })
                ->addColumn('tanpa_keterangan', function ($row) {
                    return $row->total_tanpa_keterangan;
                })
                ->addColumn('izin', function ($row) {
                    return $row->total_izin;
                })
                ->addColumn('total', function ($row) {
                    return $row->total;
                })
                ->make(true);
        }
    }

    public function getWithFilterKelas(Request $request, $kelas)
    {
        if ($request->ajax()) {
            $semester = $request->input('semester');
            $tahunAjaran = $request->input('tahun_ajaran');

            // Query dasar
            $query = DataAbsensiSiswa::where('kelas', $kelas);
            if ($semester) {
                $query->where('semester', $semester);
            }
            if ($tahunAjaran) {
                $query->where('tahun_ajaran', $tahunAjaran);
            }

            // Preload counts for different attendance statuses
            $data = $query->select('id_siswa', 'kelas', 'semester', 'tahun_ajaran')
                ->selectRaw('SUM(CASE WHEN keterangan = "Hadir" THEN 1 ELSE 0 END) as total_hadir')
                ->selectRaw('SUM(CASE WHEN keterangan = "Sakit" THEN 1 ELSE 0 END) as total_sakit')
                ->selectRaw('SUM(CASE WHEN keterangan = "Terlambat" THEN 1 ELSE 0 END) as total_terlambat')
                ->selectRaw('SUM(CASE WHEN keterangan = "Tanpa Keterangan" THEN 1 ELSE 0 END) as total_tanpa_keterangan')
                ->selectRaw('SUM(CASE WHEN keterangan = "Izin" THEN 1 ELSE 0 END) as total_izin')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('id_siswa', 'kelas', 'semester', 'tahun_ajaran')
                ->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_siswa', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('semester', function ($row) {
                    return $row->semester . ' - ' . $row->tahun_ajaran;
                })
                ->addColumn('hadir', function ($row) {
                    return $row->total_hadir;
                })
                ->addColumn('sakit', function ($row) {
                    return $row->total_sakit;
                })
                ->addColumn('terlambat', function ($row) {
                    return $row->total_terlambat;
                })
                ->addColumn('tanpa_keterangan', function ($row) {
                    return $row->total_tanpa_keterangan;
                })
                ->addColumn('izin', function ($row) {
                    return $row->total_izin;
                })
                ->addColumn('total', function ($row) {
                    return $row->total;
                })
                ->make(true);
        }
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterTanggal = $request->input('tanggal');

            $query = DataAbsensiSiswa::query();

            if ($filterTanggal) {
                $query->whereDate('tanggal_absen', $filterTanggal);
            }
            // else {
            //     $timezone = 'Asia/Makassar';
            //     $now = Carbon::now();
            //     $now->setTimezone($timezone);
            //     $filterTanggal = $now->toDateString();

            //     $query->whereDate('tanggal_absen', $filterTanggal);
            // }

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
                ->addColumn('semester', function ($row) {
                    return $row->semester . ' - ' . $row->tahun_ajaran;
                })
                ->editColumn('tanggal_absen', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal_absen));
                })
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '
                    <a href="/rekap-absensi-siswa/absensi/' . $row->siswa->id . '" class="detail btn btn-primary btn-sm">Rekap Absensi</a>
                    <a href="/rekap-absensi-siswa/per-semester/' . $row->siswa->id . '" class="detail btn btn-info btn-sm">Rekap / Semester</a>
                    
                    <button class="btn btn-sm btn-info btn-icon" aria-label="Button" onclick="edit(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    </button>

                    <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="hapus(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    </button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('data_absensi_siswa.data');
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

    public function AbsensiSiswaPerSemester($id)
    {
        $data = DataSiswa::find($id);
        return view('data_absensi_siswa.per_semester', compact('data'));
    }

    public function rekapAbsensiSiswa(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = DataAbsensiSiswa::where('id_siswa', $id);
            $semesterFilter = $request->input('semester');
            $tahunAjaranFilter = $request->input('tahun_ajaran');

            if ($semesterFilter) {
                $data->where('semester', $semesterFilter);
            }

            if ($tahunAjaranFilter) {
                $data->where('tahun_ajaran', $tahunAjaranFilter);
            }
            $data = $data->latest('created_at')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_absen', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_absen)->translatedFormat('d-m-Y');
                })
                ->addColumn('hari', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_absen)->translatedFormat('l');
                })
                ->addColumn('id_siswa', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
                    } else {
                        return '-';
                    }
                })
                ->make(true);
        }
        return view('data_absensi_siswa.per_semester');
    }

    public function filterAbsensi(Request $request)
    {
        Carbon::setLocale('id');

        $selectedMonth = $request->input('selectedMonth');
        $id = $request->input('id');

        if ($selectedMonth) {
            $dataAbsensi = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)
                ->orderBy('tanggal_absen', 'desc')
                ->get();

            foreach ($dataAbsensi as $data) {
                $tanggalAbsen = Carbon::parse($data->tanggal_absen);
                $data->hari = $tanggalAbsen->isoFormat('dddd');
                $data->tanggal_absen = $tanggalAbsen->format('d-m-Y');
            }

            $totalAbsen = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)->where('keterangan', 'Hadir')->count();
            $terlambat = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)->where('keterangan', 'Terlambat')->count();
            $izin = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)->where('keterangan', 'Izin')->count();
            $sakit = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)->where('keterangan', 'Sakit')->count();
            $tanpaKeterangan = DataAbsensiSiswa::whereMonth('tanggal_absen', $selectedMonth)->where('id_siswa', $id)->where('keterangan', 'Tanpa Keterangan')->count();

            $result = [
                'total_absen' => $totalAbsen,
                'terlambat' => $terlambat,
                'izin' => $izin,
                'sakit' => $sakit,
                'tanpa_keterangan' => $tanpaKeterangan,
            ];
        } else {
            $currentMonth = Carbon::now()->month;
            $dataAbsensi = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)
                ->orderBy('tanggal_absen', 'desc')
                ->get();

            foreach ($dataAbsensi as $data) {
                $tanggalAbsen = Carbon::parse($data->tanggal_absen);
                $data->hari = $tanggalAbsen->isoFormat('dddd');
                $data->tanggal_absen = $tanggalAbsen->format('d-m-Y');
            }

            $totalAbsen = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)->where('keterangan', 'Hadir')->count();
            $terlambat = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)->where('keterangan', 'Terlambat')->count();
            $izin = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)->where('keterangan', 'Izin')->count();
            $sakit = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)->where('keterangan', 'Sakit')->count();
            $tanpaKeterangan = DataAbsensiSiswa::whereMonth('tanggal_absen', $currentMonth)->where('id_siswa', $id)->where('keterangan', 'Tanpa Keterangan')->count();

            $result = [
                'total_absen' => $totalAbsen,
                'terlambat' => $terlambat,
                'izin' => $izin,
                'sakit' => $sakit,
                'tanpa_keterangan' => $tanpaKeterangan,
            ];
        }

        if ($dataAbsensi->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data absensi untuk bulan yang dipilih'], 404);
        }

        return response()->json(['dataAbsensi' => $dataAbsensi, 'countData' => $result]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $idSiswa = $request->input('id_siswa');
        $validator = Validator::make($request->all(), [
            'id_siswa' => 'required',
            'tanggal_absen' => [
                'required',
                'date',
                Rule::unique('data_absensi_siswas')->where(function ($query) use ($idSiswa) {
                    return $query->where('id_siswa', $idSiswa);
                })
            ]
        ], [
            'tanggal_absen.required' => 'Tidak boleh kosong',
            'tanggal_absen.date' => 'Format tanggal salah',
            'tanggal_absen.unique' => 'Data absensi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data_semester = TahunAjaran::where('is_active', true)->first();
        $tahun_ajaran = $data_semester->tahun_ajaran;
        $semester    = $data_semester->semester;


        $save =  DataAbsensiSiswa::create($request->all() + ['tahun_ajaran' => $tahun_ajaran, 'semester' => $semester]);
        // $save = DataAbsensiSiswa::create([
        //     'id_siswa' => $idSiswa,
        //     'id_fingerprint' => $request->input('id_fingerprint'),
        //     'tanggal_absen' => $request->input('tanggal_absen'),
        //     'kelas' => $request->input('kelas'),
        //     'tanggal_absen' => $request->input('tanggal_absen'),
        //     'jam_masuk' => $request->input('jam_masuk'),
        //     'jam_keluar' => $request->input('jam_keluar'),
        //     'mode_absen' => $request->input('mode_absen'),
        //     'semester' => $semester,
        //     'tahun_ajaran' => $tahun_ajaran,
        //     'keterangan' => $request->input('keterangan'),
        // ]);

        if (!$save) {
            return response()->json(['message' => 'Data gagal disimpan'], 500);
        } else {
            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        }
    }

    public function show(DataAbsensiSiswa $dataAbsensiSiswa, $id)
    {
        $data = DataSiswa::find($id);
        return view('data_absensi_siswa.absensi', compact('data'));
    }


    public function edit(DataAbsensiSiswa $dataAbsensiSiswa, $id)
    {
        $data = $dataAbsensiSiswa::find($id);
        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAbsensiSiswa $dataAbsensiSiswa)
    {
        $id = $request->input('edit_id');
        $idSiswa = $request->input('id_siswa');

        $validator = Validator::make($request->all(), [
            'edit_id_siswa' => 'required',
            'edit_tanggal_absen' => [
                'required',
                'date',
                Rule::unique('data_absensi_siswas', 'tanggal_absen')
                    ->ignore($dataAbsensiSiswa->id)
                    ->where(function ($query) use ($idSiswa) {
                        return $query->where('id_siswa', $idSiswa);
                    })
            ]
        ], [
            'edit_tanggal_absen.required' => 'Tidak boleh kosong',
            'edit_tanggal_absen.date' => 'Format tanggal salah',
            'edit_tanggal_absen.unique' => 'Data absensi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataAbsensiSiswa->find($id)->update([
            'id_siswa' => $request->input('edit_id_siswa'),
            'id_fingerprint' => $request->input('edit_id_finger'),
            'tanggal_absen' => $request->input('edit_tanggal_absen'),
            'jam_masuk' => $request->input('edit_jam_masuk'),
            'jam_keluar' => $request->input('edit_jam_keluar'),
            'keterangan' => $request->input('edit_keterangan'),
        ]);

        return response()->json(['status' => true, 'message' => 'Data Siswa berhasil diperbarui', $dataAbsensiSiswa], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAbsensiSiswa $dataAbsensiSiswa, $id)
    {
        try {
            $dataAbsensiSiswa->findOrFail($id)->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}