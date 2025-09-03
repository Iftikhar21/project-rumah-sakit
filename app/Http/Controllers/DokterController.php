<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Riwayat;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::where('user_id', $user->id)->first(); // ambil data dokter milik user

        return view('dktr.dokter-view', compact('dokter', 'user'));
    }

    public function profile()
    {
        $user = Auth::user();
        $dokter = Dokter::where('user_id', $user->id)->first();
        return view('dktr.profile', compact('dokter'));
    }

    public function edit()
    {
        $dokter = Dokter::where('user_id', auth()->id())->first();
        return view('dokter.profile', compact('dokter'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'namaDokter'   => 'required|string|max:100',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:L,P',
            'spesialisasi' => 'nullable|string',
            'jamPraktik'   => 'nullable|string',
        ]);

        $dokter = Dokter::where('user_id', auth()->id())->first();
        $dokter->update([
            'namaDokter'   => $request->namaDokter,
            'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
            'spesialisasi' => $request->spesialisasi,
            'jamPraktik'   => $request->jamPraktik,
        ]);

        return redirect()->route('dokter-view')->with('success', 'Data diri berhasil diperbarui.');
    }

    public function kunjungan()
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        // --- AUTO UPDATE STATUS KUNJUNGAN BERDASARKAN TANGGAL KELUAR ---
        $riwayatList = Riwayat::whereHas('kunjungan', function ($q) use ($dokter) {
            $q->where('dokter_id', $dokter->id)
                ->where('status_kunjungan', 'diproses');
        })
            ->where('tanggal_keluar', '<', now())
            ->get();

        foreach ($riwayatList as $riwayat) {
            // update status kunjungan jadi selesai
            $riwayat->kunjungan->update(['status_kunjungan' => 'selesai']);

            // jika ada ruangan (Rawat Inap), kembalikan daya tampung
            if ($riwayat->ruangan_id) {
                $riwayat->ruangan->increment('dayaTampung');
            }
        }

        // --- AMBIL DATA KUNJUNGAN ---
        $kunjungan = Kunjungan::with(['pasien', 'operator', 'dokter'])
            ->where('dokter_id', $dokter->id)
            ->latest()
            ->paginate(10);

        return view('dktr.kunjungan', compact('dokter', 'kunjungan'));
    }

    public function kunjunganDetail($id)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $kunjungan = Kunjungan::with(['dokter', 'ruangan'])->findOrFail($id);

        return view('dktr.kunjungan-detail', compact('pasien', 'kunjungan'));
    }

    public function addDataRiwayat($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $ruangan = Ruangan::all();
        return view('dktr.dokter-add-data-riwayat', compact('kunjungan', 'pasien', 'ruangan'));
    }

    public function createDataRiwayat(Request $request, $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        // Buat data riwayat
        $riwayat = $kunjungan->riwayat()->create([
            'ruangan_id'      => $request->ruangan_id,
            'pasien_id'       => $kunjungan->pasien_id,
            'penyakit'        => $request->penyakit,
            'obat'            => $request->obat,
            'dosis'           => $request->dosis,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'tanggal_keluar'  => $request->tanggal_keluar,
            'status_pasien'   => $request->status_pasien,
        ]);

        // Update status kunjungan jadi diproses (sementara)
        $kunjungan->update(
            [
                'jenis_perawatan'  => $request->jenis_perawatan,
                'status_kunjungan' => 'diterima'
            ]
        );

        // Jika rawat inap, kurangi daya tampung
        if ($request->jenis_perawatan === 'Rawat Inap' && $request->ruangan_id) {
            $ruangan = Ruangan::find($request->ruangan_id);
            if ($ruangan && $ruangan->dayaTampung > 0) {
                $ruangan->decrement('dayaTampung');
            }
        }

        return redirect()->route('kunjungan-view-dokter')->with('success', 'Data riwayat berhasil ditambahkan.');
    }


    public function updateStatusPasien(Request $request, $riwayatId)
    {
        $riwayat = Riwayat::findOrFail($riwayatId);
        $kunjungan = $riwayat->kunjungan;

        $riwayat->update([
            'status_pasien' => $request->status_pasien,
            'tanggal_keluar' => $request->tanggal_keluar ?? $riwayat->tanggal_keluar
        ]);

        if ($request->status_pasien === 'Sudah Sembuh') {
            $kunjungan->update(['status_kunjungan' => 'selesai']);

            if ($riwayat->ruangan_id) {
                $riwayat->ruangan->increment('dayaTampung');
            }
        }

        return back()->with('success', 'Status pasien berhasil diperbarui.');
    }

    public function autoCloseKunjungan()
    {
        $riwayats = Riwayat::where('tanggal_keluar', '<', now())
            ->whereHas('kunjungan', fn($q) => $q->where('status_kunjungan', 'diproses'))
            ->get();

        foreach ($riwayats as $riwayat) {
            $riwayat->kunjungan->update(['status_kunjungan' => 'selesai']);

            if ($riwayat->ruangan_id) {
                $riwayat->ruangan->increment('dayaTampung');
            }
        }
    }

    public function editDataRiwayat($id)
    {
        $riwayat = Riwayat::with(['user'])->findOrFail($id);
        $ruangan = Ruangan::all();
        $kunjungan = $riwayat->kunjungan;
        return view('dktr.dokter-edit-data-riwayat', compact('riwayat', 'ruangan', 'kunjungan'));
    }

    public function updateDataRiwayat(Request $request, $id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $kunjungan = $riwayat->kunjungan;

        $request->validate([
            'jenis_perawatan' => 'required|string|in:Rawat Jalan,Rawat Inap',
            'penyakit'        => 'required|string',
            'status_pasien'   => 'required|string',
            'obat'            => 'nullable|string',
            'dosis'           => 'nullable|string',
            'ruangan_id'      => $request->jenis_perawatan === 'Rawat Inap' ? 'required|exists:ruangan,id' : 'nullable',
            'tanggal_masuk'   => $request->jenis_perawatan === 'Rawat Inap' ? 'required|date' : 'nullable|date',
            'tanggal_keluar'  => 'nullable|date',
        ]);

        // Simpan ruangan lama sebelum update
        $ruanganLamaId = $riwayat->ruangan_id;
        $jenisPerawatanLama = $kunjungan->jenis_perawatan;

        // Update riwayat
        $riwayat->update([
            'ruangan_id'     => $request->jenis_perawatan === 'Rawat Inap' ? $request->ruangan_id : null,
            'tanggal_masuk'  => $request->jenis_perawatan === 'Rawat Inap' ? $request->tanggal_masuk : null,
            'tanggal_keluar' => $request->jenis_perawatan === 'Rawat Inap' ? $request->tanggal_keluar : null,
            'penyakit'       => $request->penyakit,
            'obat'           => $request->obat,
            'dosis'          => $request->dosis,
            'status_pasien'  => $request->status_pasien,
        ]);


        // Update jenis perawatan & status kunjungan
        $kunjungan->update([
            'jenis_perawatan' => $request->jenis_perawatan,
        ]);

        // --- LOGIKA PENAMBAHAN/KURANGI DAYA TAMPUNG ---
        // Jika pasien sembuh, tambah daya tampung kembali
        if ($request->status_pasien === 'Sudah Sembuh' && $ruanganLamaId) {
            Kunjungan::where('id', $kunjungan->id)->update(['status_kunjungan' => 'selesai']);
            Ruangan::where('id', $ruanganLamaId)->increment('dayaTampung');
        }

        // Jika mengubah dari Rawat Inap → Rawat Jalan, juga kembalikan daya tampung lama
        if ($jenisPerawatanLama === 'Rawat Inap' && $request->jenis_perawatan === 'Rawat Jalan' && $ruanganLamaId) {
            Ruangan::where('id', $ruanganLamaId)->increment('dayaTampung');
        }

        // Jika mengubah dari Rawat Jalan → Rawat Inap, kurangi daya tampung ruangan baru
        if ($jenisPerawatanLama === 'Rawat Jalan' && $request->jenis_perawatan === 'Rawat Inap' && $request->ruangan_id) {
            $ruanganBaru = Ruangan::find($request->ruangan_id);
            if ($ruanganBaru && $ruanganBaru->dayaTampung > 0) {
                $ruanganBaru->decrement('dayaTampung');
            }
        }

        return redirect()->route('kunjungan-view-dokter')
            ->with('success', 'Data riwayat berhasil diperbarui.');
    }
}
