@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Akses pegawai ke Obrik</div>
                    <div class="card-body">
                        <form action="{{ route('setting-pegawai.create') }}" method="GET">
                            <div class="mb-3">
                                <label class="form-label">Cari pegawai</label>
                                <div class="input-group">
                                    <input type="text" class="form-control shadow-none" name="q" value="{{ request()->get('q') }}">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                                <div class="form-text">Masukkan NIP/Nama untuk melakukan pencarian. Source data Si-Mutiara</div>
                            </div>
                        </form>

                        <form action="{{ route('setting-pegawai.store') }}" method="POST">
                            @csrf
{{--                            <input type="text" name="nip" value="198211232014061004">--}}
{{--                            <input type="text" name="obriks" value="527110002-Satuan Polisi Pamong Praja">--}}
                            <div class="mb-3">
                                @foreach($data_pegawai as $pegawai)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="nip" id="{{ $pegawai['nip'] }}" value="{{ $pegawai['nip'] }}">
                                        <label class="form-check-label" for="{{ $pegawai['nip'] }}">
                                            {{ $pegawai['nip'] }} -
                                            {{ $pegawai['nama'] }} <br>
                                            <small><i>{{ $pegawai['opd'] }}</i></small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @if(count($data_pegawai) > 0)
                                <div class="mb-3">
                                    <label for="">Obrik</label>
                                    <select class="form-select shadow-none mb-3" id="select-obrik" name="obriks">
                                        <option selected>Pilih Obrik</option>
                                        @foreach($data_obrik as $obrik)
                                            <option value="{{ $obrik['Kode_Bidang_Obrik'] }}-{{ $obrik['Nama_Bidang_Obrik'] }}">
                                                {{ $obrik['Kode_Bidang_Obrik'] }} - {{ $obrik['Nama_Bidang_Obrik'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function (){
            $( '#select-obrik' ).select2( {
                theme: 'bootstrap-5'
            } );
        })
    </script>
@endsection
