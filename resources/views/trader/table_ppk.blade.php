<div class="table-responsive">
  <table class="table table-striped" id="tablePpk">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nomor Aju PPK</th>
        <th scope="col">Penerima</th>
        <th scope="col">Negara</th>
        <th scope="col">Jadwal</th>
        <th scope="col">Link</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 0; ?>
      @foreach ($ppks as $ppk)
      <tr>
        <td>{{ ++$no; }}</td>
        <td>{{ $ppk->no_aju_ppk }}</td>
        <td>{{ $ppk->nm_penerima}}</td>
        <td>{{ $ppk->negara_penerima}}</td>
        @if($ppk->status == "Penjadwalan")
        <td><a style="margin: 0 3px" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ajukanModal-{{$ppk->id_ppk}}">Ajukan</a></td>
        @else
        <td>{{ $ppk->jadwal_periksa}}</td>
        @endif
        <td>{{ $ppk->url_periksa}}</td>
        <td style="font-weight: bold">{{ ucfirst($ppk->status)}}</td>
        <td>
          @if ($ppk->status == "" || $ppk->status == "Verifikasi")
          <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="/home/{{$ppk->id_ppk}}">Unggah</a>
          @endif

          @if ($ppk->status == "Selesai")
          <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Cetak HC</a>
          @endif
          <a style="margin: 0 3px" class="btn btn-sm btn-secondary" id="detail">Detail</a>
        </td>
      </tr>
      <!-- Ajukan Tanggal Modal -->
      <div class="modal fade" id="ajukanModal-{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Jadwal yang diajukan</h5>
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
                            <form method="POST" action="/home/ajukan/{{$ppk->id_ppk}}" enctype="multipart/form-data">
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
                                    <label for="jadwal_periksa" style="font-weight:500; color:#2E2A61; font-size: 18px;">Jadwal</label>
                                    <input type="datetime-local" id="jadwal_periksa" value="{{ date('Y-m-d\TH:i', strtotime($ppk->jadwal_periksa))}}" class="form-control" placeholder="Jadwal" name="jadwal_periksa">
                                  </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                  <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
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
      @endforeach
    </tbody>
  </table>
</div>