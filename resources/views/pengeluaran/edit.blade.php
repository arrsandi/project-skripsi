@extends('layouts.app')
@section('title', 'Pengeluaran')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengeluaran">Pengeluaran</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/pengeluaran/update/{{ $pengeluaran->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control  @error('tanggal') is-invalid @enderror"
                                value="{{ $pengeluaran->tanggal }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ $pengeluaran->keterangan }}</textarea>

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah"
                                class="form-control  @error('jumlah') is-invalid @enderror"
                                value="{{ $pengeluaran->jumlah }}">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="/pengeluaran" class="btn btn-danger">Kembali</a>
                        @if (auth()->user()->level != 'staff' || $pengeluaran->user_id == auth()->user()->id)
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        @endif
                    </div>
                </div>

        </div>
        </form>
    </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
@endpush
