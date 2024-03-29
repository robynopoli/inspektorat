@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <ul class="">
                    <a href="{{ route('admin.mcp-kpk.area-intervensi.index') }}"
                        class="list-group-item {{ request()->is('admin/mcp-kpk/area-intervensi*') ? 'fw-bold text-primary' : '' }} mb-2">
                        Area Intervensi
                    </a>
                    <a href="{{ route('admin.mcp-kpk.indikator.index') }}"
                        class="list-group-item {{ request()->is('admin/mcp-kpk/indikator*') ? 'fw-bold text-primary' : '' }} mb-2">
                        Indikator
                    </a>
                    <a href="{{ route('admin.mcp-kpk.sub-indikator.index') }}"
                        class="list-group-item {{ request()->is('admin/mcp-kpk/sub-indikator*') ? 'fw-bold text-primary' : '' }} mb-2">
                        Sub Indikator
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
