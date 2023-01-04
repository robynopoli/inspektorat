@extends('admin.mcp-kpk.layout')

@section('title', 'Indikator (Tambah data)')

@section('contents')
    <form action="{{ route('admin.mcp-kpk.indikator.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="area_intervensi_id">Area Intervensi</label>
            <select name="area_intervensi_id"
                class="form-control @error('area_intervensi_id') is-invalid @enderror shadow-none">
                <option value="">Pilih</option>
                @foreach ($area_intervensi as $i)
                    <option value="{{ $i->id }}">{{ $i->keterangan }}</option>
                @endforeach
            </select>
            @error('area_intervensi_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan">Keterangan Indikator</label>
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
            <a href="{{ route('admin.mcp-kpk.indikator.index') }}" class="btn btn-default">
                Batal
            </a>
        </div>
    </form>
@endsection
