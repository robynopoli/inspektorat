@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <ul class="">
                    <a href="#" class="list-group-item fw-bold text-primary mb-2" aria-current="true">
                        Area Intervensi
                    </a>
                    <a href="#" class="list-group-item mb-2">
                        Indikator
                    </a>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        @yield('title')
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @yield('contents')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
