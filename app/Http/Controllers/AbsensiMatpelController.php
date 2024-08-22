<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\AbsensiMatpel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AbsensiMatpelController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelasFilter = $request->input('kelas');
            $filterTanggal = $request->input('tanggal');

            if (Auth::user()->roles->contains('name', 'guru')) {
                $id_guru = Auth::user()->id_guru;
                $id_guru = Auth::user()->id_guru;
                $query = AbsensiMatpel::where('id_guru', $id_guru);
            } else if (Auth::user()->roles->contains('name', 'admin')) {
                $query = AbsensiMatpel::query();
            } else {
                // ini hanya agar datanya tidak ditampilkan jika dia adalah wali kelas yang tidak mengajar, heheh
                $id_siswa = Auth::user()->id_siswa;
                $query = AbsensiMatpel::where('id_siswa', $id_siswa);
            }

            if ($kelasFilter) {
                $query->where('kelas', $kelasFilter);
            }

            if ($filterTanggal) {
                $query->whereDate('tanggal', $filterTanggal);
            }

            $getData = $query->latest('created_at')->get();
            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->guru->nama;
                    } else {
                        return '-';
                    }
                })
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
                ->addColumn('action', function ($row) {
                    $actionBtn = '
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
        return view('data_absensi_matpel.data');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'tanggal' => 'required',
            'id_guru' => 'required',
            'id_siswa' => 'required',
            'id_matpel' => 'required',
            'keterangan' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $hari = Carbon::parse($request->get('tanggal'))->locale('id')->dayName;

        $data_semester = TahunAjaran::where('is_active', true)->first();
        $tahun_ajaran = $data_semester->tahun_ajaran;
        $semester    = $data_semester->semester;

        $save = AbsensiMatpel::create([
            'tanggal' => $request->get('tanggal'),
            'hari' => $hari,
            'id_siswa' => $request->get('id_siswa'),
            'kelas' => $request->get('kelas'),
            'id_guru' => $request->get('id_guru'),
            'id_matpel' => $request->get('id_matpel'),
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran,
            'keterangan' => $request->get('keterangan'),

        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Data Absensi Matpel Gagal Disimpan'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AbsensiMatpel $absensiMatpel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AbsensiMatpel $absensiMatpel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsensiMatpel $absensiMatpel, $id)
    {
        try {
            $del_siswa = AbsensiMatpel::findOrFail($id);
            $del_siswa->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
