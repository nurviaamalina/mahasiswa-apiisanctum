<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return Mahasiswa::all();  // Mengambil semua data mahasiswa
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json($mahasiswa, 201);  // Menyimpan data baru
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        
        return response()->json($mahasiswa, 200);// Mengambil data berdasarkan ID
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete(); // Menghapus data
        
        return response()->json(null, 204);
    }

    public function show($id)
{
    $mahasiswa = Mahasiswa::find($id);

    if (!$mahasiswa) {
        return response()->json(['message' => 'Mahasiswa not found'], 404);
    }

    return response()->json($mahasiswa);
}
}