@extends('layouts.jpp')

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

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
          <table class="table table-striped" id="tablePermohonanPemeriksaanVirtual">
          <thead>
            <tr>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Aju PPK</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Tgl PPK</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Trader</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Permohonan Pemeriksaan Virtual</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Link Pemeriksaan Virtual</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Jadwal Pemeriksaan</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Sertifikat</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Aksi</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $count = 0;
            foreach ($list_ppk as $ppk){
              $html = '<tr>';
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->no_aju_ppk.'</td>';
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->tgl_ppk.'</td>';
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->nm_trader.'</td>';
              
              if ($ppk->status_periksa == null){
                $html .= 
                '<td><form action="/jpp/permohonan" method="POST">
                  '.csrf_field().'
                  <input type="hidden" id="id_ppk" name="id_ppk" value='.$ppk->id_ppk.'>
                  <button class="btn btn-sm btn-outline-dark">Ajukan Permohonan</button>       
                </form></td>';
              }else{
                $html .= '<td style="font-weight:regular; color:#2E2A61;"> Sudah diajukan </td>';
              }

              $url_pemeriksaan = "Belum diberikan";
              if ($ppk->url_periksa!=null){
                $url_pemeriksaan = $ppk->url_periksa;
              }
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$url_pemeriksaan.'</td>';
              $jadwal_string = "";
              if ($ppk->jadwal_periksa!=null){
                $jadwal_string = date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa));
              }
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$jadwal_string.'</td>';
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->no_sertif.'</td>';
              $html .= 
              '<td>
                <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark">Cek PPK</a>
              </td>';
              $html .= 
              '<td>
                <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark">Cetak Segel</a>
              </td>';
              $status_string = "Belum di proses";
              if ($ppk->status==1){
                $status_string = "Diproses";
              }else if ($ppk->status==2){
                $status_string = "Ditolak";
              }else if ($ppk->status==3){
                $status_string = "Disetujui";
              }
              $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$status_string.'</td>';
              $html .= '</tr>';
              $count++;
              echo $html;
            }
            ?>
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
      $('#tablePermohonanPemeriksaanVirtual').DataTable({
        responsive: true,
      });
      
    } );
  </script>
@endpush