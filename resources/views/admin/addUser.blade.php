@extends('layouts.admin')

@section('content')
<script>document.title = "Tambah"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Management</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
            <a type="button" class="btn btn-secondary" href="/admin/manage" style="font-weight: bold; background-color: #3C5C94">
                    Kembali
                </a>
          </div>
      </div>
    </div>
    <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Tambah</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="/admin/manage/addUser/sukses"   enctype="multipart/form-data">
                                        @csrf
                                            <div class="row">
                                            <div class="col">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="npwp" style="font-weight:500; color:#2E2A61; font-size: 18px;">NPWP</label>
                                                <input type="text" id="npwp" class="form-control"
                                                    placeholder="NPWP" name="npwp">
                                                    <span id="error_npwp"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Handphone</label>
                                                <input type="text" id="no_hp" class="form-control"
                                                    placeholder="Nomor Handphone" name="no_hp">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:500; color:#2E2A61; font-size: 18px;">Email</label>
                                                <input type="text" id="email" class="form-control"
                                                    placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password" style="font-weight:500; color:#2E2A61; font-size: 18px;">Password</label>
                                                <input type="text" id="password" class="form-control"
                                                    placeholder="Password" name="password">
                                            </div>
                                            <br>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="register" id="register" >Submit</button>
                                                </div>
                                                {{ csrf_field() }}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
  </main>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $(document).ready(function($){
        $('#npwp').mask("00.000.000.0-000.000");
        $('#npwp').blur(function(){
            var npwp = $('#npwp').val();
            $.ajax({
                url:"{{ route('admin.checkNpwp') }}",
                method:"POST",
                data:{
                    npwp:npwp, _token: $('input[name="_token"]').val()
                },
                success: function(result){
                    if(result == 'unique')
                    {
                        $('#error_npwp').html('<label class="text-success">NPWP Available</label>');
                        $('#npwp').removeClass('has-error');
                        $('#register').attr('disabled', false);
                    }
                    else
                    {
                        $('#error_npwp').html('<label class="text-danger">NPWP not Available</label>');
                        $('#npwp').addClass('has-error');
                        $('#register').attr('disabled', 'disabled');
                    }
                }
            })
        })
    });
</script>
@endpush
