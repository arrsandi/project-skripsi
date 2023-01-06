<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class JenisPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisPengiriman::latest()->get();
        return view('jenis_pengiriman.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_pengiriman.create');
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
                'nama_layanan' => 'required|unique:jenis_pengiriman,nama_layanan',
                'deskripsi' => 'required',
                'foto'     => 'required|mimes:png,jpg,jpeg'
            ],
            [
                'nama_layanan.required' => 'Nama layanan tidak boleh kosong!',
                'nama_layanan.unique' => 'Nama layanan sudah ada!',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
                'foto.required' => 'Foto tidak boleh kosong!',
                'foto.mimes' => 'Format foto tidak sesuai!'
            ]
        );


        $fileName = time() . '.' . $request->foto->extension();
        $request->file('foto')->storeAs('public/jenis_pengiriman', $fileName);
        JenisPengiriman::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName
        ]);

        return redirect('/jenis')->with([
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
        $jenis = JenisPengiriman::findOrFail($id);
        return view('jenis_pengiriman.edit', compact('jenis'));
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
        $jenis = JenisPengiriman::findOrFail($id);
        if ($request->file('foto') == '') {
            $request->validate(
                [
                    'nama_layanan' => 'required|unique:jenis_pengiriman,nama_layanan,' . $id,
                    'deskripsi' => 'required',
                ],
                [
                    'nama_layanan.required' => 'Nama layanan tidak boleh kosong!',
                    'nama_layanan.unique' => 'Nama layanan sudah ada!',
                    'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
                ]
            );
            $jenis->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect('/jenis')->with([
                'message' => 'Data berhasil diperbarui',
                'success' => true
            ]);
        } else {
            $request->validate(
                [
                    'nama_layanan' => 'required|unique:jenis_pengiriman,nama_layanan,' . $id,
                    'deskripsi' => 'required',
                    'foto'     => 'required|mimes:png,jpg,jpeg'
                ],
                [
                    'nama_layanan.required' => 'Nama layanan tidak boleh kosong!',
                    'nama_layanan.unique' => 'Nama layanan sudah ada!',
                    'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
                    'foto.required' => 'Foto tidak boleh kosong!',
                    'foto.mimes' => 'Format foto tidak sesuai!'
                ]
            );

            if (File::exists('storage/jenis_pengiriman/' . $jenis->foto)) {
                File::delete('storage/jenis_pengiriman/' . $jenis->foto);
                $fileName = time() . '.' . $request->foto->extension();
                $request->file('foto')->storeAs('public/jenis_pengiriman', $fileName);
                $jenis->update([
                    'nama_layanan' => $request->nama_layanan,
                    'deskripsi' => $request->deskripsi,
                    'foto' => $fileName
                ]);
            } else {
                $fileName = time() . '.' . $request->foto->extension();
                $request->file('foto')->storeAs('public/jenis_pengiriman', $fileName);
                $jenis->update([
                    'nama_layanan' => $request->nama_layanan,
                    'deskripsi' => $request->deskripsi,
                    'foto' => $fileName
                ]);
            }


            return redirect('/jenis')->with([
                'message' => 'Data berhasil diperbarui',
                'success' => true
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = JenisPengiriman::findOrFail($id);
        if ($jenis->pengiriman_biaya->count()) {
            return back();
        } else {
            if (File::exists('storage/jenis_pengiriman/' . $jenis->foto)) {
                File::delete('storage/jenis_pengiriman/' . $jenis->foto);
            }
            $jenis->delete();
            return redirect('/jenis')->with([
                'message' => 'Data berhasil dihapus',
                'success' => true
            ]);
        }
    }
}
