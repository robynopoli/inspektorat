@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card animate__animated animate__fadeInUp">
                    <div class="card-header d-flex justify-content-between">
                        <b>Request Coaching (Semua)</b>
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
                                    <th class="text-center">#</th>
                                    <th>Pengajuan Oleh</th>
                                    <th style="width: 40%">Permasalahan / Penjelasan Umum</th>
                                    <th>Tanggal/Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $i)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            NIP : {{ $i->user->username }}<br>
                                            NAMA : {{ $i->user->name }}<br>
                                            <a href="http://mail.to:{{ $i->email }}" target="_blank"><small>{{ $i->email }}</small></a>
                                            <br>
                                            <a href="http://wa.me/{{ $i->number_phone }}" target="_blank"><small>{{ $i->number_phone }}</small></a>
                                        </td>
                                        <td style="word-wrap: break-word">
                                            {{ $i->event_problem }} <br>
                                            {{ $i->detail }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::make($i->date_event)->format('d M Y') }} <br>
                                            {{ \Carbon\Carbon::make($i->date_event)->format('H:i') }}
                                        </td>
                                        <td class="text-capitalize">
                                            @if($i->status == 'diajukan')
                                                <div class="text-warning">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                            @if($i->status == 'disetujui')
                                                <div class="text-success">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                            @if($i->status == 'ditolak')
                                                <div class="text-danger">
                                                    {{ $i->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.imtak-pengawasan.destroy', $i->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('admin.imtak-pengawasan.edit', $i->id) }}" class="btn btn-primary btn-sm me-2">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="if (confirm('Anda yakin akan menghapus ini ?')){ this.form.submit();} ">
                                                    Hapus
                                                </button>
                                            </form>
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
