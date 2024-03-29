@extends('Layouts.Base')
@section('content')
    <style>
        /* Ganti tampilan baris saat kursor diarahkan ke atas */
        #dataTable tbody tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
    </style>
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="page-header">
                            <h4 class="page-title">Tahun Arsip</h4>
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
                                    <span style="font-size: 13px;" class="font-weight-bold">Tahun Arsip</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="table-layout">
                            <table class="table" id="dataTable">
                                <thead style="background-color: #f7f8fa;">
                                    <tr class="text-center" style="padding: 0 25px !important;">
                                        <th style="padding: 0 25px !important;">Tahun</th>
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
        $(document).ready(function() {
            function getAllData() {
                if ($.fn.DataTable.isDataTable("#dataTable")) {
                    $("#dataTable").DataTable().destroy();
                }
                let dataTable = $("#dataTable").DataTable();
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/year/personal/get') }}",
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr data-id="' + item.id + '">';
                            tableBody += '<td class="text-center">' + item.year + '</td>';
                            tableBody += '</tr>';
                        });
                        $("#loading-row").remove();
                        dataTable.clear().rows.add($(tableBody)).draw();

                        $("#dataTable tbody").off("click", "tr").on("click", "tr", function() {
                            const id_year = encryptToken($(this).data("id"), key);
                            localStorage.setItem('id_year', id_year);
                            let idUser = decryptToken(Cookies.get('cookie_user'), key);
                            const url = '{{ url('/personal-arsip/jenis-dokumen/') }}';
                            window.location.href = url;
                        });
                    }
                });
            }
            getAllData();
            
        });
    </script>
@endsection
