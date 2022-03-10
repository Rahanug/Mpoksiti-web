<style>
  .placeholder::-webkit-input-placeholder {
    color: rgba(46, 42, 97, 0.69);
    font-weight: bold;
    text-align: center;
  }
  .placeholder::-moz-input-placeholder {
      color: rgba(46, 42, 97, 0.69);
      font-weight: bold;
      text-align: center;
  }
  .placeholder::-ms-input-placeholder {
    color: rgba(46, 42, 97, 0.69);
    font-weight: bold;
    text-align: center;
  }
  .placeholder::-o-input-placeholder {
    color: rgba(46, 42, 97, 0.69);
    font-weight: bold;
    text-align: center;
  }

</style>

@extends('layouts.jpp')

@section('content')
<script>document.title = "Management User - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Pemeriksaan Virtual</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <!--Here is spot for put the button -->
        <form class="row row-cols-lg-auto g-3 align-items-center">
          <div class="input-group mb-3">
            <!--<input type="text" id="search"class="placeholder" name="npwp" placeholder="NO PPK" aria-label="Recipient's username" >
            <button type="button" class="btn btn-secondary" style="font-weight: bold; background-color: #3C5C94" onclick="//location.href='/admin/manage/addUser'">Search</button>-->
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Session ketika berhasil -->
  @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif

    @if (session()->has('accept'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('accept') }}
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif

  @if (session()->has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  </div>
  @endif

  @if (session()->has('info'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('info') }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  </div>
  @endif

  <div id="taro">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">No</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Aju PPK</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">No PPK</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Tgl PPK</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Trader</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Jadwal Pemeriksaan</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Sertifikat</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 0;
          foreach ($list_ppk as $ppk){
            $count++;
            $html = '<tr>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$count.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->no_aju_ppk.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->no_ppk.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$count.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$ppk->nm_penerima.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$count.'</td>';
            $html .= '<td style="font-weight:regular; color:#2E2A61;"> '.$count.'</td>';
            $html .= 
            '<td>
              <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark">Delete</a>
            </td>';
            $html .= '</tr>';
            echo $html;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $('#search').on('keyup', function(){
      search();
    });
    search();
    function search(){
      var keyword = $('#search').val();

      $.post('{{ route("admin.search") }}',{
        _token: $('meta[name="csrf-token"]').attr('content'),
        keyword:keyword
      },
      function(data){
        table_post_row(data);
      });
    }
    function table_post_row(res){
      let htmlView = '';
      if(res.list_ppk.length <= 0){
        htmlView += '<tr><td colspan = "4" style="font-weight:regular; color:#2E2A61;">No data.</td></tr>';
      }
      for(let i=0; i<res.list_ppk.length; i++){
        htmlView += `<tr>
            <td style="font-weight:regular; color:#2E2A61;">`+ (i+1) +`</td>
            <td style="font-weight:regular; color:#2E2A61;">`+ res.list_ppk.no_aju_ppk +`</td>
            <td style="font-weight:regular; color:#2E2A61;">`+ res.list_ppk.no_ppk +`</td>
            <td style="font-weight:regular; color:#2E2A61;">`+ res.list_ppk.id_trader +`</td>
            <td>
              <a href="`/*/admin/manage/delete/${res.traders[i].id_trader}*/`" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark">Delete</a>
            </td>
          </tr>`;
      }
      $('tbody').html(htmlView);
    }
  </script>
@endpush