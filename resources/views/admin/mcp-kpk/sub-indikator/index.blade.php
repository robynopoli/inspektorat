@extends('admin.mcp-kpk.layout')

@section('title', 'Sub Indikator')

@section('contents')
    <a href="{{ route('admin.mcp-kpk.sub-indikator.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
    <div class="table-responsive">
        <table class="table-bordered table-sm table" id="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Detail</th>
                    <th>Perangkat Daerah</th>
                    <th>Dokumen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <p class="mb-0">
                                {{ $i->mcp_indikator->area_intervensi->keterangan ?? '' }}
                            </p>
                            <p class="ps-1 mb-0">
                                {{ $i->mcp_indikator->keterangan ?? '' }}
                            </p>
                            <p class="ps-2 fw-bold mb-0">
                                {{ $i->keterangan ?? '' }}
                            </p>
                        </td>
                        <td>
                            {{ $i->obrik->bidang_obrik ?? '' }}
                        </td>
                        <td>
                            <ol type="1">
                                @foreach ($i->mcp_document as $doc)
                                    <li>
                                        <small class="mb-0">{{ $doc->keterangan }}</small>
                                    </li>
                                @endforeach
                            </ol>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('admin.mcp-kpk.sub-indikator.destroy', $i->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.mcp-kpk.sub-indikator.edit', $i->id) }}"
                                    class="btn btn-primary btn-sm me-2">
                                    Edit
                                </a>
                                <a href="{{ route('admin.mcp-kpk.show-document', $i->id) }}"
                                    class="btn btn-info btn-sm me-2">
                                    Doc
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
            $('#table').DataTable({
                "fnDrawCallback": function() {
                    $('#table tbody tr').each(function() {
                        $('[data-bs-toggle="tooltip"]').tooltip()
                    });
                }
            });
        });
    </script>
@endsection
