@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card animate__animated animate__fadeInUp">
                    <div class="card-header">Tindak Lanjut</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">Status</th>
                                    <th>Kode</th>
                                    <th>NIP / Pegawai</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $i)
                                    <tr>
                                        <td class="text-center">
                                            @if($i->status == 'd')
                                                <div class="badge bg-warning text-capitalize">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                            @if($i->status == 's')
                                                <div class="badge bg-success text-uppercase">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                            @if($i->status == 'belum diproses')
                                                <div class="badge bg-warning text-capitalize">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                            @if($i->status == 'belum diproses' || $i->status == 'd')
                                                <br>
                                                <a href="{{ route('tindak_lanjut_create', ['kode_rekomendasi' => $i['kode_rekomendasi']]) }}" class="btn btn-sm btn-primary me-2">
                                                    Edit
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            Kode rekomendasi : {{ $i->kode_rekomendasi }} <br>
                                            Kode temuan : {{ $i->kode_temuan }} <br>
                                            Kode LHA : {{ $i->kode_lha }} <br>
                                        </td>
                                        <td>
                                            NIP : {{ $i->nip }} <br>
                                            Nama : {{ $i->nama }} <br>
                                            Jabatan : {{ $i->jabatan }}
                                        </td>
                                        <td>{{ $i->tindak_lanjut }}</td>
                                        <td>{{ $i->keterangan }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
@endsection
