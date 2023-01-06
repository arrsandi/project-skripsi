<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index');
    }

    public function akun(Request $request)
    {

        $attr =   $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'email|unique:users,email,' . auth()->user()->id
            ],
            [
                'name.required' => 'Nama pengguna tidak boleh kosong!',
                'email.unique' => 'Email sudah digunakan pengguna lain!'
            ]
        );

        $data =  auth()->user()->update($attr);
        if ($data) {
            return back()->with([
                'message' => 'Profil berhasil diperbarui',
                'success' => true
            ]);
        }
        return back()->with([
            'message' => 'Profil gagal diperbarui',
            'error' => true
        ]);
    }

    public function password(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'old_password.required' => 'Password sekarang tidak boleh kosong!',
                'password.required' => 'Password baru tidak boleh kosong!',
                'password.min' => 'Password baru minimal 6 karakter!',
                'password.confirmed' => 'Password baru tidak sesuai dengan password konfirmasi!',
                'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong!',
            ]
        );

        $current_password = auth()->user()->password;
        $old_password = $request->old_password;
        if (Hash::check($old_password, $current_password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return back()->with([
                'message' => 'Password berhasil diperbarui',
                'success' => true
            ]);
        } else {
            return back()->withErrors(['old_password' => 'Password sekarang tidak sesuai dengan yang diinputkan!']);
        }
    }
}
