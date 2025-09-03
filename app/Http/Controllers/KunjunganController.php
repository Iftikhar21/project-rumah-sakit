<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    /**
     * Tampilkan semua data kunjungan
     */
    public function index()
    {
        // join dengan pasien biar kelihatan nama pasien
        $kunjungan = Kunjungan::with('pasien')->latest()->paginate(10);
        return view('pasien.kunjungan', compact('kunjungan'));
    }

    /**
     * Form tambah kunjungan
     */
    public function create()
    {
        // ambil semua pasien untuk dropdown
        $pasien = Pasien::all();
        return view('kunjungan.create', compact('pasien'));
    }

    /**
     * Simpan kunjungan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id'     => 'required|exists:pasien,id',
            'dokter_id'     => 'nullable|integer',
            'keluhan'       => 'nullable|string|max:255',
            'status'        => 'required|in:rawat_jalan,rawat_inap',
            'nomorKamar'    => 'nullable|string|max:20',
            'tanggalMasuk'  => 'nullable|date',
            'tanggalKeluar' => 'nullable|date|after_or_equal:tanggalMasuk',
        ]);

        Kunjungan::create($validated);

        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil ditambahkan!');
    }

    /**
     * Detail kunjungan
     */
    public function show($id)
    {
        $kunjungan = Kunjungan::with('pasien')->findOrFail($id);
        return view('kunjungan.show', compact('kunjungan'));
    }

    /**
     * Form edit kunjungan
     */
    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $pasien = Pasien::all();
        return view('kunjungan.edit', compact('kunjungan', 'pasien'));
    }

    /**
     * Update data kunjungan
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pasien_id'     => 'required|exists:pasien,id',
            'dokter_id'     => 'nullable|integer',
            'keluhan'       => 'nullable|string|max:255',
            'status'        => 'required|in:rawat_jalan,rawat_inap',
            'nomorKamar'    => 'nullable|string|max:20',
            'tanggalMasuk'  => 'nullable|date',
            'tanggalKeluar' => 'nullable|date|after_or_equal:tanggalMasuk',
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update($validated);

        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    /**
     * Hapus data kunjungan
     */
    public function destroy($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil dihapus!');
    }
}
