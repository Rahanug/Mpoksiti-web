@extends('layouts.trader')


@section('content')
<script>document.title = "Proses Stuffing Virtual"</script>
<main class="justify-content-md-center-lg-10 px-md-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Tambah Dokumen</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="/master/addMaster/storeMaster"   enctype="multipart/form-data">
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
                                                <label for="nm_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Kategori Dokumen</label>
                                                <select class="form-control" id="nm_dokumen" name="nm_dokumen" required>
                                                <option value="none" onclick="pushData('id_kategori')">-- Pilih Kategori --</option>
                                                  @foreach ($kategori as $item)
                                                      <option value="{{ $item->id_kategori }}" onclick="pushData({{ $item->id_kategori }})">{{ $item->nama_kategori }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label for="no_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Dokumen</label>
                                                <input type="text" id="no_dokumen" class="form-control"
                                                    placeholder="Nomor dokumen" name="no_dokumen">
                                            </div>

                                            <div class="form-group" >
                                              <label for="time" style="font-weight: bold">Tanggal Terbit</label>
                                              <input type="date" id="tgl_terbit" class="form-control @error('tgl_terbit')
                                                  is-invalid
                                              @enderror" placeholder="tgl_terbit" name="tgl_terbit" value="{{ old('tgl_terbit') }}" required>
                                              @error('time')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                              @enderror
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
