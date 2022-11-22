@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recomendasi belum di tindak lanjut</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('tindak_lanjut_store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="kode_temuan">Kode Temuan</label>
                                <input type="text" id="kode_temuan" name="kode_temuan" class="form-control shadow-none" value="{{ $data['kode_temuan'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kode_rekomendasi">Kode Rekomendasi</label>
                                <input type="text" id="kode_rekomendasi" name="kode_rekomendasi" class="form-control shadow-none" value="{{ $data['kode_rekomendasi'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kode_lha">Kode LHA</label>
                                <input type="text" id="kode_lha" name="kode_lha" class="form-control shadow-none" value="{{ $data['kode_lha'] }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="tindak_lanjut">Tindak Lanjut</label>
                                <textarea name="tindak_lanjut" id="tindak_lanjut" rows="5" class="form-control shadow-none"></textarea>
                                <span class="text-muted">Anda dapat menambahkan link bukti tindak lanjut disini (seperti GDrive, atau lainnya)</span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control shadow-none" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control shadow-none" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" id="jabatan" name="jabatan" class="form-control shadow-none" value="">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('tindak_lanjut') }}" class="btn btn-default">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

