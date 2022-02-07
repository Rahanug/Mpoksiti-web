<div class="table-responsive">
      <table class="table table-striped" id="tablePpk">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Penerima</th>
            <th scope="col">Nomor PPK</th>
            <th scope="col">Nomor Pengajuan PPK</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; ?>
          @foreach ($ppks as $ppk) 
          <tr>
            <td>{{ ++$no; }}</td>
            <td>{{ $ppk->nm_penerima}}</td>
            <td>{{ $ppk->no_ppk }}</td>
            <td>{{ $ppk->no_aju_ppk }}</td>
            <td style="font-weight: bold">{{ ucfirst($ppk->status)}}</td>
            <td>
            @if ($ppk->status == "Pengajuan - Disetujui")
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Upload Dokumen</a>  
            @endif

            @if ($ppk->status == "Dokumen - Terverifikasi")
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Stuffing Virtual</a>  
            @endif

            @if ($ppk->status == "Selesai")
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Cetak HC</a>  
            @endif

              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>