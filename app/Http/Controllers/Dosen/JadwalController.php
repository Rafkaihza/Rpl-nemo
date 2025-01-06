<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $bimbingans = Bimbingan::with(['dosen', 'mahasiswa'])->get();
        return view('dosen.jadwals.index', compact('bimbingans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();
        return view('dosen.jadwals.create', compact('dosens', 'mahasiswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'dosen_id' => 'required|exists:dosens,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'lokasi' => 'required|string|max:255',
            'topik' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Bimbingan::create($data);
            DB::commit();
            return redirect()->route('jadwals.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('jadwals.index')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();
        return view('dosen.jadwals.edit', compact('bimbingan', 'dosens', 'mahasiswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i:s',
            'dosen_id' => 'required|exists:dosens,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'lokasi' => 'required|string|max:255',
            'topik' => 'required|string|max:255',
        ]);

        $bimbingan = Bimbingan::findOrFail($id);

        DB::beginTransaction();
        try {
            $bimbingan->update($data);
            DB::commit();
            return redirect()->route('jadwals.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('jadwals.index')->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->delete();

        return redirect()->route('jadwals.index')->with('success', 'Data berhasil dihapus');
    }

    public function approve($id)
{
    $bimbingan = Bimbingan::findOrFail($id);
    $bimbingan->update(['status' => 'setuju']);

    return redirect()->route('jadwals.index')->with('success', 'Jadwal bimbingan berhasil disetujui.');
}

public function reject($id)
{
    $bimbingan = Bimbingan::findOrFail($id);
    $bimbingan->update(['status' => 'tolak']);

    return redirect()->route('jadwals.index')->with('success', 'Jadwal bimbingan berhasil ditolak.');
}
}