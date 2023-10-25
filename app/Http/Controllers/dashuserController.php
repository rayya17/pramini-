<?php

namespace App\Http\Controllers;
use App\Models\kamar;
use App\Models\pengguna;
use App\Models\transaksiadmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dashuserController extends Controller
{
    public function dashboardUser(){
        $user_id = Auth::id();
        $admin = kamar::orderBy('created_at', 'desc')->paginate(8);
        return view ('Dashboarduser.daftarmenu', compact('user_id', 'admin'));
    }

    public function pesanan()
    {
        return view('Dashboarduser.pesanan');
    }
    
    public function pemesanan(Request $request, $id)
    {
        $kamar = kamar::findOrFail($id);

        return view('Dashboarduser.detailpesanan', ['id' => $id], compact('kamar'));
    }

    public function riwayatuser()
    {
        return view('Dashboarduser.riwayat');
    }

    public function search(Request $request, $daftar)
    {
        // Ambil kata kunci pencarian dari input form
        $searchTerm = $request->input('query');
        $user_id = Auth::id();
    
        // Melakukan pencarian data sesuai dengan $searchTerm
        $results = kamar::where('jenis_kamar', 'like', '%' . $searchTerm . '%')
            ->where('user_id', $user_id)
            ->get();
    
        return view('Dashboarduser.daftarmenu', compact('results'));
    }

   public function booking(Request $request)
{
    $user = Auth::id();
    $admin = kamar::all();
    $kamar = Kamar::all()->first();

    if (!$kamar) {
        return view('Dashboarduser.daftarmenu')->with('error', 'Kamar yang sesuai tidak ditemukan.');
    }

    $datapost = new pengguna();
    $datapost->checkin_date = $request->checkin_date;
    $datapost->checkout_date = $request->checkout_date;
    $datapost->user_id= $user;
    $datapost->kamar_id = $kamar->id;
    $datapost->no_telp = $request->no_telp;
    $datapost->alamat = $request->alamat;
    $datapost->ktp = $request->ktp;
     // Menggunakan kamar_id dari kamar yang sesuai
    $datapost->save();

    return view('Dashboarduser.daftarmenu', compact('admin'))->with('success', 'Kamar berhasil di booking.');
}
    
}

