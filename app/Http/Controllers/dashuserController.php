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
        // $adminpm = new kamar();
        // $adminpm->checkin_date = $request->checkin_date;
        // $adminpm->checkout_date = $request->checkout_date;
        // $adminpm->no_telp = $request->no_telp;
        // $adminpm->ktp = $request->ktp;
        // $adminpm->alamat = $request->alamat;
        // $adminpm->status = 'menunggu';
        // $adminpm->save();

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
        $kamar = Kamar::where('id', $request->id_kamar)->first();

        if ($kamar->user_id) {
            return back()->with('error', 'Kamar ini sudah di booking.');
        }

        if (!$kamar) {
            return view('Dashboarduser.daftarmenu')->with('error', 'Kamar yang sesuai tidak ditemukan.');
        }

        Kamar::findOrFail($kamar->id)->update([
            'user_id' => Auth::id(),
        ]);

        $datapost = new pengguna();
        $datapost->checkin_date = $request->checkin_date;
        $datapost->checkout_date = $request->checkout_date;
        $datapost->user_id = Auth::id();
        $datapost->kamar_id = $kamar->id;
        $datapost->no_telp = $request->no_telp;
        $datapost->alamat = $request->alamat;
        $datapost->save();

        $dirktp = 'ktp';

        if ($request->hasFile('ktp')) { // Memeriksa apakah ada file foto yang diunggah
            $foto = $request->file('ktp');
            $fileName = $foto->storeAs($dirktp, $foto->hashName());

            $datapost->ktp = $fileName;

        return redirect()->back()->with('success', "Berhasil mem-booking kamar ini");
    }
}

}
