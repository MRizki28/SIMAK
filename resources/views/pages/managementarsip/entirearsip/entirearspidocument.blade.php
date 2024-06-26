@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="page-header">
                            <h4 class="page-title">Jenis dokumen <span id="nameUser"></span></h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="/">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/entire-arsip/">
                                        <span>Pengguna</span>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/entire-arsip/year">
                                        <span>Tahun arsip</span>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <span style="font-size: 13px;" class="font-weight-bold">jenis dokumen</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead style="background-color: #f7f8fa;">
                                    <tr class="text-center" style="padding: 0 25px !important;">
                                        <th style="padding: 0 25px !important;">Jenis dokumen</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let nameUser = localStorage.getItem('nameUser')
        $('#nameUser').text(nameUser);
        $(document).ready(function() {
            function getAllData() {
                if ($.fn.DataTable.isDataTable("#dataTable")) {
                    $("#dataTable").DataTable().destroy();
                }
                let dataTable = $("#dataTable").DataTable();
                year = decryptToken(localStorage.getItem('entire_year'), key)
                id_user = decryptToken(localStorage.getItem('id_entire_user'), key)
                console.log('year', year)
                $.ajax({
                    type: "GET",
                    url: "{{ url('v1/typedocument/get/entire/document?id_user=') }}" + id_user +
                        "&year=" + year,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr data-id="' + item.id + '">';
                            tableBody +=
                                '<td class="text-center">' + item.name_type_document +
                                '</td>';
                            tableBody += '</tr>';
                        });
                        $("#loading-row").remove();
                        dataTable.clear().rows.add($(tableBody)).draw();
                        if (response.data.length == 0 | response.data.length == null) {
                            $("#dataTable tbody tr").css("cursor", "");
                        } else {
                            $("#dataTable tbody tr").css("background-color", "");
                            $("#dataTable tbody tr").css("cursor", "pointer");
                            $("#dataTable tbody tr").hover(function() {
                                $(this).css("background-color",
                                    "#f2f2f2");
                            }, function() {
                                $(this).css("background-color",
                                    "");
                            });
                            $("#dataTable tbody").off("click", "tr").on("click", "tr", function() {
                                const id_type_document = encryptToken($(this).data("id"), key);
                                localStorage.setItem('id_entire_type_document', id_type_document);
                                const url = '{{ url('/entire-arsip/data') }}';
                                window.location.href = url;
                            });
                        }
                    }
                });
            }
            getAllData();
            $(window).on('storage', function(event) {
                protectedModificationSystem(event);
            });
        });
    </script>
@endsection
