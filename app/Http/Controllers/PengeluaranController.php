<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::latest()->get();
        $total = DB::table("pengeluaran")->sum('jumlah');
        return view('pengeluaran.index', compact('pengeluaran', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengeluaran.create');
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
                'tanggal' => 'required',
                'keterangan' => 'required',
                'jumlah' => 'required'
            ],
            [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'keterangan.required' => 'Keterangan pengeluaran  tidak boleh kosong!',
                'jumlah.required' => 'Jumlah pengeluaran  tidak boleh kosong!',
                'jumlah.numeric' => 'Jumlah pengeluaran  yang dinputkan harus berupa angka!'
            ]
        );

        Pengeluaran::create([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah
        ]);

        return redirect('/pengeluaran')->with([
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
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('pengeluaran.edit', compact('pengeluaran'));
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
                'tanggal' => 'required',
                'keterangan' => 'required',
                'jumlah' => 'required'
            ],
            [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'keterangan.required' => 'Keterangan pengeluaran  tidak boleh kosong!',
                'jumlah.required' => 'Jumlah pengeluaran  tidak boleh kosong!'
            ]
        );

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah
        ]);

        return redirect('/pengeluaran')->with([
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
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return redirect('/pengeluaran')->with([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }

    public function cetak_pengeluaran(Request $request)
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

        $pengeluaran = Pengeluaran::select('*')
            ->from('pengeluaran')
            ->whereBetween('pengeluaran.tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $totalpengeluaran = Pengeluaran::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->sum('jumlah');

        return view('pengeluaran.cetak_pengeluaran', compact('pengeluaran', 'totalpengeluaran', 'tanggal_awal', 'tanggal_akhir'));
    }
}
