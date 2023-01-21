@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <nav id="navbar-example3" class="h-100 flex-column align-items-stretch">
                    <nav class="nav flex-column">
                        @foreach ($area_intervensi as $i)
                            <a class="nav-link mt-2" href="#item-{{ $i->id }}">{{ $i->keterangan }}</a>
                            @if ($i->mcp_indikator->count() > 0)
                                <nav class="nav flex-column">
                                    @foreach ($i->mcp_indikator as $indikator)
                                        <a class="nav-link ms-2"
                                            href="#item-{{ $i->id }}-{{ $indikator->id }}">{{ $indikator->keterangan }}</a>
                                    @endforeach
                                </nav>
                            @endif
                        @endforeach
                    </nav>
                </nav>
            </div>
            <div class="col-8">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true"
                    class="scrollspy-example-2 h-100" tabindex="0">
                    @foreach ($area_intervensi as $i)
                        <div id="item-{{ $i->id }}">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                {{ $i->keterangan }}
                            </div>
                            <div class="card-body">
                                @if ($i->mcp_indikator->count() > 0)
                                    @foreach ($i->mcp_indikator as $indikator)
                                        <div id="item-{{ $i->id }}-{{ $indikator->id }}">
                                            <h5>{{ $indikator->keterangan }}</h5>
                                        </div>
                                    @endforeach
                                    @if ($indikator->mcp_sub_indikator->count() > 0)
                                        @foreach ($indikator->mcp_sub_indikator as $sub_indikator)
                                            @php
                                                $count_document_approve = \App\Models\McpTindakLanjut::whereIn('mcp_document_id', $sub_indikator->mcp_document->pluck('id'))
                                                    ->where('is_approve', 1)
                                                    ->count();
                                                $count_document = \App\Models\McpTindakLanjut::whereIn('mcp_document_id', $sub_indikator->mcp_document->pluck('id'))->count();
                                            @endphp
                                            <h6>
                                                {{ $sub_indikator->keterangan }}
                                                @if ($count_document > 0)
                                                    <div class="text-success d-inline fw-bold">
                                                        ({{ number_format(($count_document_approve / $count_document) * 100, 2) }}
                                                        %)
                                                    </div>
                                                @else
                                                    <div class="text-danger d-inline fw-bold">
                                                        ( Capaian belum terhitung )
                                                    </div>
                                                @endif
                                            </h6>

                                            <table class="table-bordered table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Dokumen yg di butuhkan</th>
                                                        <th style="width: 50%">Bukti Dokumen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sub_indikator->mcp_document as $doc)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $doc->keterangan }}</td>
                                                            <td>
                                                                @forelse ($doc->mcp_tindak_lanjut as $tindak)
                                                                    <ul class="list list-unstyled">
                                                                        <li>
                                                                            <div class="d-flex justify-content-between">
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
                                                                                    <br>
                                                                                </div>
                                                                                <div>
                                                                                    @if ($tindak->is_approve == 0)
                                                                                        <a href="{{ route('admin.mcp-kpk.tindak-lanjut.proses_tindak_lanjut', ['id' => $tindak->id, 'is_approve' => 1]) }}"
                                                                                            class="btn btn-primary btn-sm"
                                                                                            onclick="return confirm('Anda yakin menerima bukti ini ?')">
                                                                                            Di Terima
                                                                                        </a>
                                                                                    @endif
                                                                                    @if ($tindak->is_approve == 1)
                                                                                        <a href="{{ route('admin.mcp-kpk.tindak-lanjut.proses_tindak_lanjut', ['id' => $tindak->id, 'is_approve' => 0]) }}"
                                                                                            class="btn btn-danger btn-sm"
                                                                                            onclick="return confirm('Anda yakin membatalkan bukti ini ?')">
                                                                                            Di batalkan
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <a href="{{ $tindak->link_tindak_lanjut }}"
                                                                                target="_blank">
                                                                                {{ Str::limit($tindak->link_tindak_lanjut, 50) }}
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                @empty
                                                                    <div class="text-danger">Belum ada bukti di upload</div>
                                                                @endforelse
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
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
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
