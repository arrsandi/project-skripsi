@extends('layouts.app')
@section('title', 'Jenis Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/jenis">Jenis Pengiriman</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/jenis/update/{{ $jenis->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan</label>
                            <input type="text" name="nama_layanan" id="nama_layanan"
                                class="form-control  @error('nama_layanan') is-invalid @enderror"
                                value="{{ $jenis->nama_layanan }}">
                            @error('nama_layanan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ $jenis->deskripsi }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label> <br>
                            <img src="{{ asset('storage/jenis_pengiriman/' . $jenis->foto) }}" alt=""
                                width="150px">
                            <br>
                            <small>(jpeg, jpg, png)</small>
                            <input type="file" name="foto" id="foto"
                                class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>
                    <div class="card-footer">
                        <a href="/jenis" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection
