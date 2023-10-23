<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashuserController extends Controller
{
    public function dashboardUser(){
        return view ('Dashboarduser.daftarmenu');
    }

    public function pesanan()
    {
        return view('Dashboarduser.pesanan');
    }

    public function riwayatuser()
    {
        return view('Dashboarduser.riwayat');
    }
}
