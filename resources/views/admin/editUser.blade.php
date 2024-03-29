@extends('layouts.admin')

@section('content')
<script>document.title = "Edit"</script>
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
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Edit</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="{{route('admin.updateUser', [$id_trader])}}"   enctype="multipart/form-data">
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
                                            @foreach($edit as $p)
                                            <div class="form-group">
                                                <label for="npwp" style="font-weight:500; color:#2E2A61; font-size: 18px;">NPWP</label>
                                                <input type="text" id="npwp" class="form-control" value="{{ $p->npwp }}"
                                                    placeholder="NPWP" name="npwp" readonly="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nama User</label>
                                                <input type="text" id="nm_trader" class="form-control" value="{{ $p->nm_trader }}"
                                                    placeholder="Nama User" name="nm_trader">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Handphone</label>
                                                <input type="text" id="no_hp" class="form-control" value="{{ $p->no_hp }}"
                                                    placeholder="Nomor Handphone" name="no_hp">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:500; color:#2E2A61; font-size: 18px;">Email</label>
                                                <input type="text" id="email" class="form-control" value="{{ $p->email }}"
                                                    placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password" style="font-weight:500; color:#2E2A61; font-size: 18px;">Password</label>
                                                <input type="text" id="password" class="form-control"
                                                    placeholder="(Password Tetap)" name="password">
                                            </div>
                                            <br>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="register" id="register" >Submit</button>
                                                </div>
                                                {{ csrf_field() }}
                                                @endforeach
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
