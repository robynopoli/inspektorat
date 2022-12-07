@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card animate__animated animate__fadeInUp">
                    <div class="card-header">Recomendasi belum di tindak lanjut</div>

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
                                    <td>Kode Rekomendasi</td>
                                    <td style="width: 30%">Memo Rekomendasi</td>
                                    <td style="width: 30%">Judul Laporan</td>
                                    <td>Obrik</td>
                                    <td>Bidang Obrik</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $i)
                                    <tr>
                                        <td>
                                            {{ $i['kode_rekomendasi'] }}
                                            <br><br>
                                            <a href="{{ route('tindak_lanjut_create', ['kode_rekomendasi' => $i['kode_rekomendasi']]) }}" class="btn btn-primary">
                                                Tindak lanjut
                                            </a>
                                        </td>
                                        <td>{{ $i['Memo_Rekomendasi'] }}</td>
                                        <td>{{ $i['Judul_Laporan'] }}</td>
                                        <td>{{ $i['Unit_Obrik'] }}</td>
                                        <td>{{ $i['Bidang_Obrik'] }}</td>
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
