<?php

namespace App\Http\Controllers;

use App\Models\BiayaPengantaran;
use App\Models\BiayaPengiriman;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function store_keranjang(Request $request)
    {
        $this->validate($request, [
            'nama_penerima' => 'required',
            'telepon_penerima' => ['required', 'regex:/^(^\+62|62|^08|0)(\d{3,4}-?){2}\d{3,4}$/'],
            'alamat_penerima' => 'required',
            'merk_type' => 'required',
            'warna' => 'required',
            'no_rangka' => 'required',
            'no_mesin' => 'required',
            'biaya_pengiriman_id' => 'required',
            'biaya_kirim' => 'required',
            'biaya_koordinasi' => 'required',
            'biaya_tambahan' => 'required',
            'total_biaya_per_unit' => 'required',
        ], [
            'transaksi_id.required' => 'ID transaksi tidak boleh kosong!',
            'nama_penerima.required' => 'Nama penerima tidak boleh kosong!',
            'telepon_penerima.required' => 'Telepon penerima tidak boleh kosong!',
            'telepon_penerima.regex' => 'Telepon penerima tidak valid!',
            'alamat_penerima.required' => 'Alamat penerima tidak boleh kosong!',
            'biaya_pengiriman_id.required' => 'Rute pengantaran tidak boleh kosong!',
            'merk_type.required' => 'Merk/tipe unit tidak boleh kosong!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'no_rangka.required' => 'No. Rangka tidak boleh kosong!',
            'no_mesin.required' => 'No. Mesin tidak boleh kosong!',
            'biaya_kirim.required' => 'Biaya antar tidak boleh kosong!',
            'biaya_tambahan.required' => 'Biaya tambahan tidak boleh kosong!',
            'biaya_koordinasi.required' => 'Biaya koordinasi tidak boleh kosong!',
            'total_biaya_per_unit.required' => 'Total biaya per unit tidak boleh kosong!'
        ]);

        Keranjang::create([
            'user_id' => Auth::user()->id,
            'nama_penerima' => $request->nama_penerima,
            'telepon_penerima' => $request->telepon_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'biaya_pengiriman_id' => $request->biaya_pengiriman_id,
            'nama_kapal' => $request->nama_kapal,
            'merk_type' => $request->merk_type,
            'warna' => $request->warna,
            'no_polisi' => $request->no_polisi,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'biaya_kirim' => $request->biaya_kirim,
            'biaya_koordinasi' => $request->biaya_koordinasi,
            'biaya_tambahan' => $request->biaya_tambahan,
            'keterangan' => $request->keterangan,
            'total_biaya_per_unit' => $request->total_biaya_per_unit,
        ]);

        return redirect()->back()->with([
            'message' => 'Data berhasil ditambahkan ke keranjang',
            'success' => true
        ]);
    }

    public function edit_keranjang($id)
    {
        $biaya_pengiriman = BiayaPengiriman::latest()->get()->sortBy('jenis_pengiriman_id');
        $keranjang = Keranjang::findOrFail($id);
        if (auth()->user()->id != $keranjang->user_id) {
            return back();
        } else {
            return view('pengiriman.keranjang_edit', compact('keranjang', 'biaya_pengiriman'));
        }
    }

    public function update_keranjang(Request $request, $id)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'telepon_penerima' => ['required', 'regex:/^(^\+62|62|^08|0)(\d{3,4}-?){2}\d{3,4}$/'],
            'alamat_penerima' => 'required',
            'biaya_pengiriman_id' => 'required',
            'merk_type' => 'required',
            'warna' => 'required',
            'no_rangka' => 'required',
            'no_mesin' => 'required',
            'biaya_pengiriman_id' => 'required',
            'biaya_kirim' => 'required',
            'biaya_koordinasi' => 'required',
            'biaya_tambahan' => 'required',
            'total_biaya_per_unit' => 'required',
        ], [
            'transaksi_id.required' => 'ID transaksi tidak boleh kosong!',
            'nama_penerima.required' => 'Nama penerima tidak boleh kosong!',
            'telepon_penerima.required' => 'Telepon penerima tidak boleh kosong!',
            'telepon_penerima.regex' => 'Format telepon tidak valid!',
            'alamat_penerima.required' => 'Alamat penerima tidak boleh kosong!',
            'biaya_pengiriman_id.required' => 'Rute pengantaran tidak boleh kosong!',
            'merk_type.required' => 'Merk/tipe unit tidak boleh kosong!',
            'warna.required' => 'Warna tidak boleh kosong!',
            'no_rangka.required' => 'No. Rangka tidak boleh kosong!',
            'no_mesin.required' => 'No. Mesin tidak boleh kosong!',
            'biaya_kirim.required' => 'Biaya antar tidak boleh kosong!',
            'biaya_tambahan.required' => 'Biaya tambahan tidak boleh kosong!',
            'biaya_koordinasi.required' => 'Biaya koordinasi tidak boleh kosong!',
            'total_biaya_per_unit.required' => 'Total biaya per unit tidak boleh kosong!'
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update([
            'id' => $request->id,
            'user_id' => $keranjang->user_id,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'telepon_penerima' => $request->telepon_penerima,
            'biaya_pengiriman_id' => $request->biaya_pengiriman_id,
            'nama_kapal' => $request->nama_kapal,
            'merk_type' => $request->merk_type,
            'warna' => $request->warna,
            'no_polisi' => $request->no_polisi,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'biaya_kirim' => $request->biaya_kirim,
            'biaya_koordinasi' => $request->biaya_koordinasi,
            'biaya_tambahan' => $request->biaya_tambahan,
            'keterangan' => $request->keterangan,
            'total_biaya_per_unit' => $request->total_biaya_per_unit,
        ]);
        return redirect('/pengiriman/input')->with([
            'message' => 'Data berhasil diperbarui',
            'success' => true
        ]);
    }

    public function delete_keranjang($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect()->back()->with([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
