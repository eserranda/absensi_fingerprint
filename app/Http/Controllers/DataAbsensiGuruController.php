<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataGuru;
use Illuminate\Http\Request;
use App\Models\DataAbsensiGuru;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DataAbsensiGuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterTanggal = $request->input('tanggal');

            $query = DataAbsensiGuru::query();
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
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->guru->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="/rekap-absensi-guru/absensi/' . $row->guru->id . '" class="detail btn btn-primary btn-sm">Rekap Absensi</a>
                    
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
        return view('data_absensi_guru.data');
    }

    public function filterAbsensi(Request $request)
    {
        Carbon::setLocale('id');
        $selectedMonth = $request->input('selectedMonth');
        $id = $request->input('id');

        if ($selectedMonth) {
            $dataAbsensi = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)
                // ->whereYear('tanggal_absen', Carbon::now()->year) 
                ->where('id_guru', $id)
                ->orderBy('tanggal_absen', 'desc')
                ->get();

            foreach ($dataAbsensi as $data) {
                $tanggalAbsen = Carbon::parse($data->tanggal_absen);
                $data->hari = $tanggalAbsen->isoFormat('dddd');
                $data->tanggal_absen = $tanggalAbsen->format('d-m-Y');
            }

            $totalAbsen = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)->where('id_guru', $id)->where('keterangan', 'Hadir')->count();
            $terlambat = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)->where('id_guru', $id)->where('keterangan', 'Terlambat')->count();
            $izin = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)->where('id_guru', $id)->where('keterangan', 'Izin')->count();
            $sakit = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)->where('id_guru', $id)->where('keterangan', 'Sakit')->count();
            $tanpaKeterangan = DataAbsensiGuru::whereMonth('tanggal_absen', $selectedMonth)->where('id_guru', $id)->where('keterangan', 'Tanpa Keterangan')->count();

            $result = [
                'total_absen' => $totalAbsen,
                'terlambat' => $terlambat,
                'izin' => $izin,
                'sakit' => $sakit,
                'tanpa_keterangan' => $tanpaKeterangan,
            ];
        } else {
            $currentMonth = Carbon::now()->month;
            $dataAbsensi = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)
                ->orderBy('tanggal_absen', 'desc')
                ->get();

            foreach ($dataAbsensi as $data) {
                $tanggalAbsen = Carbon::parse($data->tanggal_absen);
                $data->hari = $tanggalAbsen->isoFormat('dddd');
                $data->tanggal_absen = $tanggalAbsen->format('d-m-Y');
            }

            $totalAbsen = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)->where('keterangan', 'Hadir')->count();
            $terlambat = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)->where('keterangan', 'Terlambat')->count();
            $izin = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)->where('keterangan', 'Izin')->count();
            $sakit = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)->where('keterangan', 'Sakit')->count();
            $tanpaKeterangan = DataAbsensiGuru::whereMonth('tanggal_absen', $currentMonth)->where('id_guru', $id)->where('keterangan', 'Tanpa Keterangan')->count();

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
        $idGuru = $request->input('id_guru');
        $validator = Validator::make($request->all(), [
            'id_guru' => 'required',
            'tanggal_absen' => [
                'required',
                'date',
                Rule::unique('data_absensi_gurus')->where(function ($query) use ($idGuru) {
                    return $query->where('id_guru', $idGuru);
                })
            ]
        ], [
            'tanggal_absen.required' => 'Tanggal Tidak boleh kosong',
            'tanggal_absen.date' => 'Format tanggal salah',
            'tanggal_absen.unique' => 'Data absensi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DataAbsensiGuru::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = DataGuru::find($id);
        return view('data_absensi_guru.absensi', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAbsensiGuru $dataAbsensiGuru, $id)
    {
        $data = $dataAbsensiGuru::find($id);
        return response()->json(['status' => true, 'data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAbsensiGuru $dataAbsensiGuru)
    {
        $id = $request->input('id');
        $idGuru = $request->input('id_guru');

        $validator = Validator::make($request->all(), [
            'edit_id_guru' => 'required',
            'edit_tanggal_absen' => [
                'required',
                'date',
                Rule::unique('data_absensi_gurus', 'tanggal_absen')
                    ->ignore($dataAbsensiGuru->id)
                    ->where(function ($query) use ($idGuru) {
                        return $query->where('id_guru', $idGuru);
                    })
            ]
        ], [
            'edit_tanggal_absen.required' => 'Tanggal Tidak boleh kosong',
            'edit_tanggal_absen.date' => 'Format tanggal salah',
            'edit_tanggal_absen.unique' => 'Data absensi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataAbsensiGuru->find($id)->update([
            'id_guru' => $request->input('edit_id_guru'),
            'id_fingerprint ' => $request->input('edit_id_fingerprint '),
            'edit_tanggal_absen' => $request->input('edit_tanggal_absen'),
            'jam_masuk' => $request->input('edit_jam_masuk'),
            'jam_keluar' => $request->input('edit_jam_keluar'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()->json(['status' => true, 'message' => 'Data Guru berhasil diperbarui', $dataAbsensiGuru], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAbsensiGuru $dataAbsensiGuru, $id)
    {
        try {
            $dataAbsensiGuru->findOrFail($id)->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
