@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengguna">Manajemen Pengguna</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/pengguna/update/{{ $user->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" id="name"
                                class="form-control  @error('name') is-invalid @enderror" value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control  @error('email') is-invalid @enderror" value="{{ $user->email }}">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level">Level Pengguna</label>
                            @if ($user->level == 'owner')
                                <select name="level" id="level"
                                    class="form-control @error('level') is-invalid @enderror" readonly>
                                    <option value="owner" {{ $user->level == 'owner' ? 'selected' : '' }}>
                                        Owner</option>
                                </select>
                            @elseif ($user->level == 'pelanggan')
                                <select name="level" id="level"
                                    class="form-control @error('level') is-invalid @enderror" readonly>
                                    <option value="pelanggan" {{ $user->level == 'pelanggan' ? 'selected' : '' }}>
                                        Pelanggan</option>
                                </select>
                            @else
                                <select name="level" id="level"
                                    class="form-control @error('level') is-invalid @enderror">
                                    <option value="">Pilih Level Pengguna</option>
                                    <option value="staff" {{ $user->level == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="koordinator" {{ $user->level == 'koordinator' ? 'selected' : '' }}
                                        readonly>
                                        Koordinator
                                    </option>
                                </select>
                            @endif
                            @error('level')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                @error('status')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </select>


                        </div>


                        <div class="form-group ">
                            <label for="password">Password</label>
                            <div class="">
                                <input type='password' name='new_password'
                                    class="
                                form-control @error('new_password') is-invalid @enderror"
                                    id="new_password">
                                @error('new_password')
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
@endpush
