@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Setting Pegawai
                        <a href="{{ route('setting-pegawai.create') }}" class="btn btn-primary btn-sm float-end">Tambah</a>
                    </div>

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
                                    <th>PEGAWAI</th>
                                    <th>JABATAN</th>
                                    <th>AKSES OBRIK</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $i)
                                    <tr>
                                        <td>
                                            <small class="fw-bold text-muted">{{ $i->nip }}</small> <br>
                                            {{ $i->nama }}
                                        </td>
                                        <td class="text-wrap" width="30%">
                                            {{ $i->jabatan }}
                                        </td>
                                        <td>
                                            <ol class="list-group list-unstyled">
                                                @foreach($i->obriks as $obrik)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div>
                                                            <small class="fw-bold text-muted">{{ $obrik->kode_bidang_obrik }}</small> - {{ $obrik->bidang_obrik }}
                                                        </div>
                                                        <a href="{{ route('setting-pegawai.destroy', ['pegawai_id' => $i->id, 'obrik_id' => $obrik->id]) }}"
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('Anda yakin akan menghapus ini')">
                                                            <small>Hapus</small>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ol>
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
