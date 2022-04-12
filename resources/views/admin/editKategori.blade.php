@extends('layouts.admin')


@section('content')
<script>
    document.title = "Proses Stuffing Virtual"
</script>
<main class="justify-content-md-center-lg-10 px-md-2">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Edit Kategori</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="/admin/kategori/editKategori/{{$id_kategori}}/update" enctype="multipart/form-data">
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
                                            <label for="nama_kategori" style="font-weight:500; color:#2E2A61; font-size: 18px;">Kategori Dokumen</label>
                                            <input type="text" id="nama_kategori" value="{{ $p->nama_kategori }}" class="form-control" placeholder="Kategori Dokumen" name="nama_kategori" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" style="font-weight:500; color:#2E2A61; font-size: 18px;">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value=1 {{ strcmp($p->status, 1)==0? 'selected':''; }}>Aktif</option>
                                                <option value=0 {{ strcmp($p->status, 0)==0? 'selected':''; }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label for="instansi_penerbit" style="font-weight:500; color:#2E2A61; font-size: 18px;">Instansi Penerbit</label>
                                            <input type="text" id="instansi_penerbit" value="{{ $p->instansi_penerbit }}" class="form-control" placeholder="Instansi Penerbit" name="instansi_penerbit">
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                        </div>
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