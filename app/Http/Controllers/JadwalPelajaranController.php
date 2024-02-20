<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Auth;
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
            $isAdmin = Auth::user()->roles->contains('name', 'admin');

            $kelasFilter = $request->input('kelas');
            $query = JadwalPelajaran::query();
            if ($kelasFilter) {
                $query->where('kelas', $kelasFilter);
            }

            $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')");

            $data = $query->get();
            $dataTable = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->data_guru->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('id_matpel', function ($row) {
                    if ($row->id_matpel) {
                        return $row->data_matpel->nama_matpel;
                    } else {
                        return '-';
                    }
                });
            if ($isAdmin) {
                $dataTable->addColumn('action', function ($row) {
                    $actionBtn = '
                    <button class="btn btn-sm btn-primary btn-icon" aria-label="Button" onclick="edit(' . $row->id . ')">
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
                });
            }
            return $dataTable->make(true);
        }
        return view('jadwal_pelajaran.data');
    }

    public function getID($id)
    {
        $data = JadwalPelajaran::find($id);
        return response()->json(['data' => $data]);
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
        $validator = Validator::make($request->all(), [
            'hari' => 'required|string',
            // 'id_matpel' => 'required|string',
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
        $id = $request->input('edit_id');
        $hari = $request->input('edit_hari');
        $id_matpel = $request->input('edit_id_matpel');
        $jam_mulai = $request->input('edit_jam_mulai');
        $jam_selesai = $request->input('edit_jam_selesai');
        $id_guru = $request->input('edit_id_guru');
        $kelas = $request->input('edit_kelas');
        $ruangan = $request->input('edit_ruangan');

        $validator = Validator::make($request->all(), [
            'edit_hari' => 'required|string',
            'edit_jam_mulai' => 'required|string',
            'edit_jam_selesai' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jadwalPelajaran->find($id)->update([
            'hari' => $hari,
            'id_matpel' => $id_matpel,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'id_guru' => $id_guru,
            'kelas' => $kelas,
            'ruangan' => $ruangan
        ]);

        return response()->json(['status' => true, 'message' => 'Data berhasil diupdate'], 200);
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
