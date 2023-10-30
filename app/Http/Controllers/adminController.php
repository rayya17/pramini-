<?php

namespace App\Http\Controllers;
use App\Models\transaksiadmin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\pengguna;
use App\Models\kamar;
use App\Http\Requests\StorepenggunaRequest;
use App\Http\Requests\UpdatepenggunaRequest;

use function PHPUnit\Framework\returnCallback;

class adminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = User::where('role', 'user')->count();
        $totalTransaksi = Pengguna::where('status', 'terima')->count();
        $totalkamar = kamar::count();
        return view('admin.dashboard', compact('totalPengguna', 'totalTransaksi', 'totalkamar'));
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
            'keterangan' => 'required|numeric|regex:/^\d*$/|unique:transaksiadmins|not_in:0|digits_between:15,25',

        ], [
            'metodepembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'tujuan.required' => 'Tujuan wajib diisi.',
            'keterangan.required' => 'keterangan harus di isi',
            'keterangan.numeric'=>'keterangan harus berupa angka',
            'keterangan.regex'=>'format tidak valid',
            'keterangan.unique'=>'no rekening tidak boleh sama',
            'keterangan.not_in'=> 'no rekening tidak boleh 0',
            'keterangan.digits_between'=>'minimal 15 maksimal 25',

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
        $transaksiad = transaksiadmin::findOrFail($id);

        return response()->json($transaksiad);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Record not found'], 404);
    }
}

public function update(Request $request, $id)
{
    $request->validate([
        'metodepembayaran' => 'required',
        'tujuan' => 'required',
        'keterangan' => 'required|numeric|regex:/^\d*$/|unique:transaksiadmins|not_in:0',

    ], [
        'metodepembayaran.required' => 'Metode pembayaran wajib dipilih.',
        'tujuan.required' => 'Tujuan wajib diisi.',
        'keterangan.required' => 'keterangan harus di isi',
        'keterangan.numeric'=>'keterangan harus berupa angka',
        'keterangan.regex'=>'format tidak valid',
        'keterangan.unique'=>'no rekening tidak boleh sama',
        'keterangan.not_in'=> 'no rekening tidak boleh 0',
    ]);
        $adminmp = transaksiadmin::findOrFail($id);

        $adminmp->metodepembayaran = $request->input('metodepembayaran');
        $adminmp->tujuan = $request->input('tujuan');
        $adminmp->keterangan = $request->input('keterangan');

        $adminmp->save();

        return redirect()->route('transaksiAdmin')->with('success', 'Berhasil mengubah data');

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
