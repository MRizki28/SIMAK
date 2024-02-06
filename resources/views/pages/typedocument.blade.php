@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title">Jenis Dokumen</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-primary " data-toggle="modal" data-target="#typeDocument">Tambah
                                Data
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover dataTable" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th width="30">No</th>
                                        <th>Jenis Dokumen</th>
                                        <th width="120">Aksi</th>
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
                    url: "{{ url('api/v1/typedocument') }}",
                    dataType: "json",
                    // beforeSend: function() {
                    //     $("#dataTable tbody").html(
                    //         '<tr id="loading-row"><td colspan="9" class="text-center">Loading...</td></tr>'
                    //     );
                    // },
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody += "<td class='text-center'>" + (index + 1) + "</td>";
                            tableBody += '<td class="text-center">' + item.name_type_document +
                                '</td>';
                            tableBody +=
                                "<td style='border: 1px solid black; padding: 10px;' class='text-left text-center'>" +
                                "<button  class='btn-approve text-primary edit-modal mr-2' style='border-right: 1px solid black; padding-right: 10px;' data-toggle='modal' data-target='#accountModal' data-id='" +
                                item.id + "'>Edit</button>" +
                                "<button type='submit' class='delete-confirm text-danger btn-approve' style='margin-left: -8px;' data-id='" +
                                item.id + "' name='rejected'>Hapus</button>" +
                                "</td>";
                            tableBody += '</tr>';

                        });
                        $("#loading-row").remove();
                        dataTable.clear().rows.add($(tableBody)).draw();
                    }
                });
            }

            getAllData();
        });
    </script>
@endsection
