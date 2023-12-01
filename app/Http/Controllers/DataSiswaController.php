<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_siswa = DataSiswa::all();
        return view('data_siswa.data', ['data_siswa' => $data_siswa]);
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
            'nama' => 'required|string',
            'nisn' => 'required|numeric|unique:data_siswas',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DataSiswa::create($request->all());
        return response()->json(['message' => 'Data berhasil disimpan'], 200);

        // try {
        //     $request->validate([
        //         'nama' => 'required|string',
        //         'nisn' => 'required|numeric',
        //         'tempat_lahir' => 'required|string',
        //         'tanggal_lahir' => 'required|string',
        //         'jenis_kelamin' => 'required|string',
        //         'agama' => 'required|string',
        //         'kelas' => 'required|string',
        //         'alamat' => 'required|string',
        //     ]);

        //     DataSiswa::create($request->all());

        //     return response()->json(['message' => 'Data berhasil disimpan'], 200);
        // } catch (ValidationException $e) {
        //     $errors = $e->errors();

        //     $formattedErrors = [];
        //     foreach ($errors as $field => $messages) {
        //         $formattedErrors[] = [
        //             'field' => $field,
        //             'message' => $messages[0],
        //         ];
        //     }
        //     return response()->json(['errors' => $formattedErrors], 422);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DataSiswa::find($id);
        return response()->json(['data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSiswa $dataSiswa)
    {
        //
    }
}
