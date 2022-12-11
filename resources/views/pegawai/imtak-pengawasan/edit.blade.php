@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Request Coaching (Edit)</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('pegawai.imtak-pengawasan.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nip">NIP</label>
                                        <input type="text" id="nip" readonly
                                               class="form-control shadow-none"
                                               value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama">NAMA</label>
                                        <input type="text" id="nama" readonly
                                               class="form-control shadow-none"
                                               value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control shadow-none @error('email') is-invalid @enderror"
                                       value="{{ $data->email }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="number_phone">Nomor Telepon</label>
                                        <input type="text" name="number_phone" id="number_phone"
                                               class="form-control shadow-none @error('number_phone') is-invalid @enderror"
                                               value="{{ $data->number_phone }}">
                                        @error('number_phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="event_problem">Pilih Permasalahan</label>
                                        <select name="event_problem" id="event_problem" class="form-control shadow-none text-capitalize @error('event_problem') is-invalid @enderror">
                                            @foreach($event_problem_choice as $i)
                                                <option value="{{ $i }}" class="text-capitalize" {{ $data->event_problem == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="detail">Detail / Penjelasan UMUM</label>
                                <textarea id="detail" name="detail" class="form-control shadow-none @error('detail') is-invalid @enderror" rows="5">{{ $data->detail }}</textarea>
                                @error('detail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_event">Tanggal / Waktu</label>
                                <input type="datetime-local" id="date_event" name="date_event"
                                       class="form-control shadow-none @error('date_event') is-invalid @enderror"
                                       value="{{ $data->date_event }}">
                                @error('date_event')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('pegawai.imtak-pengawasan.index') }}" class="btn btn-default">
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
@endsection
