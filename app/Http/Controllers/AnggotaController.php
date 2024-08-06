<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Anggota::with('hobis')->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:anggotas',
            'deskripsi' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:menikah,belum menikah',
            'hobis' => 'array',
            'hobis.*' => 'exists:hobis,id',
        ]);

        $anggota = Anggota::create($request->all());
        $anggota->hobis()->sync($request->hobis);

        return response()->json($anggota->load('hobis'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Anggota::with('hobis')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'usia' => 'sometimes|required|integer',
            'email' => 'sometimes|required|string|email|max:255|unique:anggotas,email,'.$id,
            'deskripsi' => 'nullable|string',
            'tanggal_lahir' => 'sometimes|required|date',
            'gender' => 'sometimes|required|in:Laki-laki,Perempuan',
            'status' => 'sometimes|required|in:menikah,belum menikah',
            'hobis' => 'array',
            'hobis.*' => 'exists:hobis,id',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());
        if ($request->has('hobis')) {
            $anggota->hobis()->sync($request->hobis);
        }

        return response()->json($anggota->load('hobis'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->hobis()->detach();
        $anggota->delete();

        return response()->json(null, 204);
    }
}
