<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\pengguna;
use App\Models\User;
use App\Models\transaksiadmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dashuserController extends Controller
{
    public function dashboardUser()
    {
        $user_id = Auth::id();
        $admin = kamar::orderBy('created_at', 'desc')->paginate(8);
        return view('Dashboarduser.daftarmenu', compact('user_id', 'admin'));
    }

    public function pesanan()
    {
        return view('Dashboarduser.pesanan');
    }

    public function pemesanan(Request $request, $id)
    {
        $kamar = kamar::findOrFail($id);
        $transaksi = transaksiadmin::all();
        // $adminpm = new kamar();
        // $adminpm->checkin_date = $request->checkin_date;
        // $adminpm->checkout_date = $request->checkout_date;
        // $adminpm->no_telp = $request->no_telp;
        // $adminpm->ktp = $request->ktp;
        // $adminpm->alamat = $request->alamat;
        // $adminpm->status = 'menunggu';
        // $adminpm->save();

        return view('Dashboarduser.detailpesanan', ['id' => $id], compact('kamar','transaksi'));
    }

    public function riwayatuser()
    {
        $pengguna = Pengguna::where('user_id', Auth::id())->where('status', 'terima')->get();
        return view('Dashboarduser.riwayat', compact('pengguna'))->with('kamar');
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
    $kamar = Kamar::where('id', $request->id_kamar)->first();
    $user_id = Auth::id();

    $kamar->update([
        'status' => 'booked',
        'user_id' => $user_id
    ]);

    // Mengambil nilai kamar_id dari $kamar
    $kamar_id = $kamar->id;

    // Menyimpan data ke tabel penggunas
    Pengguna::create([
        'kamar_id' => $kamar_id,
        'transaksiadmin_id' =>$request-> transaksiadmin_id,
        'tujuanpembayaran' =>$request-> tujuanpembayaran,
        'user_id' => $user_id,
        'no_telp' => $request->no_telp,
        'fotobukti' => $request->fotobukti,
        'status' => 'menunggu',
        'alamat' => $request->alamat,
        'ktp' => $request->ktp,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
    ]);

    return back();
}

    public function bookingtolak(kamar $kamar, Request $request)
    {
        $kamar = Kamar::where('status', 'kosong');

        Kamar::findOrFail($kamar->id)->update([
            'user_id' => Auth::id(),
            'status' => 'booked',
        ]);

        $datapost = new pengguna();
        $datapost->checkin_date = $request->checkin_date;
        $datapost->checkout_date = $request->checkout_date;
        $datapost->user_id = Auth::id();
        $datapost->kamar_id = $kamar->id;
        $datapost->no_telp = $request->no_telp;
        $datapost->alamat = $request->alamat;
        $datapost->ktp = $request->ktp;
        $datapost->save();
        return back();
    }
}
