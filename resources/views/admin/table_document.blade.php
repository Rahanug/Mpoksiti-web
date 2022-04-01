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
</div>
@else
<a target="_blank" href="<?= url('files/' . $dokumens[$kategori['id_kategori']]['nm_dokumen']) ?>" style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Preview</a>
@endif
</td>
</tr>
@endforeach
</tbody>
</table>
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