@extends('layouts.admin')

@section('content')
<script>document.title = "Edit Menu"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Home Menu</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
            <a type="button" class="btn btn-secondary" href="/admin/menu" style="font-weight: bold; background-color: #3C5C94">
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
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Edit Menu</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @foreach ($editMenu as $p)
                                        <form method="POST" action="/admin/menu/update"   enctype="multipart/form-data">
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
                                            <input type="hidden" name="id_menu"  value="{{ $p->id_menu }}">
                                                <div class="form-group">
                                                    <label for="nm_menu" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nama Menu</label>
                                                    <input type="text" id="nm_menu" class="form-control"
                                                        placeholder="nm_menu" name="nm_menu" value="{{ $p->nm_menu }}">
                                                </div>
                                            <div class="form-group">
                                                <label for="url" style="font-weight:500; color:#2E2A61; font-size: 18px;">URL</label>
                                                <input type="text" id="url" class="form-control"
                                                    placeholder="url" name="url" value="{{ $p->url }}">
                                            </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
  </main>
@endsection
