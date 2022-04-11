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
                        <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Edit Subform</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="/admin/subform/EditSubform/{{$id}}/update" enctype="multipart/form-data">
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
                                            <label for="indikator" style="font-weight:500; color:#2E2A61; font-size: 18px;">Indikator Form</label>
                                            <input type="text" id="indikator" value="{{ $p->indikator }}" class="form-control" placeholder="Indikator" name="indikator">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_data" style="font-weight:500; color:#2E2A61; font-size: 18px;">Jenis Data</label>
                                            <select class="form-control" id="tipe_data" name="tipe_data">
                                                <option value='datetime' {{ strcmp($p->tipe_data, "datetime")==0? 'selected':''; }}>tanggal dan waktu</option>
                                                <option value='kondisi' {{ strcmp($p->tipe_data, "kondisi")==0? 'selected':''; }}>sesuai/tidak sesuai</option>
                                                <option value='text' {{ strcmp($p->tipe_data, "text")==0? 'selected':''; }}>text</option>
                                                <option value='rekomendasi' {{ strcmp($p->tipe_data, "rekomendasi")==0? 'selected':''; }}>boolean</option>
                                            </select>
                                        </div>
                                        @endforeach
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