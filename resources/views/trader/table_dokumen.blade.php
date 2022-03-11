@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

<div class="table-responsive">
  <table class="table" id="tableDokumen">
    <thead>
      <tr>
        <th scope="col">Kategori Dokumen</th>
        <th scope="col">Nama Dokumen</th>
        <th scope="col">Nomor Dokumen</th>
        <th scope="col">Tanggal Terbit</th>
        <th scope="col" id="col-aksi">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $showButton = false;
      ?>
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="/home/{{$ppk->id_ppk}}/storeDokumen">
        @csrf
        @foreach ($kategoris as $kategori)
        <?php $no = 0; ?>
        <tr>
          <td>{{$kategori->nama_kategori}}</td>
          <td>
            {{$dokumens[$kategori['id_kategori']]['nm_dokumen'] ?? ''}}
          </td>
          <td>
            {{$dokumens[$kategori['id_kategori']]['no_dokumen'] ?? ''}}
          </td>
          <td>
            {{$dokumens[$kategori['id_kategori']]['tgl_terbit'] ?? ''}}
          </td>
          <td id="button-aksi">
            @if(!isset($dokumens[$kategori['id_kategori']]['nm_dokumen']))
            <?php $showButton = true; ?>
            <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#masterModal-{{$kategori->id_kategori}}">Pilih Master</a>

            <!-- Modal Master-->
            <div class="modal fade" id="masterModal-{{$kategori->id_kategori}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Master Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table class="table table-striped tableMaster" id="tableMaster">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori Dokumen</th>
                            <th scope="col">Nomor Dokumen</th>
                            <th scope="col">Tanggal Terbit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Isi Table -->
                          @if(isset($masterDokumens[$kategori['id_kategori']]))
                          @foreach ($masterDokumens[$kategori['id_kategori']] as $no => $masterDokumen)
                          <tr>
                            <td>{{ ++$no; }}</td>
                            <td>{{ $kategori['nama_kategori'] }}</td>
                            <td>{{ $masterDokumen['no_dokumen'] }}</td>
                            <td>{{ $masterDokumen['tgl_terbit'] }}</td>>
                            <td>{{ $masterDokumen['status'] }}</td>
                            <td>
                              <button type="button" style="margin: 0 3px" class="btn btn-sm btn-primary" onclick="chooseMaster(<?= $masterDokumen['id_master'] ?>)">Pilih</button>
                            </td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#addModal">Upload Dokumen</a>

            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
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
                              <div class="card-content">
                                <div class="card-body">
                                  <form method="POST" action="/master/addMaster/storeMaster" enctype="multipart/form-data">
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
                                            @foreach ($kategoris as $item)
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
                  </div>
                </div>
              </div>
            </div>
</div>

@else
<a href="/home/{{$ppk->id_ppk}}/delete/{{$dokumens[$kategori['id_kategori']]['id_dokumen']}}" style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Delete</a>
@endif
</td>
</tr>
@endforeach
</tbody>
</form>
</table>
@if($showButton)
<div class="col-md-12">
  <button form="upload-file" type="submit" class="btn btn-primary" id="submit" >Submit</button>
</div>
@endif
</div>





@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('.tableMaster').DataTable({
      responsive: true,
    });
  });
</script>
@endpush