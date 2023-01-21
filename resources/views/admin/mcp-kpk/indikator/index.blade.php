@extends('admin.mcp-kpk.layout')

@section('title', 'Indikator')

@section('contents')
    <a href="{{ route('admin.mcp-kpk.indikator.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
    <div class="table-responsive">
        <table class="table-bordered table-sm table" id="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Area Intervensi</th>
                    <th>Indikator</th>
                    <th>Sub Indikator</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->area_intervensi->keterangan ?? '' }}</td>
                        <td>{{ $i->keterangan }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.mcp-kpk.sub-indikator.index', ['mcp_indikator_id' => $i->id]) }}"
                                class="text-decoration-none">
                                {{ $i->mcp_sub_indikator_count }}
                            </a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.mcp-kpk.indikator.destroy', $i->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.mcp-kpk.indikator.edit', $i->id) }}"
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
