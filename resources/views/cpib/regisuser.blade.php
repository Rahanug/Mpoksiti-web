<style>
    .center{
        margin-top : 75px;
        margin-bottom : 35px;
    }
    .radiobuttons label {
        display: block;
        float: left;
        padding-right: 3px;
        white-space: nowrap;
    }
    .radiobuttons input {
        vertical-align: middle;
    }
    .radiobuttons label span {
        padding-left: 5px;
        vertical-align: middle;
        font-size:15px;
    }
    .checkboxes label {
        display: block;
        float: left;
        padding-right: 3px;
        white-space: nowrap;
    }
    .checkboxes input {
        vertical-align: middle;
    }
    .checkboxes label span {
        padding-left: 5px;
        vertical-align: middle;
        font-size:15px;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

</style>

@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <center class="center"><img src="img/mpoksiti.png"></center>
                    <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Media Pelayanan Online Karantina Simple Terintegrasi</h1>
                            <h1 class="h4 text-gray-900 mb-4">Register User</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        @if ($message = Session::get('error'))
                            <div style="color: rgb(136, 25, 25); font-weight: bold; padding: 3px 3px"> {{ $message }}</div>
                        @endif
                        <form method="POST" action="" class="user">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row radiobuttons">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label><input type="radio" id="role_cpib" name="cpib_role" value="1"/><span>Penanganan</span></label>
                                </div>
                                <div>
                                    <label><input type="radio" id="role_cpib" name="cpib_role" value="2"/><span>Pengolahan</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <span id="error_radio"></span>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nama lengkap" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="nik" placeholder="NPWP / NIK" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" name="nomor handphone" placeholder="Nomor Handphone" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="passInput" name="password" placeholder="{{ __('Password') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-7 mb-2 mb-sm-0"></div>
                                <div class="checkboxes">
                                    <label><input type="checkbox" onclick="myFunction()"/><span>Show Password</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                    Register
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

                        @if (Route::has('logincpib'))
                            <div class="text-center">
                                <a class="small" href="{{ route('logincpib') }}">Login to An Account</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function myFunction() {
        var x = document.getElementById("passInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    };
    $("#submit, #role").bind('click keyup',function() {
       if ($('input[name="cpib_role"]:checked').length == 0) {
            $('#error_radio').html('<label class="text-danger">Please Choose One</label>');
            $('#role_cpib').addClass('has-error');
            return false;
        } else {
            $('#error_radio').empty();
            $('#role_cpib').removeClass('has-error');
            return true;
       }
       return false;
    });
</script>
@endpush
