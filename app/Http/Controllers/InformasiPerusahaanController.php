<?php

namespace App\Http\Controllers;

use App\Models\InformasiPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InformasiPerusahaanController extends Controller
{
    public function index()
    {
        $informasi_perusahaan = InformasiPerusahaan::first();
        return view('informasi_perusahaan.index', compact('informasi_perusahaan'));
    }



    public function update(Request $request, $id)
    {
        $informasi_perusahaan = InformasiPerusahaan::findOrFail($id);

        if ($request->file('cover') == "") {
            $request->validate(
                [
                    'nama_perusahaan' => 'required',
                    'deskripsi_perusahaan' => 'required',
                    'telepon_perusahaan' => 'required',
                    'email_perusahaan' => 'required',
                    'alamat_perusahaan' => 'required',
                ],
                [
                    'nama_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'deskripsi_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'telepon_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'email_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'alamat_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!'
                ]
            );
            $informasi_perusahaan->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                'telepon_perusahaan' => $request->telepon_perusahaan,
                'email_perusahaan' => $request->email_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan
            ]);
            return redirect('/informasi_perusahaan')->with([
                'message' => 'Informasi perusahaan berhasil diperbarui',
                'success' => true
            ]);
        } else {
            $request->validate(
                [
                    'nama_perusahaan' => 'required',
                    'deskripsi_perusahaan' => 'required',
                    'telepon_perusahaan' => 'required',
                    'email_perusahaan' => 'required',
                    'alamat_perusahaan' => 'required',
                    'cover'     => 'required|mimes:png,jpg,jpeg'
                ],
                [
                    'nama_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'deskripsi_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'telepon_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'email_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'alamat_perusahaan.required' => 'Nama perusahaan tidak boleh kosong!',
                    'cover.required' => 'Cover tidak boleh kosong!',
                    'cover.mimes' => 'Format cover tidak sesuai!'
                ]
            );

            if (File::exists('storage/app/public/informasi_perusahaan/' . $informasi_perusahaan->cover)) {
                File::delete('storage/app/public/informasi_perusahaan/' . $informasi_perusahaan->cover);
                $fileName = time() . '.' . $request->cover->extension();
                $request->file('cover')->storeAs('public/informasi_perusahaan', $fileName);

                $informasi_perusahaan->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                    'telepon_perusahaan' => $request->telepon_perusahaan,
                    'email_perusahaan' => $request->email_perusahaan,
                    'alamat_perusahaan' => $request->alamat_perusahaan,
                    'cover' => $fileName,
                ]);
            } else {
                $fileName = time() . '.' . $request->cover->extension();
                $request->file('cover')->storeAs('public/informasi_perusahaan', $fileName);

                $informasi_perusahaan->update([
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                    'telepon_perusahaan' => $request->telepon_perusahaan,
                    'email_perusahaan' => $request->email_perusahaan,
                    'alamat_perusahaan' => $request->alamat_perusahaan,
                    'cover' => $fileName,
                ]);
            }
            return redirect('/informasi_perusahaan')->with([
                'message' => 'Infor berhasil diperbarui',
                'success' => true
            ]);
        }
    }
}
