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
        <div class="page-header ">
            <h4 class="page-title">Jenis Dokumen</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-primary " data-toggle="modal" data-target="#typeDocumentModal">Tambah
                                Data
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                // let segments = window.location.pathname.split('/');
                // console.log(segments)
                // let id_year = segments[4];
                id_year = decryptToken(localStorage.getItem('id_year'), key)
                console.log('id_year', id_year)
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/typedocument/get/user/document?id_year=') }}" + id_year,
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
                        $("#dataTable tbody").off("click", "tr").on("click", "tr", function() {
                            const id_type_document = $(this).data("id");
                            const url = '{{ url('/personal-arsip/data') }}/' +
                                id_type_document + "/" + id_year;
                            window.location.href = url;
                        });
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
