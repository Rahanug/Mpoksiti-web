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

@extends('layouts.admin')

@section('content')
<script>document.title = "Publikasi - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Publikasi</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <!--Here is spot for put the button -->
        <form class="row row-cols-lg-auto g-3 align-items-center">
          <div class="input-group mb-3">
            <input type="text" id="search" class="placeholder" name="gambar" placeholder="Nama File Gambar" >
            <button type="button" class="btn btn-secondary" style="font-weight: bold; background-color: #3C5C94" onclick="location.href='/admin/publikasi/addGambar'">ADD</button>
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


    <div class="d-flex">
        <div class="row mt-3" style="margin: 2%;">
            <div class="d-flex row d-inline-block" id="divcol">

            </div>
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

      $.post('{{ route("admin.searchGambar") }}',{
        _token: $('meta[name="csrf-token"]').attr('content'),
        keyword:keyword
      },
      function(data){
        table_post_row(data);
      });
    }
    function table_post_row(res){
      let htmlView = '';
      if(res.publikasi.length <= 0){
        htmlView += '<tr><td colspan = "4" style="font-weight:regular; color:#2E2A61;">No data.</td></tr>';
      }
      for(let i=0; i<res.publikasi.length; i++){
        htmlView += `<div class="mx-4 col-lg-3 col-md-4 mb-3" >
                        <div style="width: 250px;" class="mx-2">
                            <div class="card mb-2 shadow-sm" >
                                    <img class="card-img-top img-fluid" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]"
                                    style="height: 400px; display: block; object-fit: cover;" src="/img/${res.publikasi[i].file_gambar}" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text"><b>${res.publikasi[i].nm_gambar}</b></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="location.href='/admin/publikasi/delete/${res.publikasi[i].id_gambar}'">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
      }
      $('#divcol').html(htmlView);
    }
  </script>
@endpush
