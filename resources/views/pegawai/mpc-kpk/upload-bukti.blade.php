@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Upload Bukti Tindak Lanjut</div>
                    <div class="card-body">
                        <form action="{{ route('pegawai.mcp-kpk.store_upload_bukti') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mcp_document_id" value="{{ $mcp_dokument->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="area_intervensi">Area Intervensi</label>
                                        <input type="text" id="area_intervensi" readonly class="form-control shadow-none"
                                            value="{{ $mcp_dokument->mcp_sub_indikator->mcp_indikator->area_intervensi->keterangan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="indikator">Indikator</label>
                                        <input type="text" id="indikator" readonly class="form-control shadow-none"
                                            value="{{ $mcp_dokument->mcp_sub_indikator->mcp_indikator->keterangan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_indikator">Sub indikator</label>
                                        <input type="text" id="sub_indikator" readonly class="form-control shadow-none"
                                            value="{{ $mcp_dokument->mcp_sub_indikator->keterangan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan">Dokumen Yang di butuhkan</label>
                                        <input type="text" id="keterangan" readonly class="form-control shadow-none"
                                            value="{{ $mcp_dokument->keterangan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="link_tindak_lanjut">Tindak Lanjut <div
                                                class="text-danger d-inline-flex">*</div>
                                        </label><br>
                                        <small class="text-muted">Anda dapat menambahkan link bukti tindak lanjut disini
                                            (seperti GDrive, atau lainnya)</small>
                                        <textarea name="link_tindak_lanjut" id="link_tindak_lanjut" rows="5"
                                            class="form-control @error('link_tindak_lanjut') is-invalid @enderror shadow-none"></textarea>
                                        @error('link_tindak_lanjut')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
