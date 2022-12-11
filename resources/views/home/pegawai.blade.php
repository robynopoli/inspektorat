@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-3 mb-5 text-center text-uppercase animate__animated animate__zoomIn" style="font-weight: bolder; font-size: 4em; font-family: 'Segoe UI'">
            S A P A
            <span class="text-gradient">&emsp14; Inspektur</span>
        </h1>
        <br>
        <div class="row px-5">
            <div class="col-md-6 animate__animated animate__fadeInUp">
                <h4 class="text-capitalize fw-bold">
                    imtak pengawasan
                </h4>
                <p class="mb-3 text-muted pe-5">
                    Layanan konsultasi Obrik untuk pembinaan penyelenggaraan pemerintahan
                </p>
                <a href=""
                   class="btn btn-primary rounded-3 px-4">
                    Masuk Aplikasi
                    {{--                    <div class="">--}}
                    {{--                        <svg--}}
                    {{--                            aria-hidden="true"--}}
                    {{--                            class=""--}}
                    {{--                            fill="currentColor"--}}
                    {{--                            viewBox="0 0 120 20"--}}
                    {{--                            xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <path--}}
                    {{--                                fill-rule="evenodd"--}}
                    {{--                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"--}}
                    {{--                                clip-rule="evenodd"--}}
                    {{--                            />--}}
                    {{--                        </svg>--}}
                    {{--                    </div>--}}
                </a>
                <img
                    class="max-w-full h-auto"
                    src="{{ asset('assets/coaching.gif') }}"
                    alt="coaching"
                />
            </div>
            <div class="col-md-6 animate__animated animate__fadeInUp">
                <h4 class="text-capitalize fw-bold">
                    Pemantauan Tindak Lanjut
                </h4>
                <p class="mb-3 text-muted ">
                    Aplikasi pemantauan tindak lanjut terintegrasi dengan SIMHPNAS
                </p>
                <a href="{{ route('pemantauan-tindak-lanjut.index') }}"
                   class="btn btn-primary rounded-3 px-4">
                    Masuk Aplikasi
                    {{--                    <div class="">--}}
                    {{--                        <svg--}}
                    {{--                            aria-hidden="true"--}}
                    {{--                            class=""--}}
                    {{--                            fill="currentColor"--}}
                    {{--                            viewBox="0 0 120 20"--}}
                    {{--                            xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <path--}}
                    {{--                                fill-rule="evenodd"--}}
                    {{--                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"--}}
                    {{--                                clip-rule="evenodd"--}}
                    {{--                            />--}}
                    {{--                        </svg>--}}
                    {{--                    </div>--}}
                </a>
                <img
                    class="max-w-full h-auto"
                    src="{{ asset('assets/ptl.gif') }}"
                    alt="coaching"
                />
            </div>
        </div>
        @endsection

        @section('css')
            <link
                rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            />
@endsection
