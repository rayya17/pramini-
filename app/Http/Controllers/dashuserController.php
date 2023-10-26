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

        return view('Dashboarduser.detailpesanan', ['id' => $id], compact('kamar', 'transaksi'));
    }
    public function riwayatuser()
    {
        return view('Dashboarduser.riwayat');
    }

    public function search(Request $request, $daftar)
    {

        $searchTerm = $request->input('query');
        $user_id = Auth::id();

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

    // Validasi input 
    $request->validate([
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'no_telp' => 'required|numeric|regex:/^\d*$/|digits_between:10,12',
        'alamat' => 'required|min:5|max:100',
        'ktp' => 'required|string',
        'tujuanpembayaran'=> 'required',
        'fotobukti'=> 'required',
    ], [
    'checkin_date.required' => 'Tanggal check-in wajib diisi.',
    'checkout_date.required' => 'Tanggal check-out wajib diisi.',
    'checkout_date.after' => 'Tanggal check-out harus setelah tanggal check-in.',
    'no_telp.required' => 'Nomor telepon wajib diisi.',
    'notlp.numeric'=> 'Nomor Telepon Harus Berupa Angka',
    'notlp.regex'=> 'Format nomor telepon tidak valid.',
    'notlp.digits_between' => 'Nomor Telepon harus memiliki panjang antara 10 hingga 12 digit.',
    'alamat.required' => 'Alamat wajib diisi.',
    'alamat.min'=>'alamat minimal 5 huruf',
    'alamat.max'=>'alamat maksimal tidak melebihi 100 huruf',
    'ktp.required' => 'Foto KTP wajib diUpload.',
    'tujuanpembayaran.required' => 'pilih salah satu tujuan pembayaran',
    'fotobukti.required'=> 'foto bukti wajib di Upload',
]);

    // Menyimpan data ke tabel penggunas
    Pengguna::create([
        'kamar_id' => $kamar_id,
        'user_id' => $user_id,
        'no_telp' => $request->no_telp,
        'status' => 'menunggu',
        'alamat' => $request->alamat,
        'ktp' => $request->ktp,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
    ]);


    return redirect()->route('dashboardUser');
}

}
