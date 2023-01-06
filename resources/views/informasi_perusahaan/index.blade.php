@extends('layouts.app')
@section('title', 'Informasi Perusahaan')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/informasi_perusahaan">Informasi Perusahaan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/informasi_perusahaan/{{ $informasi_perusahaan->id }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                class="form-control  @error('nama_perusahaan') is-invalid @enderror"
                                value="{{ $informasi_perusahaan->nama_perusahaan }}">
                            @error('nama_perusahaan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_perusahaan">Deskripsi Perusahaan</label>
                            <textarea name="deskripsi_perusahaan" id="deskripsi_perusahaan" cols="30" rows="10">{!! $informasi_perusahaan->deskripsi_perusahaan !!}</textarea>
                            @error('deskripsi_perusahaan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telepon_perusahaan">Telepon Perusahaan</label>
                            <input type="text" name="telepon_perusahaan" id="telepon_perusahaan"
                                class="form-control  @error('telepon_perusahaan') is-invalid @enderror"
                                value="{{ $informasi_perusahaan->telepon_perusahaan }}">
                            @error('telepon_perusahaan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_perusahaan">Email Perusahaan</label>
                            <input type="email" name="email_perusahaan" id="email_perusahaan"
                                class="form-control  @error('email_perusahaan') is-invalid @enderror"
                                value="{{ $informasi_perusahaan->email_perusahaan }}">
                            @error('email_perusahaan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat_perusahaan">Alamat Perusahaan</label>
                            <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control">{!! $informasi_perusahaan->alamat_perusahaan !!}</textarea>
                            @error('alamat_perusahaan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cover">Cover</label> <br>
                            <img src="{{ asset('storage/informasi_perusahaan/' . $informasi_perusahaan->cover) }}"
                                alt="" width="150px"><br>
                            <small>(jpeg, jpg, png)</small>
                            <input type="file" name="cover" id="cover"
                                class="form-control @error('cover') is-invalid @enderror">
                            @error('cover')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        @if (auth()->user()->level == 'koordinator' || auth()->user()->level == 'staff')
                            <button class="btn btn-primary">Simpan</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#deskripsi_perusahaan").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <x-toast />
@endpush
