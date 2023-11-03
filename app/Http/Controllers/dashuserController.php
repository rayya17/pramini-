<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\pengguna;
use App\Models\ulasan;
use App\Models\transaksiadmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dashuserController extends Controller
{
    public function dashboardUser()
    {
        $user_id = Auth::id();
        $kamar = kamar::where('status', 'kosong')->orderBy('created_at', 'desc')->paginate(8);
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

        return view('Dashboarduser.riwayat', compact('pengguna'))->with('kamar');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $user_id = Auth::id();

        $kamar = Kamar::where('jenis_kamar', 'like', '%' . $searchTerm . '%')
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



        // $kamar = Kamar::where('id', $request->id_kamar)->first();
        $kamar = Kamar::findOrFail($request->id_kamar);
        if ($kamar->status === 'booked') {
            return back()->with('error', "Kamar ini sudah di booking");
        }

        $user_id = Auth::id();

        $kamar->update([
            'status' => 'booked',
            'user_id' => $user_id
        ]);

        $kamar_id = $kamar->id;

        $foto = $request->ktp;
        $fileName = $foto->storeAs('kamar', $foto->hashName());

        $fotobukti = $request->fotobukti;
        $file = $fotobukti->storeAs('kamar', $fotobukti->hashName());

        // Menyimpan data ke tabel penggunas
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



    public function ulasan(Request $request, $id)
    {

        // dd($request->all());
        $user_id = Auth::user()->id;
        $admin = kamar::findOrFail($id);

        $ulasanSudahAda = Ulasan::where('kamar_id', $admin->id)
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
            'komentar.max' => 'komentar maaksimal hanya 255 karakter'
        ]);

        $ulasan = new ulasan([
            'kamar_id' => $admin->id,
            'user_id' => $user_id,
            'komentar' => $request->komentar,
        ]);
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim');;
    }
}
