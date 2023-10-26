<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Http\Requests\StorekamarRequest;
use App\Http\Requests\UpdatekamarRequest;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamars = kamar::all();
        return view('admin.kamar', compact('kamars'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kamar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekamarRequest $request)
    {
        $request->validate([
            'no_kamar' => 'required|gt:0',
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kamar' => 'required',
            'harga' => 'required|gt:0',
            'deskripsi' => 'required',
        ], [
            'no_kamar.gt' => 'nomor kamar tidak boleh min',
            'no_kamar.required' => 'nomor kamar tidak boleh kosong',
            'foto.required' => 'foto tidak boleh kosong',
            'foto.mimes' => 'foto tidak valid',
            'jenis_kamar.required' => 'jenis kamar tidak boleh kosong',
            'harga.gt' => 'harga tidak boleh min',
            'harga.required' => 'harga tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',

        ]);



        $foto = $request->file('foto');
        $fotokamar = 'kamar';

        $fileName = $foto->storeAs($fotokamar, $foto->hashName());

        $kamar = new kamar([
            'no_kamar' => $request->no_kamar,
            'foto' => $fileName,
            'jenis_kamar' => $request->jenis_kamar,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        $kamar->save();

        return back()->with('success', "Berhasil menambah data");
    }

    /**
     * Display the specified resource.
     */
    public function show(kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kamar $kamar)
    {
        return view('admin.kamar', compact('kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekamarRequest $request, kamar $kamar)
    {
        $request->validate([
            'no_kamar' => 'gt:0',
            'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048', // Mengubah 'required' menjadi 'nullable' agar foto tidak wajib diunggah saat mengedit
            'jenis_kamar' => 'required',
            'harga' => 'required|gt:0',
            'deskripsi' => 'required',
        ], [
            'no_kamar.gt' => 'nomor kamar tidak boleh min',
            'no_kamar.required' => 'nomor kamar tidak boleh kosong',
            'foto.mimes' => 'foto tidak valid',
            'jenis_kamar.required' => 'jenis kamar tidak boleh kosong',
            'harga.gt' => 'harga tidak boleh min',
            'harga.required' => 'harga tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
        ]);

        $fotokamar = 'kamar';

        if ($request->hasFile('foto')) { // Memeriksa apakah ada file foto yang diunggah
            $foto = $request->file('foto');
            $fileName = $foto->storeAs($fotokamar, $foto->hashName());

            // Menghapus foto lama jika ada
            if ($kamar->foto) {
                Storage::delete($kamar->foto);
            }

            $kamar->foto = $fileName;
        }

        $kamar->no_kamar = $request->no_kamar;
        $kamar->jenis_kamar = $request->jenis_kamar;
        $kamar->deskripsi = $request->deskripsi;
        $kamar->harga = $request->harga;
        $kamar->save();

        return redirect()->route('kamar.index')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kamar $kamar)
    {
        Storage::delete($kamar->foto);
        $kamar->delete();
        return redirect()->back()->with('success', "Berhasil menghapus data");
    }
}
