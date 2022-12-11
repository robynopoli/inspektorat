@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Proses pengajuan tindak lanjut</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('pengajuan_tl_update', $data->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="fw-bold">Tindak lanjut</label> <br>
                                <a href="{{ $data->tindak_lanjut }}" target="_blank">{{ $data->tindak_lanjut }}</a>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control shadow-none" onchange="check_active()" required>
                                    <option value="">Pilih</option>
                                    <option value="s">Selesai</option>
                                    <option value="d">Dalam Proses</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="5" class="form-control shadow-none" disabled></textarea>
                                <span class="text-muted">Tambahkan alasan/keterangan tidak memenuhi syarat</span>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('tindak_lanjut') }}" class="btn btn-default">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function check_active() {
            const status = document.getElementById("status");
            const keterangan = document.getElementById('keterangan');
            keterangan.disabled = true;
            keterangan.value = '';
            if (status.value === 'd'){
                keterangan.disabled = false;
            }
        }
    </script>
@endsection
