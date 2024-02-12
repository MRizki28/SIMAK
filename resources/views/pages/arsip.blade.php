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
                            <button class="btn btn-primary " data-toggle="modal" data-target="#typeDocumentModal">Tambah
                                Data
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2 mb-md-0 row">
                            <div class="col-md-5 col-12 row mb-2" style="margin-left: -8px;">

                                {{-- Form Search --}}
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Cari..." id="form-search">
                                    <span class="input-icon-addon" id="search-button">
                                        <i class="fa fa-search " style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-5 col-12 p-0 d-flex justify-content-end align-items-center "
                                style="margin-right: 20px;">
                                {{-- Form search by daterange --}}
                                <div class="form-group col-sm-12 col-md-7 row">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="datetime" name="datetime"
                                            placeholder="Cari berdasarkan rentang ">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class=" table " id="table">
                                <thead style="background-color: #f7f8fa;">
                                    <tr class="text-center" style="padding: 0 25px !important;">
                                        <th style="padding: 0 25px !important;">No</th>
                                        <th style="padding: 0 25px !important;">Kode Arsip</th>
                                        <th style="padding: 0 25px !important;">Pembuat</th>
                                        <th style="padding: 0 25px !important;">Jenis Dokumen</th>
                                        <th style="padding: 0 25px !important;">Tahun Arsip</th>
                                        <th style="padding: 0 25px !important;">File</th>
                                        <th style="padding: 0 25px !important;">Tanggal</th>
                                        <th style="padding: 0 25px !important;">Type Dokumen</th>
                                        <th style="padding: 0 25px !important;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                                <tfoot id="dataNotFound">
                                    <tr class="text-center text-muted" id="template-empty-info">
                                        <td colspan="9" class=" ">
                                            <i class="fas fa-folder-open mr-1"></i> File tidak ditemukan ...
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="d-flex justify-content-between align-items-center px-4">
                                <span class="mb-3 text-muted">
                                    Total <span id="data-total">...</span> data
                                </span>
                                <ul class="pagination pg-info"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <div class="modal fade " id="typeDocumentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 550px; top:118px;">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-body">
                        <div class="header">
                            <span style="font-size: 20px;" id="modal-title">Tambah Data</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form mt-4">
                            <form action="" id="formTambah">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group form-show-validation">
                                    <label for="name_type_document">Jenis Dokumen</label>
                                    <input type="text" class="form-control  required" required name="name_type_document">
                                </div>
                                <div class="button-footer d-flex justify-content-between mt-4">
                                    <div class="d-flex justify-content-end align-items-end" style="width: 100%;">
                                        <div class="button-footer d-flex justify-content-between mt-4">
                                            <div class="d-flex justify-content-end align-items-end" style="width: 100%;">
                                                <button type="button" class="btn btn-danger text-white mr-3"
                                                    data-dismiss="modal" aria-label="Close">Batal</button>
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal update --}}
    <div class="modal fade " id="typeDocumentEditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 550px; top:118px;">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-body">
                        <div class="header">
                            <span style="font-size: 20px;" id="modal-title">Edit Data</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form mt-4">
                            <form action="" id="formEdit">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group form-show-validation">
                                    <label for="name_type_document">Jenis Dokumen</label>
                                    <input type="text" class="form-control  required" required
                                        name="name_type_document" id="name_type_document">
                                </div>
                                <div class="button-footer d-flex justify-content-between mt-4">
                                    <div class="d-flex justify-content-end align-items-end" style="width: 100%;">
                                        <div class="button-footer d-flex justify-content-between mt-4">
                                            <div class="d-flex justify-content-end align-items-end" style="width: 100%;">
                                                <button type="button" class="btn btn-danger text-white mr-3"
                                                    data-dismiss="modal" aria-label="Close">Batal</button>
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            dateRangePickerSetup($('#datetime'))

            function paramsSearch() {
                const search = $("#form-search").val();
                const startDate = $("#datetime").data("start-date");
                const endDate = $("#datetime").data("end-date");

                return {
                    search,
                    startDate,
                    endDate
                };
            }

            $(document).on('keyup', '#form-search', function(event) {
                if (event.keyCode === 13) {
                    loadData();
                }
            });

            $(document).on('click', '#search-button', function() {
                loadData()
            })

            $('#datetime').on('apply.daterangepicker cancel.daterangepicker', function() {
                loadData();
            });


            $(document).on('click', '.page-link', function(event) {
                event.preventDefault()

                const url = new URL($(this).attr('href'))

                const fullUrl = url.pathname + url.search
                loadData(fullUrl)
            })

            function loadData(url) {
                let params = paramsSearch();
                console.log(params)
                let endpoint = paramsUrl(
                    url || "api/v1/arsip/",
                    params
                );

                const pagination = $(".pagination");

                $("#table tbody").empty();
                pagination.empty();

                $.ajax({
                    type: "GET",
                    url: endpoint,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";

                        if (response.code == 200) {
                            $.each(response.data.data, function(item, value) {
                                let name_type_document = value.type_document.name_type_document;
                                let file_arsip = value.file_arsip;
                                console.log(file_arsip)
                                $("#table tbody").empty();
                                tableBody += "<tr>";
                                tableBody += "<td>" + (item + 1) + "</td>"
                                tableBody += "<td>" + value.code_arsip + "</td>"
                                tableBody += "<td>" + value.id_user + "</td>"
                                tableBody += "<td>" + name_type_document +
                                    "</td>"
                                tableBody += "<td>" + value.id_year + "</td>"
                                tableBody += "<td>" + value.file_arsip + "</td>"
                                tableBody += "<td>" + value.date_arsip + "</td>"
                                tableBody += "<td>" + value.is_private + "</td>"
                                tableBody +=
                                    "<td style='padding: 0 10px !important;'  class='text-left text-center '>" +
                                    "<button class='btn btn-sm edit-modal mr-1' data-toggle='modal' data-target='#typeDocumentEditModal' data-id='" +
                                    value.id + "'><i class='fas fa-edit'></i></button>" +
                                    "<button type='submit' class='delete-confirm btn btn-sm' data-id='" +
                                    value.id +
                                    "' name='rejected'><i class='fas fa-trash-alt'></i></button>" +
                                    "</td>";
                                tableBody += "</tr>";

                                $("#table tbody").append(tableBody);
                                $("#dataNotFound").hide();
                            });
                            paginationLink(pagination, response);
                        } else {
                            $("#table tbody").empty();
                            $("#dataNotFound").show();
                            pagination.empty();
                        }
                    }
                });
            }

            loadData();

        });
    </script>
@endsection
