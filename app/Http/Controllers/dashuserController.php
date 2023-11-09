<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\pengguna;
use App\Models\ulasan;
use App\Models\transaksiadmin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashuserController extends Controller
{
    public function dashboardUser()
    {
        $user_id = Auth::id();
        $kamar = kamar::orderBy('created_at', 'desc')->paginate(8);
        return view('Dashboarduser.daftarmenu', compact('user_id', 'kamar'));
    }


    public function pemesanan(Request $request, $id)
    {
        $kamar = kamar::findOrFail($id);
        $transaksi = transaksiadmin::all();
        $ulasan = ulasan::where('kamar_id', $id)->get();
     
        return view('Dashboarduser.detailpesanan', ['id' => $id], compact('kamar', 'transaksi', 'ulasan'));
    }

    public function riwayatuser()
    {
        $pengguna = Pengguna::where('user_id', Auth::id())  
            ->where('status', 'terima')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('Dashboarduser.riwayat', compact('pengguna'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $user_id = Auth::id();

        $kamar = Kamar::where('jenis_kamar', 'like' . $searchTerm )
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('Dashboarduser.daftarmenu', compact('user_id', 'kamar'));
    }


    public function booking(Request $request)
    {
        // Validasi input
        $request->validate([
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'no_telp' => 'required|numeric|regex:/^\d*$/|digits_between:10,12',
            'alamat' => 'required|min:5|max:200',
            'ktp' => 'required',
            'fotobukti' => 'required',
        ], [
            'checkin_date.required' => 'Tanggal check-in wajib diisi.',
            'checkout_date.required' => 'Tanggal check-out wajib diisi.',
            'checkout_date.after' => 'Tanggal check-out harus setelah tanggal check-in.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'notlp.numeric' => 'Nomor Telepon Harus Berupa Angka',
            'notlp.regex' => 'Format nomor telepon tidak valid.',
            'notlp.digits_between' => 'Nomor Telepon harus memiliki panjang antara 10 hingga 12 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'alamat minimal 5 huruf',
            'alamat.max' => 'alamat maksimal tidak melebihi 200 kalimat',
            'ktp.required' => 'Foto KTP wajib diUpload.',
            'fotobukti.required' => 'foto bukti wajib di Upload',
        ]);

        $user_id = Auth::id();

        $pesan = pengguna::query()->where('kamar_id', $request->id_kamar)
                 ->latest()
                 ->first();

        // dia sudah pernah dipesan
        if($pesan){
            $keluar = Carbon::parse($pesan->checkout_date)->translatedFormat('d F Y');

            $checkin_date = strtotime($pesan->checkin_date);
            $checkout_date = strtotime($pesan->checkout_date);
            $waktu_masuk = strtotime($request->checkin_date);

            if ($waktu_masuk >= $checkin_date && $waktu_masuk <= $checkout_date) {
                // $waktu_masuk berada di antara $checkin_date dan $checkout_date
                // Lakukan sesuatu di sini
                return back()->with('error', 'Kamar ini masih dipesan oleh pengguna lain hingga tanggal ' . $keluar);
            //belum pernah dipesan
            } else {
                $kamar_id = $request->id_kamar;

                $foto = $request->ktp;
                $fileName = $foto->storeAs('kamar', $foto->hashName());
        
                $fotobukti = $request->fotobukti;
                $file = $fotobukti->storeAs('kamar', $fotobukti->hashName());
        
                Pengguna::create([
                    'kamar_id' => $kamar_id,
                    'transaksiadmin_id' => $request->transaksiadmin_id,
                    'tujuanpembayaran' => $request->tujuanpembayaran,
                    'user_id' => $user_id,
                    'no_telp' => $request->no_telp,
                    'fotobukti' => $file,
                    'status' => 'menunggu',
                    'alamat' => $request->alamat,
                    'ktp' => $fileName,
                    'checkin_date' => $request->checkin_date,
                    'checkout_date' => $request->checkout_date,
        
                ]);

                    return back()->with('success', 'kamar berhasil di booking');

            }        
        } 
        
    }   
        // // belum pernah sama sekali
        // else{
        //     $kamar_id = $request->id_kamar;

        //     $foto = $request->ktp;
        //     $fileName = $foto->storeAs('kamar', $foto->hashName());
    
        //     $fotobukti = $request->fotobukti;
        //     $file = $fotobukti->storeAs('kamar', $fotobukti->hashName());
    
        //     Pengguna::create([
        //         'kamar_id' => $kamar_id,
        //         'transaksiadmin_id' => $request->transaksiadmin_id,
        //         'tujuanpembayaran' => $request->tujuanpembayaran,
        //         'user_id' => $user_id,
        //         'no_telp' => $request->no_telp,
        //         'fotobukti' => $file,
        //         'status' => 'menunggu',
        //         'alamat' => $request->alamat,
        //         'ktp' => $fileName,
        //         'checkin_date' => $request->checkin_date,
        //         'checkout_date' => $request->checkout_date,
        //     ]);

        // return back()->with('success', 'kamar berhasil di booking');

        // }

    public function ulasan(Request $request, $id)
    {

        // dd($request->all());
        $user_id = Auth::user()->id;
        $kamar = kamar::findOrFail($id);

        $ulasanSudahAda = Ulasan::where('kamar_id', $kamar->id)
            ->where('user_id', $user_id)
            ->first();

        if ($ulasanSudahAda) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk kamar ini.');
        }

        $request->validate([
            'kamar_id' => 'required',
            'komentar' => 'required|max:255',
        ], [
            'kamar_id.required' => 'ada kesalahan',
            'komentar.required' => 'komentar tidak boleh kosong',
            'komentar.max' => 'komentar maksimal hanya 255 karakter'
        ]);

        $ulasan = new ulasan([
            'kamar_id' => $kamar->id,
            'user_id' => $user_id,
            'komentar' => $request->komentar,
        ]);
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim');;
    }
}
