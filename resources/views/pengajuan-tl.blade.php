@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pengajuan Tindak Lanjut</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr class="text-center">
                                    <th>KODE</th>
                                    <th>TINDAK LANJUT</th>
                                    <th>NIP / PEGAWAI</th>
                                    <th>STATUS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $i)
                                    <tr>
                                        <td>
                                            Kode rekomendasi : {{ $i->kode_rekomendasi }} <br>
                                            Kode temuan : {{ $i->kode_temuan }} <br>
                                            Kode LHA : {{ $i->kode_lha }} <br>
                                        </td>
                                        <td>{{ $i->tindak_lanjut }}</td>
                                        <td>
                                            NIP : {{ $i->nip }} <br>
                                            Nama : {{ $i->nama }} <br>
                                            Jabatan : {{ $i->jabatan }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('pengajuan_tl_edit', $i->id) }}" class="btn btn-outline-primary btn-sm text-capitalize">
                                                {{ $i->status }}
                                            </a>
                                        </td>
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
