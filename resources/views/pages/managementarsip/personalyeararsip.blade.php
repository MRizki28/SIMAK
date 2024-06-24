@extends('Layouts.Base')
@section('content')
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
                    url: "{{ url('v1/arsip/year') }}",
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody += '<td class="text-center" data-year="' + item.year + '">' + item.year + '</td>';
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
                                const year = encryptToken(String($(this).find('td').data("year")), key);
                                console.log(year)
                                localStorage.setItem('year', year);
                                let idUser = decryptToken(Cookies.get('cookie_user'), key);
                                const url = '{{ url('/personal-arsip/jenis-dokumen/') }}';
                                window.location.href = url;
                            });
                        }
                    }
                });
            }
            getAllData();
        });
    </script>
@endsection
