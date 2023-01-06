<?php

namespace App\Http\Controllers;


use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::latest()->get();
        return view('unit.index', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('unit.create');
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
                'nama' => 'required|unique:unit,nama'
            ],
            [
                'nama.required' => 'Nama unit tidak boleh kosong!',
                'nama.unique' => 'Nama unit sudah ada!',
            ]
        );
        $data = $request->only('nama');
        $data['slug'] = Str::slug($request->nama);

        Unit::create($data);

        return redirect('/unit')->with([
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('unit.edit', compact('unit'));
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
        $this->validate(
            $request,
            [
                'nama' => 'required|string|unique:unit,nama,' . $id
            ],
            [
                'nama.required' => 'Nama unit tidak boleh kosong!',
                'nama.unique' => 'Nama unit sudah ada!',
            ]
        );
        $unit = Unit::findOrFail($id);
        $unit->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama)
        ]);
        return redirect('/unit')->with([
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
        $unit = Unit::findOrFail($id);
        if ($unit->biaya_pengantaran->count()) {
            return back();
        } else {
            $unit->delete();
            return redirect('/unit')->with([
                'message' => 'Data berhasil dihapus',
                'success' => true
            ]);
        }
    }
}
