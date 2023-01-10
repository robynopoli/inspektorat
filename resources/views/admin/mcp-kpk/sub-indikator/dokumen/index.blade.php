@extends('admin.mcp-kpk.layout')

@section('title', 'Sub Indikator (Document)')

@section('contents')
    <div class="row">
        <div class="col-md-6">
            <p class="fw-bold mb-0">
                Area Intervensi
            </p>
            <p>
                {{ $sub_indikator->mcp_indikator->area_intervensi->keterangan ?? '-' }}
            </p>
            <p class="fw-bold mb-0">
                Indikator
            </p>
            <p>
                {{ $sub_indikator->mcp_indikator->keterangan ?? '-' }}
            </p>
            <p class="fw-bold mb-0">
                Sub Indikator
            </p>
            <p>
                {{ $sub_indikator->keterangan ?? '-' }}
            </p>
            <p class="fw-bold mb-0">
                Perangkat daerah
            </p>
            <p>
                {{ $sub_indikator->obrik->bidang_obrik ?? '-' }}
            </p>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-between mb-2">
                <p class="fw-bold mb-0">
                    Dokument yang dibutuhkan
                </p>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    +
                </button>
            </div>

            <ol type="1">
                @forelse ($sub_indikator->mcp_document as $i)
                    <li>
                        <div class="d-flex justify-content-between mb-1">
                            <div>
                                {{ $i->keterangan }}
                            </div>
                            <form
                                action="{{ route('admin.mcp-kpk.destroy-document', ['sub_indikator' => $i->mcp_sub_indikator_id, 'mcp_document' => $i->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    belum ada laporan
                @endforelse
            </ol>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.mcp-kpk.store-document', $sub_indikator->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kebutuhan dokumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <b>Dokument yang dibutuhkan</b>
                            <textarea name="keterangan" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
