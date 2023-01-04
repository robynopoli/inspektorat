@extends('admin.mcp-kpk.layout')

@section('title', 'Sub Indikator (Tambah data)')

@section('contents')
    <form action="{{ route('admin.mcp-kpk.sub-indikator.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="mcp_indikator_id">Area Intervensi - Indikator</label>
            <select name="mcp_indikator_id" class="form-control @error('mcp_indikator_id') is-invalid @enderror shadow-none">
                <option value="">Pilih</option>
                @foreach ($mcp_indikator as $i)
                    <option value="{{ $i->id }}" {{ $i->id == $data->mcp_indikator_id ? 'selected' : '' }}>
                        {{ $i->area_intervensi->keterangan ?? '' }} - {{ $i->keterangan }}
                    </option>
                @endforeach
            </select>
            @error('mcp_indikator_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="obrik_id">Obrik / OPD</label>
            <select name="obrik_id" class="form-control @error('obrik_id') is-invalid @enderror shadow-none">
                <option value="">Pilih</option>
                @foreach ($obrik as $i)
                    <option value="{{ $i->id }}" {{ $i->id == $data->obrik_id ? 'selected' : '' }}>
                        {{ $i->bidang_obrik ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('obrik_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan">Keterangan Sub Indikator</label>
            <input type="text" name="keterangan" id="keterangan"
                class="form-control @error('keterangan') is-invalid @enderror shadow-none" value="{{ $data->keterangan }}">
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
            <a href="{{ route('admin.mcp-kpk.sub-indikator.index') }}" class="btn btn-default">
                Batal
            </a>
        </div>
    </form>
@endsection
