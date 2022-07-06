@extends('layouts.admin')

@section('content')
<script>document.title = "Tambah Gambar"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Publikasi</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
            <a type="button" class="btn btn-secondary" href="/admin/publikasi" style="font-weight: bold; background-color: #3C5C94">
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
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Tambah Gambar</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="/admin/publikasi/addGambar/sukses"   enctype="multipart/form-data">
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
                                                <label for="nm_gambar" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nama Gambar</label>
                                                <input type="text" id="nm_gambar" class="form-control"
                                                    placeholder="Nama Gambar" name="nm_gambar">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi" style="font-weight:500; color:#2E2A61; font-size: 18px;">Deskripsi Gambar</label>
                                                <input type="text" id="deskripsi" class="form-control"
                                                    placeholder="Deskripsi Gambar" name="deskripsi">
                                            </div>
                                            <div class="form-group">
                                                <label for="file_gambar" style="font-weight:500; color:#2E2A61; font-size: 18px;">File Gambar</label>
                                                <input type="file" id="file_gambar" class="form-control" name="file_gambar">
                                            </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                </div>
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
