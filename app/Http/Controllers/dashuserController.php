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
    

}
