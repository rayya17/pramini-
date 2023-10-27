<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use App\Http\Requests\StorepenggunaRequest;
use App\Http\Requests\UpdatepenggunaRequest;
use Illuminate\Http\Request;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorepenggunaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepenggunaRequest $request, pengguna $pengguna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengguna $pengguna)
    {
        //
    }
    public function terima(pengguna $pengguna, Request $request)
    {
        Pengguna::findOrFail($request->id_pengguna)->update([
            'status' => 'terima',
        ]);

        return back();
    }

    public function tolak(pengguna $pengguna, Request $request)
    {
        Pengguna::findOrFail($request->id_pengguna)->update([
            'status' => 'tolak',
        ]);

        return back();
    }
}
