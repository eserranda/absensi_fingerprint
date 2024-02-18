<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataGuru;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataPegawai = $request->input('status_pegawai');
            $query = DataGuru::query();
            if ($dataPegawai) {
                $query->where('status_pegawai', $dataPegawai);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_lahir', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
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
                    <button class="btn btn-sm btn-info btn-icon" aria-label="Button" onclick="info(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    </button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('data_guru.data');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function getDataGuru(Request $request)
    {

        // $data = DataGuru::where('nama', 'LIKE', '%' . request('q') . '%')
        //     ->orWhere('nuptk', 'LIKE', '%' . request('q') . '%')
        //     ->get();

        // return response()->json(['data' => $data]);

        $data = [];

        if ($request->filled('q')) {
            $data = DataGuru::select("nama", "id", "nuptk")
                ->where('nama', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json($data);
    }

    public function getNUPTKGuru($id)
    {
        $data = DataGuru::where('id', $id)->first();
        if ($data) {
            $nuptk = $data->nuptk;
            return response()->json(['status' => true, 'data' => $nuptk]);
        } else {
            return response()->json(['status' => false, 'message' => 'Guru tidak ditemukan']);
        }
    }
    public function getID($id)
    {
        $data = DataGuru::find($id);
        return response()->json(['status' => true, 'data' => $data]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nuptk' => 'required|numeric',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'status_pegawai' => 'required|string',
            'jenis_ptk' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => false], 422);
        }

        DataGuru::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataGuru $dataGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DataGuru::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataGuru $dataGuru)
    {
        $id = $request->input('id');
        $nama = $request->input('edit_nama');
        $nuptk = $request->input('edit_nuptk');
        $jenis_kelamin = $request->input('edit_jenis_kelamin');
        $tempat_lahir = $request->input('edit_tempat_lahir');
        $tanggal_lahir = $request->input('edit_tanggal_lahir');
        $nip = $request->input('edit_nip');
        $status_pegawai = $request->input('edit_status_pegawai');
        $jenis_ptk = $request->input('edit_jenis_ptk');
        $agama = $request->input('edit_agama');
        $alamat = $request->input('edit_alamat');

        $validator = Validator::make($request->all(), [
            'edit_nama' => 'required|string',
            'edit_nuptk' => 'required|numeric',
            'edit_jenis_kelamin' => 'required|string',
            'edit_tempat_lahir' => 'required|string',
            'edit_tanggal_lahir' => 'required|string',
            'edit_status_pegawai' => 'required|string',
            'edit_jenis_ptk' => 'required|string',
            'edit_agama' => 'required|string',
            'edit_alamat' => 'required|string',
        ]);

        // Set ulang nama atribut
        $validator->setAttributeNames([
            'edit_nama' => 'Nama',
            'edit_nuptk' => 'NUPTk',
            'edit_jenis_kelamin' => 'Gender',
            'edit_tempat_lahir' => 'Tempat Lahir',
            'edit_tanggal_lahir' => 'Tanggal Lahir',
            'edit_status_pegawai' => 'Status Pegawai',
            'edit_jenis_ptk' => 'Jenis PTK',
            'edit_agama' => 'Agama',
            'edit_alamat' => 'Alamat',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $dataGuru->find($id)->update([
            'nama' => $nama,
            'nuptk' => $nuptk,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nip' => $nip,
            'status_pegawai' => $status_pegawai,
            'jenis_ptk' => $jenis_ptk,
            'agama' => $agama,
            'alamat' => $alamat,
        ]);

        return response()->json(['status' => true, 'message' => 'Data Guru berhasil diperbarui', $dataGuru], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataGuru $dataGuru, $id)
    {
        try {
            $dataGuru->findOrFail($id)->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
