<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $pasien = Pasien::where('user_id', $user->id)->first();
        return view('pasien.profile', compact('pasien'));
    }
    public function index()
    {
        // ambil pasien sesuai user login
        $user = Auth::user();
        $pasien = Pasien::where('user_id', auth()->id())->first();
        // $kunjungan = Kunjungan::where('pasien_id', $pasien->id)->latest()->paginate(10);
        return view('pasien.pasien-view', compact('pasien', 'user'));
    }

    public function register()
    {
        // form registrasi pasien mandiri
        $pasien = Pasien::where('user_id', auth()->id())->first();

        return view('pasien.pasien-register', compact('pasien'));
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'nullable|string',
            'kota_pasien'   => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $lastPasien = Pasien::orderBy('id', 'desc')->first();
        if ($lastPasien) {
            preg_match('/\d+$/', $lastPasien->id_pasien, $matches);
            $number = $matches ? (int)$matches[0] + 1 : 1;
        } else {
            $number = 1;
        }
        $id_pasien = 'PSN-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        $usia = Carbon::parse($request->tanggal_lahir)->age;

        Pasien::create([
            'user_id'       => auth()->id(),
            'id_pasien'     => $id_pasien,
            'nama_pasien'   => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_pasien' => $request->alamat_pasien,
            'kota_pasien'   => $request->kota_pasien,
            'nomor_telepon' => $request->nomor_telepon,
            'usia_pasien'   => $usia,
        ]);

        return redirect()->route('pasien-view')
            ->with('success', 'Registrasi berhasil, data pasien sudah tersimpan.');
    }

    public function edit()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        return view('pasien.profile', compact('pasien'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'nullable|string',
            'kota_pasien'   => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $pasien = Pasien::where('user_id', auth()->id())->first();
        $pasien->update([
            'nama_pasien'   => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_pasien' => $request->alamat_pasien,
            'kota_pasien'   => $request->kota_pasien,
            'nomor_telepon' => $request->nomor_telepon,
            'usia_pasien'   => Carbon::parse($request->tanggal_lahir)->age,
        ]);

        return redirect()->route('pasien-view')->with('success', 'Data diri berhasil diperbarui.');
    }


    public function destroy(Pasien $pasien)
    {
        if ($pasien->user_id !== auth()->id()) {
            abort(403);
        }

        $pasien->delete();

        return redirect()->route('pasien.register')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    public function kunjungan()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $kunjungan = $pasien->kunjungan()->latest()->paginate(10);
        return view('pasien.kunjungan', compact('pasien', 'kunjungan'));
    }

    public function kunjunganDetail($id)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $kunjungan = $pasien->kunjungan()->with(['dokter', 'ruangan'])->findOrFail($id);

        return view('pasien.kunjungan-detail', compact('pasien', 'kunjungan'));
    }

    public function addDataKunjungan()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        return view('pasien.kunjungan-add', compact('pasien'));
    }

    public function createDataKunjungan(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'jenis_perawatan' => 'required|string|max:100',
            'tanggal_kunjungan' => 'required|date',
        ]);

        $pasien = Pasien::where('user_id', auth()->id())->firstOrFail();
        $kode_pasien = $pasien->id_pasien;

        $lastKunjungan = Kunjungan::orderBy('id', 'desc')->first();
        if ($lastKunjungan) {
            preg_match('/\d+$/', $lastKunjungan->no_rekam_medis, $matches);
            $number = $matches ? (int)$matches[0] + 1 : 1;
        } else {
            $number = 1;
        }
        $no_rekam_medis = 'NRM-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $pasien->kunjungan()->create([
            'no_rekam_medis'    => $no_rekam_medis,
            'pasien_id'         => $kode_pasien,
            'user_id'           => auth()->id(),
            'keluhan'           => $request->keluhan,
            'jenis_perawatan'   => $request->jenis_perawatan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'status_kunjungan'  => 'pending', // default ketika baru request
        ]);

        return redirect()->route('kunjungan-view')
            ->with('success', 'Request kunjungan berhasil diajukan, menunggu penentuan dokter.');
    }

    public function editDataKunjungan()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $kunjungan = $pasien->kunjungan()->latest()->first();
        return view('pasien.kunjungan-edit', compact('pasien', 'kunjungan'));
    }

    public function updateDataKunjungan(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'jenis_perawatan' => 'required|string|max:100',
            'tanggal_kunjungan' => 'required|date',
        ]);

        $pasien = Pasien::where('user_id', auth()->id())->first();

        $pasien->kunjungan()->update([
            'keluhan'           => $request->keluhan,
            'jenis_perawatan'   => $request->jenis_perawatan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
        ]);

        return redirect()->route('kunjungan-view')
            ->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    public function batalDataKunjungan($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update(['status_kunjungan' => 'dibatalkan']);

        return redirect()->back()->with('success', 'Kunjungan berhasil dibatalkan.');
    }
}
