@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="col">
                        <div class="col mr-auto">
                            <style>
                                .center{
                                    margin-top : 15px;
                                }
                            </style>
                            <center class="center"><img src="img/mpoksiti.png"></center>
                        </div>
                        <div class="col">
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Media Pelayanan Online Karantina Simple Terintegrasi</h1>
                                    <h2 class="h4 text-gray-900 mb-4">Login Jasa Pengiriman Barang</h2>
                                </div>
                                @if ($message = Session::get('error'))
                                    <div style="color: rgb(136, 25, 25); font-weight: bold; padding: 3px 3px"> {{ $message }}</div>
                                @endif
                                <form method="POST" action="{{ route('loginjpp') }}" class="admin">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-admin" name="kode_counter" placeholder="{{ __('Kode Konter') }}" value="{{ old('kode_counter') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-admin" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-admin btn-block">
                                            Login
                                        </button>
                                    </div>
                                </form>

                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">
                                            Forgot Password
                                        </a>
                                    </div>
                                @endif

                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create An Account</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
