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
        <th scope="col">Detail</th>
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
        @if($ppk->status == "Penjadwalan" || $ppk->status == "Ditolak")
        <td><a style="margin: 0 3px" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ajukanModal-{{$ppk->id_ppk}}">Ajukan</a></td>
        @elseif($ppk->jadwal_periksa == "")
        <td></td>
        @else
        <td>{{ date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa))}}</td>
        @endif
        @if($ppk->url_periksa != "" && $ppk->status == "Stuffing")
        <td><a target="_blank" style="margin: 0 3px" class="btn btn-sm btn-link" href="{{ $ppk->url_periksa}}">Link Meeting</a></td>
        @else
        <td></td>
        @endif
        <td style="font-weight: bold">{{ ucfirst($ppk->status)}}</td>
        <td>
          @if ($ppk->status == "" || $ppk->status == "verifikasi")
          <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="/home/{{$ppk->id_ppk}}">Unggah</a>
          @endif
          @if ($ppk->status == "Cetak HC")
          <!-- <a style="margin: 0 3px" class="btn btn-sm btn-info" data-toggle="modal" data-target="#hasilModal-{{$ppk->id_ppk}}">Hasil</a> -->
          <a target="_blank" style="margin: 0 3px" class="btn btn-sm btn-primary" href="/home/cetakHC/{{$ppk->id_ppk}}">Cetak HC</a>
          <!-- Modal Hasil -->
          <div class="modal fade" id="hasilModal-{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Hasil Pemeriksaan Virtual</h5>
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
                                <div class="table-responsive" id="tableHasil-{{$ppk->id_ppk}}">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Hasil</th>
                                        <th scope="col">Keterangan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($ppk->subform as $f)
                                      <tr>
                                        <td>{{ $master[$f->id_masterSubform] }}</td>
                                        <td>{{ $f->value }}</td>
                                        <td>{{ $f->keterangan }}</td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </main>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-link" type="button" data-dismiss="modal">Tutup</button>
                  <button class="btn btn-primary" onclick=<?= 'printDiv("tableHasil-' . $ppk->id_ppk . '")' ?>>Cetak</button>
                </div>
              </div>
            </div>
          </div>
          @endif
        </td>
        <!-- Detail -->
        <td><a style="margin: 0 3px" class="btn btn-sm btn-secondary" href="/home/detail/{{$ppk->id_ppk}}">Detail</a></td>
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
                                    <input type="datetime-local" id="jadwal_periksa" value="{{ date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa))}}" class="form-control" placeholder="Jadwal" name="jadwal_periksa">
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