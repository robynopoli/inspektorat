@extends('admin.mcp-kpk.layout')

@section('title', 'Area intervensi (Tambah data)')

@section('contents')
    <form action="{{ route('admin.mcp-kpk.area-intervensi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan"
                class="form-control @error('keterangan') is-invalid @enderror shadow-none" value="">
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
            <a href="{{ route('admin.mcp-kpk.area-intervensi.index') }}" class="btn btn-default">
                Batal
            </a>
        </div>
    </form>
@endsection
