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
                        <form class="user" id="FormCPIB">
                            @csrf
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
                                    <input type="text" class="form-control form-control-user" id="nm_user" name="nm_user" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="npwp" name="npwp" placeholder="NPWP / NIK" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor Handphone" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
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
                            {{ csrf_field() }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            var buttonValue = $('input[name="cpib_role"]:checked').val();

            if(buttonValue == 1){
                $('#FormCPIB').on('submit', function(e){
                    e.preventDefault();
                    var nm_user = $("#nm_user").val();
                    var npwp = $("#npwp").val();
                    var no_hp = $("#no_hp").val();
                    var email = $("#email").val();
                    var password = $("#passInput").val();

                    $.ajax({
                    url: "{{route('register.penanganan')}}",
                    type: "POST",
                    data: {
                        nm_user:nm_user,
                        npwp:npwp,
                        no_hp:no_hp,
                        email:email,
                        password:password,
                        _token: $('input[name="_token"]').val()
                    },
                    success:function(response){
                            if(response.success){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Register Berhasil!',
                                    text: 'Mohon Tunggu Sebentar!',
                                    timer: '2000',
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                }).then(function(){
                                    window.location.href = "{{ route('login.penanganan') }}";
                                });

                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Register Gagal!',
                                    text: 'silahkan coba lagi!'
                                });
                            }
                        }
                    });
                });
            }else{
                $('#FormCPIB').on('submit', function(e){
                    e.preventDefault();
                    var nm_user = $("#nm_user").val();
                    var npwp = $("#npwp").val();
                    var no_hp = $("#no_hp").val();
                    var email = $("#email").val();
                    var password = $("#passInput").val();

                    $.ajax({
                    url: "{{route('register.pengolahan')}}",
                    type: "POST",
                    data: {
                        nm_user:nm_user,
                        npwp:npwp,
                        no_hp:no_hp,
                        email:email,
                        password:password,
                        _token: $('input[name="_token"]').val()
                    },
                    success:function(response){
                            if(response.success){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Register Berhasil!',
                                    text: 'Mohon Tunggu Sebentar!',
                                    timer: '2000',
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                }).then(function(){
                                    window.location.href = "{{ route('login.pengolahan') }}";
                                });

                            }else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'Register Gagal!',
                                    text: 'silahkan coba lagi!'
                                });
                            }
                        }
                    });
                });
            }
            return true;
       }
       return false;
    });
</script>
@endpush
