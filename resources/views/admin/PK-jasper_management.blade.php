@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>document.title = "Managemen Jasper - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Managemen Jasa Pengiriman</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <!--Here is spot for put the button -->
          <div class="input-group mb-3">
            <button type="button" class="btn btn-secondary" style="font-weight: bold; background-color: #3C5C94" data-toggle="modal" data-target="#newJppModal" >Add New Jasper</button>
            <div class="modal fade" id="newJppModal"tabindex="-1" role="dialog" aria-labelledby="#newJppModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newJppModalLabel"> Add New Jasper </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form id="newJPPForm" action="/admin/jasper_management/add_jasper" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_counter" class="col-form-label">Kode Counter (digunakan untuk login): </label>
                                <input type="text" id="kode_counter" name="kode_counter" class="form-control">
                                <label for="nama_counter" class="col-form-label">Nama Counter: </label>
                                <input type="text" id="nama_counter" name="nama_counter" class="form-control">
                                <label for="penanggungJawab" class="col-form-label">Penanggung Jawab: </label>
                                <input type="text" id="penanggungJawab" name="penanggungJawab" class="form-control">
                                <label for="latitude" class="col-form-label">Latitude: </label>
                                <input type="number" id="latitude" name="latitude" class="form-control">
                                <label for="longitude" class="col-form-label">Longitude: </label>
                                <input type="number" id="longitude" name="longitude" class="form-control">
                                <label for="jenis_kurir" class="col-form-label">Kurir: </label>
                                <select name="jenis_kurir" id="jenis_kurir" class="form-control">
                                    <option value='' selected>Pilih Kurir</option>
                                    @foreach ($kurirs as $kurir)
                                    <option value=<?= $kurir->id ?>>{{ $kurir->namaKurir }}</option>
                                    @endforeach
                                </select>
                                <label for="password" class="col-form-label">Password: </label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$errors->first()}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  @endif
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
            <table class="table table-striped" id="tableJPP">
                <thead>
                <tr>
                    <th scope="col">ID JPP</th>
                    <th scope="col">Kode Counter</th>
                    <th scope="col">Nama Counter</th>
                    <th scope="col">Penanggung Jawab</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Kurir</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 0; ?>
                @foreach ($jpps as $jpp)
                <?php $count++; ?>
                <tr>
                    <td>{{ $jpp->id }}</td>
                    <td>{{ $jpp->kode_counter }}</td>
                    <td>{{ $jpp->nama_counter }}</td>
                    <td>{{ $jpp->penanggungJawab }}</td>
                    <td>{{ $jpp->latitude }}</td>
                    <td>{{ $jpp->longitude }}</td>
                    <td>{{ $jpp->namaKurir}}</td>
                    <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#cekModal'.$count.'"' ?>>Edit</a>
                        <!-- modal cek ppk -->
                        <!--
                        <div class="modal fade" id=<?= '"cekModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#cekModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#cekModalLabel'.$count.'"' ?>> <?= $jpp->id?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">Tes modal</div>
                                  <div class="modal-footer">
                                      <button class="btn btn-link" type="button" data-dismiss="modal">Tutup</button>
                                      <button class="btn btn-primary">Cetak</button>
                                  </div>
                              </div>
                          </div>
                        </div>!-->
                    </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
</main>



@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
  $(document).ready( function () {
    $('#tableJPP').DataTable({
      responsive: true,
    });
  } );
  
</script>
@endpush
