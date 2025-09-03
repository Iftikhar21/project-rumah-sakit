<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Operator;
use App\Models\Pasien;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OperatorController extends Controller
{
    public function index()
    {
        $operator = Operator::where('user_id', auth()->id())->first();
        return view('operator.operator-view', compact('operator'));
    }

    public function profile()
    {
        $operator = Operator::where('user_id', auth()->id())->first();
        return view('operator.profile', compact('operator'));
    }

    public function edit()
    {
        $operator = Operator::where('user_id', auth()->id())->first();
        return view('operator.profile', compact('operator'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_operator'   => 'required|string|max:100',
        ]);

        $operator = Operator::where('user_id', auth()->id())->first();
        $operator->update([
            'nama_operator'   => $request->nama_operator,
        ]);

        return redirect()->route('operator-view')->with('success', 'Data diri berhasil diperbarui.');
    }

    public function dataPasien()
    {
        $pasien = Pasien::oldest()->paginate(5);
        return view('operator.data-pasien', compact('pasien'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addDataPasien()
    {
        return view('operator.data-pasien-add');
    }

    public function createDataPasien(Request $request)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'nullable|string|max:255',
            'kota_pasien'   => 'nullable|string|max:100',
            'nomor_telepon' => 'nullable|string|max:20',
            'user_option'   => 'required|in:new,existing',
        ]);

        if ($request->user_option === 'new') {
            $request->validate([
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            // Buat user baru
            $user = User::create([
                'name'     => $request->nama_pasien,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'user',
            ]);
        } else {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            // Gunakan user yang sudah ada
            $user = User::find($request->user_id);
        }

        // Generate ID Pasien
        $lastPasien = Pasien::orderBy('id', 'desc')->first();
        if ($lastPasien) {
            preg_match('/\d+$/', $lastPasien->id_pasien, $matches);
            $number = $matches ? (int)$matches[0] + 1 : 1;
        } else {
            $number = 1;
        }
        $idPasien = 'PSN-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Simpan data pasien
        Pasien::create([
            'user_id'       => $user->id,
            'id_pasien'     => $idPasien,
            'nama_pasien'   => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_pasien' => $request->alamat_pasien,
            'kota_pasien'   => $request->kota_pasien,
            'nomor_telepon' => $request->nomor_telepon,
            'usia_pasien'   => Carbon::parse($request->tanggal_lahir)->age,
        ]);

        return redirect()->route('data-pasien')->with('success', 'Pasien berhasil ditambahkan.');
    }


    public function editDataPasien($id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);
        return view('operator.data-pasien-edit', compact('pasien'));
    }

    public function updateDataPasien(Request $request, $id)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'required|string|max:255',
            'kota_pasien'   => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $pasien = Pasien::findOrFail($id);

        $pasien->update([
            'nama_pasien'   => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_pasien' => $request->alamat_pasien,
            'kota_pasien'   => $request->kota_pasien,
            'nomor_telepon' => $request->nomor_telepon,
            'usia_pasien'   => Carbon::parse($request->tanggal_lahir)->age,
        ]);

        return redirect()->route('data-pasien')->with('success', 'Data diri berhasil diperbarui.');
    }

    public function destroyDataPasien($id)
    {
        $pasien = Pasien::findOrFail($id);
        // Hapus pasien
        $pasien->delete();

        return redirect()->route('data-pasien')->with('success', 'Data pasien berhasil dihapus.');
    }

    public function destroyAllDataPasien($id)
    {
        $pasien = Pasien::findOrFail($id);

        // Hapus user yang terkait (jika ada)
        if ($pasien->user) {
            $pasien->user->delete();
        }

        // Hapus pasien
        $pasien->delete();

        return redirect()->route('data-pasien')->with('success', 'Data pasien dan akun user berhasil dihapus.');
    }

    public function dataDokter()
    {
        $dokter = Dokter::oldest()->paginate(5);
        return view('operator.data-dokter', compact('dokter'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addDataDokter()
    {
        $ruangan = Ruangan::all();
        return view('operator.data-dokter-add', compact('ruangan'));
    }

    public function createDataDokter(Request $request)
    {
        if ($request->user_option === 'new') {
            // Validasi untuk user baru
            $request->validate([
                'namaDokter'    => 'required|string|max:100',
                'tanggalLahir'  => 'required|date',
                'jenisKelamin'  => 'required|in:L,P',
                'spesialisasi'  => 'required|string|max:100',
                'jamPraktik'    => 'required|string|max:50',
                'email'         => 'required|email|unique:users,email',
                'password'      => 'required|string|min:8',
            ]);

            // Buat akun user baru
            $user = User::create([
                'name'     => $request->namaDokter,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'dokter',
            ]);
        } elseif ($request->user_option === 'existing') {
            // Validasi untuk user existing
            $request->validate([
                'namaDokter'    => 'required|string|max:100',
                'tanggalLahir'  => 'required|date',
                'jenisKelamin'  => 'required|in:L,P',
                'spesialisasi'  => 'required|string|max:100',
                'jamPraktik'    => 'required|string|max:50',
                'user_id'       => 'required|exists:users,id',
            ]);

            // Ambil user yang sudah ada
            $user = User::findOrFail($request->user_id);

            // Update role menjadi dokter
            $user->update([
                'name' => $request->namaDokter, // opsional, kalau mau samakan
                'role' => 'dokter',
            ]);
        } else {
            return back()->withErrors(['user_option' => 'Pilih tipe user terlebih dahulu.']);
        }

        // Generate ID Dokter
        $lastDokter = Dokter::orderBy('id', 'desc')->first();
        $number = $lastDokter ? $lastDokter->id + 1 : 1;
        $idDokter = 'DKT-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Simpan data dokter
        Dokter::create([
            'user_id'       => $user->id,
            'idDokter'      => $idDokter,
            'namaDokter'    => $request->namaDokter,
            'tanggalLahir'  => $request->tanggalLahir,
            'jenisKelamin'  => $request->jenisKelamin,
            'spesialisasi'  => $request->spesialisasi,
            'jamPraktik'    => $request->jamPraktik,
        ]);

        return redirect()->route('data-dokter')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function editDataDokter($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        $ruangan = Ruangan::all();
        return view('operator.data-dokter-edit', compact('dokter', 'ruangan'));
    }

    public function updateDataDokter(Request $request, $id)
    {
        $request->validate([
            'namaDokter'    => 'required|string|max:100',
            'tanggalLahir'  => 'required|date',
            'jenisKelamin'  => 'required|in:L,P',
            'spesialisasi'  => 'required|string|max:100',
            'jamPraktik'    => 'required|string|max:50', // bisa teks misal "08:00-16:00"
        ]);

        $dokter = Dokter::with('user')->findOrFail($id);

        // Update data dokter
        $dokter->update([
            'namaDokter'    => $request->namaDokter,
            'tanggalLahir'  => $request->tanggalLahir,
            'jenisKelamin'  => $request->jenisKelamin,
            'spesialisasi'  => $request->spesialisasi,
            'jamPraktik'    => $request->jamPraktik,
        ]);

        // Update data user
        $user = $dokter->user;
        $user->update([
            'name' => $request->namaDokter,
            'email' => $request->email,
        ]);

        return redirect()->route('data-dokter')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroyDataDokter($id)
    {
        $dokter = Dokter::findOrFail($id);
        // Hapus dokter
        $dokter->delete();

        return redirect()->route('data-dokter')->with('success', 'Data dokter berhasil dihapus.');
    }

    public function destroyAllDataDokter($id)
    {
        $dokter = Dokter::findOrFail($id);

        // Hapus user yang terkait (jika ada)
        if ($dokter->user) {
            $dokter->user->delete();
        }

        // Hapus dokter
        $dokter->delete();

        return redirect()->route('data-dokter')->with('success', 'Data dokter dan akun user berhasil dihapus.');
    }

    public function dataRuangan()
    {
        $ruangan = Ruangan::oldest()->paginate(5);
        return view('operator.data-ruangan', compact('ruangan'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addDataRuangan()
    {
        return view('operator.data-ruangan-add');
    }

    public function createDataRuangan(Request $request)
    {
        $request->validate([
            'namaRuangan'   => 'required|string|max:100',
            'dayaTampung'   => 'required|integer|min:1',
            'lokasi'        => 'required|string|max:100',
        ]);

        // Ambil ruangan terakhir
        $lastRuangan = Ruangan::orderBy('id', 'desc')->first();

        // Tentukan nomor urut baru
        $number = $lastRuangan ? $lastRuangan->id + 1 : 1;

        // Format kode ruangan, misal RNG-001, RNG-002
        $kodeRuangan = 'RNG-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        Ruangan::create([
            'kodeRuangan' => $kodeRuangan,
            'namaRuangan' => $request->namaRuangan,
            'dayaTampung' => $request->dayaTampung,
            'lokasi'      => $request->lokasi,
        ]);

        return redirect()->route('data-ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function editDataRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('operator.data-ruangan-edit', compact('ruangan'));
    }

    public function updateDataRuangan(Request $request, $id)
    {
        $request->validate([
            'namaRuangan'   => 'required|string|max:100',
            'dayaTampung' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:100',
        ]);

        $ruangan = Ruangan::findOrFail($id);

        $ruangan->update([
            'namaRuangan'   => $request->namaRuangan,
            'dayaTampung' => $request->dayaTampung,
            'lokasi'    => $request->lokasi,
        ]);

        return redirect()->route('data-ruangan')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroyDataRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('data-ruangan')->with('success', 'Data ruangan berhasil dihapus.');
    }

    public function kunjunganOperator()
    {
        $kunjungan = Kunjungan::all();
        $ruangan = Ruangan::all();
        $pasien = Pasien::where('id', auth()->id())->first();
        $dokter = Dokter::all();
        return view('operator.data-kunjungan-operator', compact('ruangan', 'kunjungan', 'pasien', 'dokter'));
    }

    public function kunjunganOperatorDetail($id)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $kunjungan = Kunjungan::findOrFail($id);

        return view('operator.data-kunjungan-operator-detail', compact('pasien', 'kunjungan'));
    }

    public function pilihDokterKunjungan(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        $operator = Operator::where('user_id', auth()->id())->firstOrFail();

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'dokter_id' => $request->dokter_id,
            'operator_id' => $operator->id,
            'status_kunjungan' => 'pending', // jangan langsung diproses
        ]);

        return redirect()->back()->with('success', 'Dokter berhasil dipilih. Silakan setujui atau tolak.');
    }

    public function setujuiKunjungan($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        if (!$kunjungan->dokter_id) {
            return redirect()->back()->with('error', 'Tidak dapat menyetujui tanpa dokter.');
        }

        $kunjungan->update([
            'status_kunjungan' => 'diproses',
        ]);

        return redirect()->back()->with('success', 'Kunjungan berhasil disetujui.');
    }

    public function tolakKunjungan($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'dokter_id' => null,
            'status_kunjungan' => 'ditolak',
        ]);

        return redirect()->back()->with('success', 'Kunjungan berhasil ditolak.');
    }


    public function editDataKunjungan()
    {
        $kunjungan = Kunjungan::all();
        return view('operator.data-kunjungan-operator', compact('kunjungan'));
    }

    public function updateDataKunjungan(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        $kunjungan = Kunjungan::findOrFail($id);

        // Hanya update dokter, tidak ubah status
        $kunjungan->update([
            'dokter_id' => $request->dokter_id,
            // 'status_kunjungan' => 'diproses', // hapus atau komentar
        ]);

        return redirect()->back()->with('success', 'Dokter berhasil diubah. Silakan setujui atau tolak kunjungan.');
    }
}
