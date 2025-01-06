<?php

namespace App\Http\Controllers\Mahasiswa;


use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil data mahasiswa yang sedang login
    $mahasiswa = Auth::user()->mahasiswa;

    // Ambil pengajuan bimbingan berdasarkan mahasiswa yang login
    $bimbingans = $mahasiswa ? $mahasiswa->bimbingans()->with(['dosen'])->get() : collect();

    $approvedBimbingans = $mahasiswa 
        ? Bimbingan::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'setuju')
            ->with(['dosen', 'mahasiswa'])
            ->get()
        : collect();

    // Data tambahan
    $dosens = Dosen::all();
    $mahasiswas = Mahasiswa::all(); // Ambil semua data mahasiswa, jika diperlukan

    

    

    return view('mahasiswa.welcome', compact('bimbingans', 'dosens', 'mahasiswas', 'approvedBimbingans'));
}

    public function create()
    {
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.welcome', compact('dosens', 'mahasiswas'));
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
            return redirect()->route('welcome')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('welcome')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
    
}