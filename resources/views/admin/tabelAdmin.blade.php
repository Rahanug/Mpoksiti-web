@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css"/>
@endsection

@section('content')

<script>document.title = "Dashboard"</script>
<main class="justify-content-md-center-lg-10 px-md-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3"> 
  <h2 class="h2">Command</h2> 
  </div>
  <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center"> 
  <a style="margin: 0 3px" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteAllModal">Delete All</a>
  </div>

{{-- Modals --}}
  {{-- <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#masterModal-{{$kategori->id_kategori}}">Pilih Master</a> --}}
  <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus SELURUH Command?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Pilih "Delete" dibawah ini jika Anda yakin untuk menghapus <b>seluruh</b> Command yang dipilih.</div>
              <div class="modal-footer">
                  <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger" href="/admin/command/deleteAll" >Delete</a>
                  <form id="logout-form" action="" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </div>
      </div>
  </div>

  {{-- <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <img src="img/Proses.png"  srcset="img/Proses.png 10000w 7000h" sizes="(min-width: 200px, min-height: 50px)">
  </div> --}}
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
          {{-- TABLE COMMAND --}}
          <div class="table-responsive">
      <table class="table table-striped" id="tableCommand">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Command</th>
            <th scope="col">Nomor WhatsApp</th>
            <th scope="col">Dibuat pada</th>
            <th scope="col">Diupdate pada</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1 ?> 
          @foreach ($command as $commands) 
          <tr>
            <td>{{ $i++}}</td>
            <td>{{  $commands ->command}}</td>
            <td>{{  $commands ->no_wa }}</td>
            <td>{{  $commands ->created_at }}</td>
            <td>{{  $commands ->updated_at }}</td>
            <td>
                <a style="margin: 0 3px" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$commands->id}}">Delete</a>
                
            {{-- Modals --}}
                {{-- <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#masterModal-{{$kategori->id_kategori}}">Pilih Master</a> --}}
                <div class="modal fade" id="deleteModal{{$commands->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Command?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Pilih "Delete" dibawah ini jika Anda yakin menghapus Command yang dipilih.</div>
                            <div class="modal-footer">
                                <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" href="/admin/command/deleteCommand/{{$commands->id}}" >Delete</a>
                                <form id="logout-form" action="" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
          {{-- -------------------}}
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
      $('#tableCommand').DataTable({
        responsive: true,
      });
      
    } );
  </script>
@endpush