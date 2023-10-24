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
    
        public function beli( Request $request)
        {
            return view('Dashboarduser.pemesanan');
        }

    public function konfimasipembelian(Request $request, $ids)
    {
        $orderIds = explode(',', $ids);
        $pengguna = kamar::whereIn('id', $orderIds)->with('admin')->get();

        $user_id = Auth::id();
        $subtotalorder = $pengguna->sum('totalharga');

        $bank = transaksiadmin::where('metodepembayaran', 'bank')->get();
        return view('Dashboarduser.pemesanan', compact('pengguna', 'user_id', 'wallet', 'notifikasi', 'subtotalorder', 'bank'));
    }

    public function riwayatuser()
    {
        return view('Dashboarduser.riwayat');
    }
}
