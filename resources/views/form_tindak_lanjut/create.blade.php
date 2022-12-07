@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kode_temuan">Kode Temuan</label>
                                                <input type="text" id="kode_temuan" name="kode_temuan" class="form-control shadow-none" value="{{ $data['kode_temuan'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kode_rekomendasi">Kode Rekomendasi</label>
                                                <input type="text" id="kode_rekomendasi" name="kode_rekomendasi" class="form-control shadow-none" value="{{ $data['kode_rekomendasi'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kode_lha">Kode LHA</label>
                                                <input type="text" id="kode_lha" name="kode_lha" class="form-control shadow-none" value="{{ $data['kode_lha'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tindak_lanjut">Tindak Lanjut</label>
                                        <textarea name="tindak_lanjut" id="tindak_lanjut" rows="5" class="form-control shadow-none"></textarea>
                                        <span class="text-muted">Anda dapat menambahkan link bukti tindak lanjut disini (seperti GDrive, atau lainnya)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Penanggung Jawab</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Cari pegawai</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow-none" id="q" name="q" value="{{ request()->get('q') }}">
                                            <button class="btn btn-outline-secondary" type="button" onclick="getPegawai()">Cari</button>
                                        </div>
                                        <div class="form-text">Masukkan NIP/Nama untuk melakukan pencarian. Source data Si-Mutiara</div>
                                        <div class="text-danger" id="msg_error"></div>
                                    </div>
                                    <div class="mb-3">
                                        @foreach($data_pegawai as $pegawai)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="nip" id="{{ $pegawai['nip'] }}" value="{{ $pegawai['nip'] }}">
                                                <label class="form-check-label" for="{{ $pegawai['nip'] }}">
                                                    <b>{{ $pegawai['nip'] }}</b> -
                                                    {{ $pegawai['nama'] }} <br>
                                                    <small>{{ $pegawai['jabatan'] }}</small>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>




{{--                            <div class="mb-3">--}}
{{--                                <label for="nip">NIP</label>--}}
{{--                                <input type="text" id="nip" name="nip" class="form-control shadow-none" value="">--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="nama">Nama</label>--}}
{{--                                <input type="text" id="nama" name="nama" class="form-control shadow-none" value="">--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="jabatan">Jabatan</label>--}}
{{--                                <input type="text" id="jabatan" name="jabatan" class="form-control shadow-none" value="">--}}
{{--                            </div>--}}
                            <div class="mb-3">
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

@section('js')
    <script>
        function getPegawai(){
            let cari = document.getElementById('q').value;
            let msg_error = document.getElementById('msg_error');
            msg_error.innerHTML = '';
            if (cari.length === 0){
                msg_error.innerHTML = 'Anda belum memasukkan pencarian';
            }else{
                let kode_rekomendasi = '{{ request()->get('kode_rekomendasi') }}';
                location.replace('{{ route('tindak_lanjut_create') }}?kode_rekomendasi='+kode_rekomendasi+'&q='+cari);
                // console.log();
            }
        }
    </script>
@endsection

