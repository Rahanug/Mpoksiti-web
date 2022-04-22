@extends('layouts.trader')


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
                        <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Tambah Dokumen</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{route('trader.storeMaster')}}" enctype="multipart/form-data">
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
                                            <label for="id_kategori" style="font-weight:500; color:#2E2A61; font-size: 18px;">Kategori Dokumen</label>
                                            <select class="form-control" id="id_kategori" name="id_kategori">
                                                <option value="" onclick="pushData('id_kategori')">-- Pilih Kategori --</option>
                                                @foreach ($kategori as $item)
                                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="no_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Dokumen</label>
                                            <input type="text" id="no_dokumen" value="{{ old('no_dokumen') }}" class="form-control" placeholder="Nomor dokumen" name="no_dokumen">
                                        </div>

                                        <div class="form-group">
                                            <label for="time" style="font-weight:500; color:#2E2A61; font-size: 18px;">Tanggal Terbit</label>
                                            <input type="date" id="tgl_terbit" value="{{ old('tgl_terbit') }}" class="form-control" placeholder="tgl_terbit" name="tgl_terbit">
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Upload Dokumen</label>
                                            <input type="file" id="nm_dokumen" class="form-control" name="nm_dokumen">
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <a type="button"style="margin: 0 5px" class="btn btn-secondary" href="{{route('trader.master_dokumen')}}">Cancel</a>
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