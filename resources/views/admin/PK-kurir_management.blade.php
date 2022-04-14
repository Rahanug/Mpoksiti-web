@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>document.title = "Managemen Kurir Jasper - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Managemen Kurir Jasper</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <!--Here is spot for put the button -->
          <div class="input-group mb-3">
            <button type="button" class="btn btn-secondary" style="font-weight: bold; background-color: #3C5C94" data-toggle="modal" data-target="#newJppModal" >Add New Kurir</button>
            <div class="modal fade" id="newJppModal"tabindex="-1" role="dialog" aria-labelledby="#newJppModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newJppModalLabel"> Add New Kurir </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form id="newJPPForm" action="/admin/kurir_management/add_kurir" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_kurir" class="col-form-label">Nama JPP/Kurir: </label>
                              <input type="text" id="nama_kurir" name="nama_kurir" class="form-control">
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
    <div class="alert alert-primary alert-dismissible fade show" style="white-space: pre-line;" role="alert">
        {{session('success')}}
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
                    <th scope="col">ID KURIR</th>
                    <th scope="col">Nama Kurir</th>
                    <!--<th scope="col">Logo Kurir</th>-->
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 0; ?>
                @foreach ($kurirs as $jpp)
                <?php $count++; ?>
                <tr>
                    <td>{{ $jpp->id }}</td>
                    <td>{{ $jpp->namaKurir }}</td>
                    <!--<td>{{ $jpp->namaKurir }}</td>-->
                    <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#updateModal'.$count.'"' ?>>Edit</a>
                        <!-- modal -->
                        <div class="modal fade" id=<?= '"updateModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#updateModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#updateModalLabel'.$count.'"' ?>> <?= $jpp->namaKurir?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <form id=<?= '"updateJPPForm'.$count.'"' ?> action="/admin/kurir_management/update_kurir" method="POST">
                                  @csrf
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <input type="hidden" id="id" name="id" value="{{ $jpp->id }}">
                                      <label for="nama_kurir" class="col-form-label">Nama JPP/Kurir: </label>
                                      <input type="text" id="nama_kurir" name="nama_kurir" class="form-control" value="{{ $jpp->namaKurir }}">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary">Ubah</button>
                                  </div>
                                  </form>
                              </div>
                          </div>
                        </div>
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
