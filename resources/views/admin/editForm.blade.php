@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/jquery-ui.js">
<!-- jQuery UI -->

@endsection

@section('content')
<script>
    document.title = "Edit Form Stuffing - Mpok Siti"
</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Edit Form Hasil Verifikasi Lapangan</h1>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                       <div id="error-subform" class="alert alert-danger alert-dismissible fade show" role="alert">
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <div class="table-responsive">
                                            <h4 class="h4" style="font-weight:bold; color:#2E2A61;">Form Hasil</h4>
                                            <table class="table" id="tableForm">
                                                <thead>
                                                    <th scope='col'>Indikator</th>
                                                    <th scope='col'>Keterangan</th>
                                                </thead>
                                                <tbody id="active-subform" class="reorder-subform connectedSortable">

                                                    @foreach($data as $d)

                                                    <!-- Buat Switch Case tergantung tipe data -->
                                                    @if(isset($d->urutan))
                                                    <tr id=<?= $d->id_masterSubform ?> class="active-subform ui-state-default">
                                                        <td>{{$d->indikator}}</td>
                                                        <?php switch ($d->tipe_data) {
                                                            case 'datetime':
                                                                echo '<td>tanggal dan waktu</td>';
                                                                break;
                                                            case 'kondisi':
                                                                echo '<td>sesuai/tidak sesuai</td>';
                                                                break;
                                                            case 'text':
                                                                echo '<td>teks</td>';
                                                                break;
                                                            case 'rekomendasi':
                                                                echo '<td>rekomendasi</td>';
                                                                break;
                                                            case 'gambar':
                                                                echo '<td>gambar</td>';
                                                                break;
                                                        } ?>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <h4 class="h4" style="font-weight:bold; color:#2E2A61;">Form Master</h4>
                                            <table class="table" id="tableForm2">
                                                <thead>
                                                    <th scope='col'>Indikator</th>
                                                    <th scope='col'>Keterangan</th>
                                                    
                                                </thead>
                                                <tbody id="master-subform" class="reorder-subform connectedSortable">

                                                    @foreach($data as $d)
                                                    @if(!isset($d->urutan))
                                                    <tr id=<?= $d->id_masterSubform ?> class="master-subform ui-state-default">
                                                        <!-- Buat Switch Case tergantung tipe data -->
                                                        <td>{{$d->indikator}}</td>
                                                        <?php switch ($d->tipe_data) {
                                                            case 'datetime':
                                                                echo '<td>tanggal dan waktu</td>';
                                                                break;
                                                            case 'kondisi':
                                                                echo '<td>sesuai/tidak sesuai</td>';
                                                                break;
                                                            case 'text':
                                                                echo '<td>teks</td>';
                                                                break;
                                                            case 'rekomendasi':
                                                                echo '<td>rekomendasi</td>';
                                                                break;
                                                            case 'gambar':
                                                                echo '<td>gambar</td>';
                                                                break;
                                                        } ?>                                                      
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                        <br>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="button" onclick="ajaxEditActivesubform()" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#error-subform").hide();
        receiveOrder();
        $('.reorder-subform').sortable({
            cancel: ".empty-list",
            connectWith: ".connectedSortable",
            // update: function(event, ui){
            //     receiveOrder();
            // },
            receive: function(event, ui) {
                receiveOrder();
            },
        }).disableSelection();
    });

    function ajaxEditActivesubform() {
        $("#error-subform").hide();

        formData = {
            'added': pushAddedListSubform(),

            'updated': pushUpdatedListSubform(),

            'removed': pushRemovedListSubform(),

            'id_ppk': <?=$id_ppk?>

        };
        // console.log(formData);
        $.ajax({
            type: "POST",
            url: "http://localhost/Mpoksiti-web/public/admin/stuffing/form/edit",
            data: formData,
            success: function(data) {
                data = JSON.parse(data);

                if (data["status"]) {

                    window.location.href = data["redirect_url"];

                } else {
                    $("#error-subform").show();

                    $('#error-subform').html(data["message"]);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

                alert(jqXHR.responseText);
            }
        });
    }

    function pushAddedListSubform() {
        let subform_order = [];

        $("tbody#active-subform tr.master-subform").each(function() {
            subform_order.push($(this).attr("id"));
        });

        return subform_order;
    }

    function pushRemovedListSubform() {
        let subform_order = [];

        $("tbody#master-subform tr.active-subform").each(function() {
            subform_order.push($(this).attr("id"));
        });

        return subform_order;
    }

    function pushUpdatedListSubform() {
        let subform_order = [];

        $("tbody#active-subform tr").each(function() {
            subform_order.push($(this).attr("id"));
        });

        return subform_order;
    }

    function receiveOrder() {
        let activeSubformTableBody = $("#active-subform");
        let masterSubformTableBody = $("#master-subform");
        if (activeSubformTableBody.children().length == 0) {
            activeSubformTableBody.html('<tr class="empty-list"><td>Empty</td><td></td></tr>');
        } else {
            $("#active-subform tr.empty-list").remove();
        }
        if (masterSubformTableBody.children().length == 0) {
            masterSubformTableBody.html('<tr class="empty-list"><td>Empty</td><td></td></tr>');
        } else {
            $("#master-subform tr.empty-list").remove();
        }
    }
    <?php
    if (isset($_POST['update'])) {
        foreach ($_POST['positions'] as $position) {
            $index = $position[0];
            $newPosition = $position[1];
        }
    }
    ?>
</script>
@endpush