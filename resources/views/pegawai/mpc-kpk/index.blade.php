@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($sub_indikator as $i)
                    <div class="card animate__animated animate__fadeInUp mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="#">{{ $i->mcp_indikator->area_intervensi->keterangan }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">{{ $i->mcp_indikator->keterangan }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $i->keterangan }}
                                    </li>
                                </ol>
                            </nav>
                        </div>

                        <div class="card-body">
                            <h5 class="fw-bold"></h5>
                            <div class="table-responsive">
                                <table class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Dokumen yg di butuhkan</th>
                                            <th style="width: 50%">Bukti Dokumen</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->mcp_document as $doc)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $doc->keterangan }}</td>
                                                <td>
                                                    @forelse ($doc->mcp_tindak_lanjut as $tindak)
                                                        <ul class="list list-unstyled">
                                                            <li>
                                                                <div class="d-flex">
                                                                    <div class="me-2">
                                                                        <a href="{{ route('pegawai.mcp-kpk.destroy_upload_bukti', ['id' => $tindak->id]) }}"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="return confirm('Anda yakin akan menghapus ini ?')">
                                                                            x
                                                                        </a>
                                                                    </div>
                                                                    <div class="me-2">
                                                                        @if ($tindak->is_approve == 0)
                                                                            <span class="badge bg-warning">
                                                                                Proses
                                                                            </span>
                                                                        @endif
                                                                        @if ($tindak->is_approve == 1)
                                                                            <span class="badge bg-success">
                                                                                Diterima
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <div>
                                                                        <a href="{{ $tindak->link_tindak_lanjut }}"
                                                                            target="_blank">
                                                                            {{ Str::limit($tindak->link_tindak_lanjut, 50) }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @empty
                                                        <div class="text-danger">Belum ada bukti di upload</div>
                                                    @endforelse
                                                </td>
                                                <td style="width: 0px" class="text-center">
                                                    <a href="{{ route('pegawai.mcp-kpk.upload_bukti', ['dokumen_id' => $doc->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        +
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="card animate__animated animate__fadeInUp">
                    <div class="card-header d-flex justify-content-between">
                        <b>MCP KPK</b>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Permasalahan</th>
                                        <th style="width: 40%">Penjelasan Umum</th>
                                        <th>Tanggal/Waktu</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $i)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-capitalize">{{ $i->event_problem }}</td>
                                            <td style="word-wrap: break-word">{{ $i->detail }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::make($i->date_event)->format('d M Y') }} <br>
                                                {{ \Carbon\Carbon::make($i->date_event)->format('H:i') }}
                                            </td>
                                            <td class="text-capitalize">{{ $i->status }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('pegawai.imtak-pengawasan.destroy', $i->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('pegawai.imtak-pengawasan.edit', $i->id) }}"
                                                        class="btn btn-primary btn-sm me-2">
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
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
