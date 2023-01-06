<?php

namespace App\Http\Controllers;

use App\Models\SyaratKetentuan;
use Illuminate\Http\Request;

class SyaratKetentuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syarat_ketentuan = SyaratKetentuan::latest()->get();
        return view('syarat_ketentuan.index', compact('syarat_ketentuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('syarat_ketentuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required',
                'isi'     => 'required'
            ],
            [
                'judul.required' => 'Judul tidak boleh kosong!',
                'isi.required' => 'Isi tidak boleh kosong!'
            ]
        );
        SyaratKetentuan::create([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return redirect('/syarat_ketentuan')->with([
            'message' => 'Data berhasil ditambahkan',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $syarat_ketentuan = SyaratKetentuan::find($id);
        return view('syarat_ketentuan.edit', compact('syarat_ketentuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'isi'     => 'required'
            ],
            [
                'judul.required' => 'Judul tidak boleh kosong!',
                'isi.required' => 'Isi tidak boleh kosong!'
            ]
        );
        $syarat_ketentuan = SyaratKetentuan::find($id);
        $syarat_ketentuan->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);
        return redirect('/syarat_ketentuan')->with([
            'message' => 'Data berhasil diperbarui',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syarat_ketentuan = SyaratKetentuan::find($id);
        $syarat_ketentuan->delete();
        return redirect('/syarat_ketentuan')->with([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
