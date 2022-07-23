<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan semua data dari model Jurusan
        $jurusan = Jurusan::all();
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'kode_mata_pelajaran' => 'required',
            'nama_mata_pelajaran' => 'required',
            'semester' => 'required',
            'jurusan' => 'required'
        ]);

        $jurusan = new Jurusan();
        $jurusan->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $jurusan->nama_mata_pelajaran = $request->nama_mata_pelajaran;
        $jurusan->semester = $request->semester;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect()->route('jurusan.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $request->validate([
            'kode_mata_pelajaran' => 'required|max:255',
            'nama_mata_pelajaran' => 'required',
            'semester' => 'required',
            'jurusan' => 'required',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $jurusan->nama_mata_pelajaran = $request->nama_mata_pelajaran;
        $jurusan->semester = $request->semester;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect()->route('jurusan.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
