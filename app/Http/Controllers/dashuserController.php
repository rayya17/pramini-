<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\pengguna;
use App\Models\ulasan;
use App\Models\User;
use App\Models\transaksiadmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dashuserController extends Controller
{
    public function dashboardUser()
    {
        $user_id = Auth::id();
        $pagination = kamar::paginate(4);
        $kamar = kamar::orderBy('created_at', 'desc')->paginate(4);
        return view('Dashboarduser.daftarmenu', compact('user_id', 'kamar', 'pagination'));
    }

    public function pesanan()
    {
        return view('Dashboarduser.pesanan');
    }

    public function pemesanan(Request $request, $id)
    {
        $kamar = kamar::findOrFail($id);
        $transaksi = transaksiadmin::all();
        $ulasan = ulasan::where('kamar_id', $id)->get();
        // $adminpm = new kamar();
        // $adminpm->checkin_date = $request->checkin_date;
        // $adminpm->checkout_date = $request->checkout_date;
        // $adminpm->no_telp = $request->no_telp;
        // $adminpm->ktp = $request->ktp;
        // $adminpm->alamat = $request->alamat;
        // $adminpm->status = 'menunggu';
        // $adminpm->save();

        return view('Dashboarduser.detailpesanan', ['id' => $id], compact('kamar', 'transaksi', 'ulasan'));
    }

    public function riwayatuser()
    {
        $pengguna = Pengguna::where('user_id', Auth::id())->where('status', 'terima')->get();
        return view('Dashboarduser.riwayat', compact('pengguna'))->with('kamar');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $user_id = Auth::id();

        $kamar = kamar::where('jenis_kamar', 'like', '%' . $searchTerm . '%')
            ->where('user_id', $user_id)
            ->get();

        return view('Dashboarduser.daftarmenu', compact('user_id', 'kamar'));
    }


    public function booking(Request $request)
    {
        
    // Validasi input 
    $request->validate([
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'no_telp' => 'required|numeric|regex:/^\d*$/|digits_between:10,12',
        'alamat' => 'required|min:5|max:100',
        'ktp' => 'required',
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
    'fotobukti.required'=> 'foto bukti wajib di Upload',
]);

        $kamar = Kamar::where('id', $request->id_kamar)->first();
        $user_id = Auth::id();

        $kamar->update([
            'status' => 'booked',
            'user_id' => $user_id
        ]);

        $kamar_id = $kamar->id;

        $foto = $request->ktp;
        $fileName = $foto->storeAs('kamar', $foto->hashName());

        // Menyimpan data ke tabel penggunas
        Pengguna::create([
            'kamar_id' => $kamar_id,
            'transaksiadmin_id' => $request->transaksiadmin_id,
            'tujuanpembayaran' => $request->tujuanpembayaran,
            'user_id' => $user_id,
            'no_telp' => $request->no_telp,
            'fotobukti' => $request->fotobukti,
            'status' => 'menunggu',
            'alamat' => $request->alamat,
            'ktp' => $fileName,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
        
        ]);


        return back()->with('succes', 'kamar berhasil di booking');
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

    public function ulasan(Request $request, $id)
    {

        // dd($request->all());
        $user_id = Auth::user()->id;
        $admin = kamar::findOrFail($id);
        // $ulasan = ulasan::where('kamar_id', $admin->id)->get();
        
        $request->validate([
            'kamar_id' => 'required',
            'komentar' => 'required|max:255',
        ], [
            'kamar_id.required' => 'ada kesalahan',
            'komentar.required' => 'komentar tidak boleh kosong',
            'komentar.max' => 'komentar maaksimal hanya 255 karakter'
        ]);
        
        $ulasan = new ulasan([
            'kamar_id' => $admin->id,
            'user_id' => $user_id,
            'komentar' => $request->komentar,
        ]);
        $ulasan->save();
        
        return redirect()->back()->with('success', 'Ulasan berhasil disimpan');;
    }
}
