<?php

namespace App\Http\Controllers;


use App\Models\BiayaPengiriman;
use App\Models\JenisPengiriman;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BiayaPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $biaya_pengiriman = BiayaPengiriman::latest()->get()->sortBy('jenis_pengiriman_id');
        return view('biaya_pengiriman.index', compact('biaya_pengiriman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = Unit::latest()->get();
        $jenis = JenisPengiriman::latest()->get();
        return view('biaya_pengiriman.create', compact('unit', 'jenis'));
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
                'unit_id' => 'required',
                'rute_asal' => 'required',
                'rute_tujuan' => 'required',
                'biaya_pengiriman' => 'required',
                'jenis_pengiriman_id' => 'required'
            ],
            [
                'unit_id.required' => 'Unit tidak boleh kosong!',
                'rute_asal.required' => 'Rute asal tidak boleh kosong!',
                'rute_tujuan.required' => 'Rute tujuan tidak boleh kosong!',
                'biaya_pengiriman.required' => 'Biaya pengiriman tidak boleh kosong!',
                'jenis_pengiriman_id.required' => 'Jenis pengiriman tidak boleh kosong!'
            ]
        );

        $unit = $request->unit_id;
        $asal = $request->rute_asal;
        $tujuan = $request->rute_tujuan;
        $jenis = $request->jenis_pengiriman_id;
        $cek = BiayaPengiriman::where(['unit_id' => $unit, 'rute_asal' => $asal, 'rute_tujuan' =>  $tujuan, 'jenis_pengiriman_id' => $jenis])->first();
        if (!$cek) {
            BiayaPengiriman::create([
                'unit_id' => $unit,
                'rute_asal' => $asal,
                'rute_tujuan' => $tujuan,
                'jenis_pengiriman_id' => $jenis,
                'biaya_pengiriman' => $request->biaya_pengiriman
            ]);

            return redirect('/biaya_pengiriman')->with([
                'message' => 'Data berhasil ditambahkan',
                'success' => true
            ]);
        } else {
            throw ValidationException::withMessages([
                'unit_id' => 'Biaya pengiriman untuk unit dan rute pengiriman ini sudah diinputkan!',
                'rute_asal' => 'Rute asal untuk unit dan rute pengiriman ini sudah diinputkan!',
                'rute_tujuan' => 'Rute tujuan untuk unit dan rute pengiriman ini sudah diinputkan!',
                'jenis_pengiriman_id' => 'Jenis pengiriman untuk unit dan rute pengiriman ini sudah diinputkan!'
            ]);
        }
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
        $biaya_pengiriman = BiayaPengiriman::findOrFail($id);
        $unit = Unit::latest()->get();
        $jenis = JenisPengiriman::latest()->get();
        return view('biaya_pengiriman.edit', compact('biaya_pengiriman', 'unit', 'jenis'));
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
                'unit_id' => 'required',
                'rute_asal' => 'required',
                'rute_tujuan' => 'required',
                'biaya_pengiriman' => 'required',
                'jenis_pengiriman_id' => 'required',
            ],
            [
                'unit_id.required' => 'Unit tidak boleh kosong!',
                'rute_asal.required' => 'Rute asal tidak boleh kosong!',
                'rute_tujuan.required' => 'Rute tujuan tidak boleh kosong!',
                'biaya_pengiriman.required' => 'Biaya pengiriman tidak boleh kosong!',
                'jenis_pengiriman_id.required' => 'Jenis pengiriman tidak boleh kosong!'
            ]
        );

        $unit = $request->unit_id;
        $asal = $request->rute_asal;
        $tujuan = $request->rute_tujuan;
        $jenis = $request->jenis_pengiriman_id;
        $cek = BiayaPengiriman::where(['unit_id' => $unit, 'rute_asal' => $asal, 'rute_tujuan' =>  $tujuan, 'jenis_pengiriman_id' => $jenis])->where('id', '!=', $id)->first();

        $biaya = BiayaPengiriman::findOrFail($id);

        if (!$cek && $id) {
            $biaya->update([
                'unit_id' => $request->unit_id,
                'rute_asal' => $request->rute_asal,
                'rute_tujuan' => $request->rute_tujuan,
                'biaya_pengiriman' => $request->biaya_pengiriman,
                'jenis_pengiriman_id' => $request->jenis_pengiriman_id,
            ]);
            return redirect('/biaya_pengiriman')->with([
                'message' => 'Data berhasil diperbarui',
                'success' => true
            ]);
        } else {
            throw ValidationException::withMessages([
                'unit_id' => 'Biaya pengiriman untuk unit dan rute pengiriman ini sudah diinputkan!',
                'rute_asal' => 'Rute asal untuk unit dan rute pengiriman ini sudah diinputkan!',
                'rute_tujuan' => 'Rute tujuan untuk unit dan rute pengiriman ini sudah diinputkan!',
                'jenis_pengiriman' => 'Jenis pengiriman untuk unit dan rute pengiriman ini sudah diinputkan!'
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
        $biaya_pengiriman = BiayaPengiriman::findOrFail($id);
        if ($biaya_pengiriman->detail->count() || $biaya_pengiriman->keranjang->count()) {
            return back();
        }
        $biaya_pengiriman->delete();
        return redirect('/biaya_pengiriman')->with([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
