<?php

namespace App\Http\Controllers;


use App\Models\BiayaPengantaran;
use App\Models\BiayaPengiriman;
use App\Models\Detail;
use App\Models\Keranjang;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengiriman = Pengiriman::latest()->get();
        $total = Pengiriman::where('status_pengiriman', 'Selesai')->sum('total_biaya_keseluruhan');
        if (auth()->user()->level == 'pelanggan') {
            $pengiriman_pelanggan = Pengiriman::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            return view('pengiriman.index', compact('pengiriman_pelanggan', 'total'));
        } else {
            return view('pengiriman.index', compact('pengiriman', 'total'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_pengiriman()
    {

        $biaya_pengiriman = BiayaPengiriman::latest()->get()->sortBy('jenis_pengiriman_id');
        $data_keranjang =  Keranjang::where('user_id', Auth::user()->id)->count();
        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();

        return view('pengiriman.create', compact('biaya_pengiriman', 'keranjang', 'data_keranjang'));
    }

    public function edit_pengiriman($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $biaya_pengiriman = BiayaPengiriman::latest()->get()->sortBy('jenis_pengiriman_id');
        if ($pengiriman->user_id != auth()->user()->id && auth()->user()->level == 'pelanggan') {
            return redirect('/pengiriman')->with([
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini!',
                'error' => true
            ]);
        } else {
            return view('pengiriman.edit', compact('pengiriman', 'biaya_pengiriman'));
        }
    }

    public function update_pengiriman(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'tanggal' => 'required',
                'nama_pengirim' => 'required',
                'telepon_pengirim' => ['required', 'regex:/^(^\+62|62|^08|0)(\d{3,4}-?){2}\d{3,4}$/'],
                'alamat_pengirim' => 'required',
                'potongan' => 'required',
                'total_biaya' => 'required',
                'total_biaya_keseluruhan' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'nama_pengirim.required' => 'Nama pengirim tidak boleh kosong!',
                'telepon_pengirim.required' => 'Telepon pengirim tidak boleh kosong!',
                'telepon_pengirim.regex' => 'Format telepon tidak valid!',
                'alamat_pengirim.required' => 'Alamat pengirim tidak boleh kosong!',
                'potongan.required' => 'Potongan harga tidak boleh kosong!',
                'total_biaya.required' => 'Total biaya tidak boleh kosong!',
                'total_biaya_keseluruhan.required' => 'Total biaya keseluruhan tidak boleh kosong!',
            ]
        );

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update([
            // 'id' => $request->id_modal,
            'user_id' => $pengiriman->user_id,
            'tanggal' => $request->tanggal,
            'nama_pengirim' => $request->nama_pengirim,
            'telepon_pengirim' => $request->telepon_pengirim,
            'alamat_pengirim' => $request->alamat_pengirim,
            'potongan' => $request->potongan,
            'total_biaya' => $request->total_biaya,
            'potongan' => $request->potongan,
            'total_biaya_keseluruhan' => $request->total_biaya_keseluruhan
        ]);
        return redirect('/pengiriman/detail/' . $id)->with([
            'message' => 'Data berhasil diperbarui',
            'success' => true
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $data = Pengiriman::findOrFail($id);
        return view('pengiriman/status_pengiriman')->with([
            'data' => $data
        ]);
    }



    public function store_pengiriman(Request $request)
    {
        $this->validate(
            $request,
            [
                'tanggal' => 'required',
                'nama_pengirim' => 'required',
                'telepon_pengirim' => ['required', 'regex:/^(^\+62|62|^08|0)(\d{3,4}-?){2}\d{3,4}$/'],
                'alamat_pengirim' => 'required',
                'total_biaya' => 'required',
                'potongan' => 'required',
                'total_biaya_keseluruhan' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'nama_pengirim.required' => 'Nama pengirim tidak boleh kosong!',
                'telepon_pengirim.required' => 'Telepon pengirim tidak boleh kosong!',
                'telepon_pengirim.regex' => 'Format telepon tidak valid!',
                'alamat_pengirim.required' => 'Alamat pengirim tidak boleh kosong!',
                'potongan.required' => 'Potongan harga tidak boleh kosong!',
                'total_biaya.required' => 'Total biaya tidak boleh kosong!',
                'total_biaya_keseluruhan.required' => 'Total biaya keseluruhan tidak boleh kosong!'
            ]
        );

        $pengiriman =  Pengiriman::create([
            'user_id' => Auth::user()->id,
            'noinvoice' => $request->noinvoice,
            'tanggal' => $request->tanggal,
            'nama_pengirim' => $request->nama_pengirim,
            'telepon_pengirim' => $request->telepon_pengirim,
            'alamat_pengirim' => $request->alamat_pengirim,
            'total_biaya' => $request->total_biaya,
            'potongan' => $request->potongan,
            'total_biaya_keseluruhan' => $request->total_biaya_keseluruhan,
            'status_pengiriman' => 'Diproses'
        ]);

        $id = $pengiriman->id;

        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();

        foreach ($keranjang as $cart) {
            Detail::create([
                'transaksi_id' => $id,
                'nama_penerima' => $cart->nama_penerima,
                'telepon_penerima' => $cart->telepon_penerima,
                'alamat_penerima' => $cart->alamat_penerima,
                'biaya_pengiriman_id' => $cart->biaya_pengiriman_id,
                'nama_kapal' => $cart->nama_kapal,
                'merk_type' => $cart->merk_type,
                'warna' => $cart->warna,
                'no_polisi' => $cart->no_polisi,
                'no_rangka' => $cart->no_rangka,
                'no_mesin' => $cart->no_mesin,
                'biaya_kirim' => $cart->biaya_kirim,
                'biaya_koordinasi' => $cart->biaya_koordinasi,
                'biaya_tambahan' => $cart->biaya_tambahan,
                'keterangan' => $cart->keterangan,
                'total_biaya_per_unit' => $cart->total_biaya_per_unit,
            ]);
        }

        Keranjang::where('user_id', Auth::user()->id)->delete();

        return redirect('/pengiriman/detail/' . $id)->with([
            'message' => 'Data berhasil ditambahkan',
            'success' => true
        ]);
    }

    public function detail_data($id)
    {
        $pengiriman =  Pengiriman::findOrFail($id);
        if ($pengiriman->user_id != auth()->user()->id && auth()->user()->level == 'pelanggan') {
            return back();
        } else {
            return view('pengiriman.detail', compact('pengiriman'));
        }
    }


    public function cetak_tagihan($id)
    {
        $pengiriman =  Pengiriman::findOrFail($id);
        return view('pengiriman.tagihan', compact('pengiriman'));
    }

    public function berita_acara($id)
    {
        $berita_acara = Detail::findOrFail($id);
        return view('pengiriman.berita_acara', compact('berita_acara'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete_pengiriman($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $pengiriman->delete();
        return redirect('/pengiriman')->with([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }



    public function set($id = 0)
    {
        $data = BiayaPengiriman::findOrFail($id);
        echo json_encode($data);
    }

    public function getBiayaPengiriman($id = 0)
    {
        $data = BiayaPengiriman::findOrFail($id);
        echo json_encode($data);
    }


    public function cetak_pemasukan(Request $request)
    {
        $request->validate(
            [
                'tanggal_awal' => 'required',
                'tanggal_akhir' => 'required'
            ],
            [
                'tanggal_awal.required' => 'Tanggal awal tidak boleh kosong!',
                'tanggal_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
            ]
        );

        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;


        $pemasukan = Pengiriman::select('*')
            ->from('transaksi_pengiriman')
            ->where('status_pengiriman', '=', 'Selesai')
            ->whereBetween('transaksi_pengiriman.tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $totalpemasukan = Pengiriman::where('status_pengiriman', '=', 'Selesai')->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->sum('total_biaya_keseluruhan');

        return view('pengiriman.cetak_pemasukan', compact('pemasukan', 'totalpemasukan', 'tanggal_awal', 'tanggal_akhir'));
    }



    public function status_pengiriman(Request $request, $id)
    {
        $data = Pengiriman::findOrFail($id);
        $data->update([
            'status_pengiriman' => $request->status_pengiriman
        ]);
        return response()->json(['success' => 'Status pengiriman berhasil diperbarui']);
    }
}
