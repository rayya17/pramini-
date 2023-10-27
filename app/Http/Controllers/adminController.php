<?php

namespace App\Http\Controllers;
use App\Models\transaksiadmin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\pengguna;
use App\Http\Requests\StorepenggunaRequest;
use App\Http\Requests\UpdatepenggunaRequest;

use function PHPUnit\Framework\returnCallback;

class adminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function transaksiAdmin(){
        $adminmp = transaksiadmin::all();
        return view  ('admin.transaksiAdmin', compact('adminmp'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'metodepembayaran' => 'required',
            'tujuan' => 'required',
            'keterangan' => 'required',

        ], [
            'metodepembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'tujuan.required' => 'Tujuan wajib diisi.',
            'keterangan.required' => 'keterangan harus di isi',
        ]);


        $adminmp = new transaksiadmin;
        $adminmp->metodepembayaran = $request->metodepembayaran;
        $adminmp->tujuan = $request->tujuan;
        $adminmp->keterangan = $request->keterangan;

        $adminmp->save();
        return back()->with('success', 'Berhasil menambah pembayaran');
    }

    public function create()
    {
        $adminmp = transaksiadmin::all();
        return view('admin.transaksiadmin', compact('adminmp'));
    }

    public function adestroy(transaksiadmin $adminmp)
    {
        $adminmp->delete();
        return redirect()->route('transaksiAdmin')->with('success', 'Berhasil menghapus data');
        return back()->with('error');
    }
public function aedit($id)
{
    try {
        // Find the 'transaksiadmin' record with the specified $id
        $transaksiad = transaksiadmin::findOrFail($id);

        // Return the 'transaksiadmin' record as a JSON response
        return response()->json($transaksiad);
    } catch (\Exception $e) {
        // Handle exceptions, for example, the record was not found
        return response()->json(['error' => 'Record not found'], 404);
    }
}

public function aupdate(Request $request, $id)
{
    try {
        // Validate the request data
        $request->validate([
            'metodepembayaran' => 'required',
            'tujuan' => 'required',
            'keterangan' => 'required|numeric|unique:transaksiadmin,keterangan,' . $id,
        ], [
            'metodepembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'tujuan.required' => 'Tujuan pembayaran wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.numeric' => 'Keterangan harus berupa angka.',
            'keterangan.unique' => 'Keterangan sudah pernah digunakan.',
        ]);

        // Find the 'transaksiadmin' record with the specified $id
        $adminmp = transaksiadmin::findOrFail($id);

        // Update the attributes of the record based on the form input
        $adminmp->metodepembayaran = $request->input('metodepembayaran');
        $adminmp->tujuan = $request->input('tujuan');
        $adminmp->keterangan = $request->input('keterangan');

        // Save the updated record
        $adminmp->save();

        // Redirect to a route named 'transaksiAdmin' with a success message
        return redirect()->route('transaksiAdmin')->with('success', 'Berhasil mengubah data');
    } catch (\Exception $e) {
        // Handle exceptions, for example, validation errors or record not found
        return redirect()->route('transaksiAdmin')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



public function kepengguna()
{
    $penggunas = pengguna::with('user')
    ->where('status', 'menunggu')
    ->get();
    
    return view('admin.pengguna', compact('penggunas'))->with('user');
}

public function index()
{
    $penggunas = pengguna::all();
    return view('admin.pengguna', compact('penggunas'));

}

}
