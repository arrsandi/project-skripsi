@extends('layouts.app')
@section('title', 'Syarat & Ketentuan Pengiriman')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/syarat_ketentuan">Syarat & Ketentuan Pengiriman</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/syarat_ketentuan/update/{{ $syarat_ketentuan->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul"
                                class="form-control  @error('judul') is-invalid @enderror"
                                value="{{ $syarat_ketentuan->judul }}">
                            @error('judul')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea name="isi" id="isi" cols="30" rows="10">{!! $syarat_ketentuan->isi !!}</textarea>
                            @error('isi')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/syarat_ketentuan" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
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
            $("#isi").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush
