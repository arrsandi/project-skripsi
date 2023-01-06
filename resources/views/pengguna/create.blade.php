@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengguna">Manajemen Pengguna</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/pengguna/input" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" id="name"
                                class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level">Level Pengguna</label>
                            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                <option value="">Pilih Level Pengguna</option>
                                <option value="pelanggan">Pelanggan</option>
                                <option value="staff">Staff</option>
                                <option value="koordinator">Koordinator</option>
                                <option value="owner">Owner</option>
                            </select>
                            @error('level')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label for="password">Password</label>
                            <div class="">
                                <input type='password' name='password'
                                    class="
                                form-control @error('password') is-invalid @enderror"
                                    id="password">
                                @error('password')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="">
                                <input type='password' name=" password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/pengguna" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
@endpush
