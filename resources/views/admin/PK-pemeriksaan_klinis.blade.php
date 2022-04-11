@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>document.title = "Pemeriksaan Klinis Virtual - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Pemeriksaan Klinis Virtual</h1>
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
            <table class="table table-striped" id="tablePPK">
                <thead>
                <tr>
                    <th scope="col">ID PPK</th>
                    <th scope="col">No PPK</th>
                    <th scope="col">No Aju PPK</th>
                    <th scope="col">Kode Counter</th>
                    <th scope="col">Nama Counter</th>
                    <th scope="col">Nama Trader</th>
                    <th scope="col">Nama Penerima/Tujuan</th>
                    <th scope="col">Jadwal Pemeriksaan</th>
                    <th scope="col">Link Meet Virtual</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 0; ?>
                @foreach ($pks as $ppk)
                <?php $count++; ?>
                <tr>
                    <td>{{ $ppk->id_ppk }}</td>
                    <td>{{ $ppk->no_ppk }}</td>
                    <td>{{ $ppk->no_aju_ppk }}</td>
                    <td>{{ $ppk->kode_counter }}</td>
                    <td>{{ $ppk->nama_counter }}</td>
                    <td>{{ $ppk->nm_trader }}</td>
                    <td>{{ $ppk->nm_penerima }}</td>
                    <?php 
                    $jadwal_string = "";
                    if ($ppk->jadwal_periksa!=null){
                      $jadwal_string = date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa));
                    }
                    ?>
                    <td>{{ $jadwal_string }}</td>
                    @if ($ppk->url_periksa)
                      <td>{{ $ppk->url_periksa }} </td>
                    @else
                      <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-primary" data-toggle="modal" data-target=<?= '"#linkModal'.$count.'"' ?>>Kirim Link</a>

                        <!-- modal kirim virtual -->
                        <div class="modal fade" id=<?= '"linkModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#linkModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#linkModalLabel'.$count.'"' ?>>Pemeriksaan Klinis Virtual <?= $ppk->no_ppk?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <form id=<?= '"kirim-link-url'.$count.'"' ?> action="/admin/pemeriksaan_klinis/kirim_url" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <input type="hidden" id="id_ppk" name="id_ppk" value=<?= $ppk->id_ppk ?>>
                                        <label for="linkMeet" class="col-form-label">Link Meet Online:</label><br>
                                        <input type="url" id="linkMeet" name="linkMeet" class="form-control"><br>
                                        <label for="jadwalMeet" class="col-form-label">Jadwal Pemeriksaan:</label><br>
                                        <input type=date min=<?= date('Y-m-d');?>  id="jadwalMeet" name="jadwalMeet">
                                        <input type=time id="jamMeet" name="jamMeet">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="action" class="btn btn-primary">Kirim</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                      </td>
                    @endif
                    <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#cekModal'.$count.'"' ?>>Cek PPK</a>
                        <!-- modal cek ppk -->
                        <div class="modal fade" id=<?= '"cekModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#cekModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#cekModalLabel'.$count.'"' ?>>Cek No PPK <?= $ppk->no_ppk?> </h5>
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
                        </div>
                        
                        @if ($ppk->status==NULL || $ppk->status==1)
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-primary" data-toggle="modal" data-target=<?= '"#actionModal'.$count.'"' ?>>Action</a>
                        <!-- modal action, fuck jquery -->
                        <div class="modal fade" id=<?= '"actionModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#actionModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#actionModalLabel'.$count.'"' ?>>No PPK <?= $ppk->no_ppk?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <form id=<?= '"action-form'.$count.'"' ?> action="/admin/pemeriksaan_klinis/action" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <input type="hidden" id="id_ppk" name="id_ppk" value=<?= $ppk->id_ppk ?>>
                                        <label for="keterangan" class="col-form-label">Keterangan:</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" form=<?= '"action-form'.$count.'"' ?>></textarea>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="action" value="Tolak" class="btn btn-danger">Tolak PPK</button>
                                      <button type="submit" name="action" value="Setuju" class="btn btn-primary">Setujui PPK</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                        @endif
                    </td>
                </tr>
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
    $('#tablePPK').DataTable({
      responsive: true,
    });
  } );
  
</script>
@endpush