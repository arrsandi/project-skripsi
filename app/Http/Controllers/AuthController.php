<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->user() == true) {
            return back();
        } else {
            return view('login');
        }
    }

    public function proses_login(Request $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];
        $cek_email = User::where(['email' => $request->email])->first();


        if (!$cek_email) {
            return back()->with('loginError', 'Email belum terdaftar!');
        } else {
            $cek_pass = Hash::check($request->password, $cek_email->getAuthPassword());
            if ($cek_pass) {
                Auth::attempt($credentials);
                $request->session()->regenerate();
                return redirect('/dashboard');
            } else {
                return back()->with('loginError', 'Password salah!');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function pengguna()
    {
        $users = User::latest()->get();
        return view('pengguna.index', compact('users'));
    }

    public function input_pengguna()
    {
        return view('pengguna.create');
    }


    public function store_pengguna(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ],
            [
                'name.required' => 'Nama pengguna tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.unique' => 'Email sudah digunakan oleh pengguna lain!',
                'email.email' => 'Email yang diinputkan tidak sesuai format email!',
                'password.required' => 'Password tidak boleh kosong!',
                'password.min' => 'Password minimal 6 karakter!',
                'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong!',
                'password_confirmation.same' => 'Password konfirmasi harus sama dengan password!',
            ]
        );
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'status' => 1
        ]);
        return redirect('/pengguna')->with([
            'message' => 'Data berhasil ditambahkan',
            'success' => true
        ]);
    }

    public function edit_pengguna($id)
    {
        $user = User::findOrFail($id);
        return view('pengguna.edit', compact('user'));
    }

    public function update_pengguna(Request $request, $id)
    {
        if ($request->new_password == '') {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'status' => 'required'
                ],
                [
                    'name.required' => 'Nama pengguna tidak boleh kosong!',
                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Email yang diinputkan tidak sesuai format email!',
                    'email.unique' => 'Email sudah digunakan oleh pengguna lain!',
                    'name.regex' => 'Nama pengguna tidak valid!',
                    'status.required' => 'Status akun tidak boleh kosong!'
                ]
            );
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'status' => $request->status
            ]);

            return redirect('/pengguna')->with([
                'message' => 'Data berhasil diperbarui',
                'success' => true
            ]);
        } else {
            $this->validate(
                $request,
                [
                    'name' => 'required|string',
                    'email' => 'required|unique:users,email,' . $id,
                    'level' => 'required',
                    'status' => 'required',
                    'new_password' => 'required|min:6',
                    'password_confirmation' => 'required|same:new_password|min:6'
                ],
                [
                    'name.required' => 'Nama pengguna tidak boleh kosong!',
                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Email yang diinputkan tidak sesuai format email!',
                    'email.unique' => 'Email sudah digunakan oleh pengguna lain!',
                    'level.required' => 'Level pengguna tidak boleh kosong!',
                    'status.required' => 'Status pengguna tidak boleh kosong!',
                    'new_password.required' => 'Password baru tidak boleh kosong!',
                    'new_password.min' => 'Password baru minimal 6 karakter!',
                    'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong!',
                    'password_confirmation.same' => 'Password konfirmasi harus sama dengan password baru!',
                    'name.regex' => 'Nama pengguna tidak valid!'
                ]
            );
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'status' => $request->status,
                'password' => Hash::make($request->new_password)
            ]);
            return redirect('/pengguna')->with([
                'message' => 'Data berhasil diperbarui',
                'success' => true
            ]);
        }
    }

    public function delete_pengguna($id)
    {
        $user = User::findOrFail($id);
        if ($user->data_pengiriman->count() || $user->data_pengeluaran->count()) {
            return back();
        } else {
            $user->delete();
            return redirect('/pengguna')->with([
                'message' => 'Data berhasil dihapus',
                'success' => true
            ]);
        }
    }


    public function register()
    {
        return view('register');
    }

    public function proses_register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ],
            [
                'name.required' => 'Nama pengguna tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.unique' => 'Email sudah digunakan oleh pengguna lain!',
                'email.email' => 'Email yang diinputkan tidak sesuai format email!',
                'password.required' => 'Password tidak boleh kosong!',
                'password.min' => 'Password minimal 6 karakter!',
                'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong!',
                'password_confirmation.same' => 'Password konfirmasi harus sama dengan password!',
            ]
        );
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'pelanggan',
            'status' => 1
        ]);
        return redirect('/login')->with([
            'message' => 'Akun berhasil didaftarkan!',
            'success' => true
        ]);
    }
}
