<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelasFilter = $request->input('kelas');
            $query = JadwalPelajaran::query();
            if ($kelasFilter) {
                $query->where('kelas', $kelasFilter);
            }
            $data = $query->orderByDesc('hari')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->data_guru->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="hapus(' . $row->id . ')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
              </svg>
            </button> ';
                    return $actionBtn;
                })
                ->make(true);
        }
        return view('jadwal_pelajaran.data');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari' => 'required|string',
            'matpel' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
            // 'id_guru' => 'required|string',
            // 'kelas' => 'required|string',
            // 'ruangan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        JadwalPelajaran::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $del_siswa = JadwalPelajaran::findOrFail($id);
            $del_siswa->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
