<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::oldest()->paginate(5);
        return view('ruangan.ruangan-view', compact('ruangan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('ruangan.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kodeRuangan' => 'required|unique:ruangan,kodeRuangan',
            'namaRuangan' => 'required',
            'dayaTampung' => 'required',
            'lokasi' => 'required',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Di Input !');
    }


    public function show(Ruangan $ruangan)
    {
        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kodeRuangan' => 'required|unique:ruangan,kodeRuangan,' . $ruangan->id,
            'namaRuangan' => 'required',
            'dayaTampung' => 'required',
            'lokasi' => 'required',
        ]);

        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Di Update !');
    }


    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')
            ->with('success', 'Data Berhasil Di Hapus !');
    }
}
