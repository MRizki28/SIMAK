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
                            <button class="btn btn-primary " data-toggle="modal" data-target="#arsipModal">Tambah
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
                                    Total <span id="data-total">0</span> data
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
    <div class="modal fade " id="arsipModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1024px; ">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="code_arsip">Kode Arsip</label>
                                            <input type="text" class="form-control  required" required name="code_arsip"
                                                placeholder="Contoh: SM-001">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="id_type_document">Jenis Dokumen</label>
                                            <select name="id_type_document" class="form-control" id="id_type_document"
                                                style="width: 100%; height: 30px;">
                                                <option value="" selected disabled hidden>Choose here</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="id_year">Tahun Arsip</label>
                                            <select name="id_year" class="form-control" id="id_year"
                                                style="width: 100%; height: 30px;">
                                                <option value="" selected disabled hidden>Choose here</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="date_arsip">Tanggal Arsip</label>
                                            <input type="date" class="form-control  required" required
                                                name="date_arsip">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="date_arsip">Label</label>
                                            <select class="form-control" name="in_or_out_arsip" id="in_or_out_arsip">
                                                <option value="" selected disabled hidden>Choose here</option>
                                                <option value="suratMasuk">Surat Masuk</option>
                                                <option value="suratKeluar">Surat Keluar</option>
                                                <option value="tidakKeduanya">Jenis Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-show-validation">
                                            <label for="file_arsip">File</label>
                                            <input type="file" class="form-control" required name="file_arsip[]"
                                                id="file_arsip[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="date_arsip">Description</label>
                                    <textarea class="form-control" required name="description" id="description" rows="3"></textarea>
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

    <a href="/file/id/id_arsip">view</a>
    <script>
        $(document).ready(function() {
            dateRangePickerSetup($('#datetime'))

            $("#id_type_document").select2();
            $("#id_year").select2();
            $(".select2-selection").addClass("form-control");

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
                        let idUser = decryptToken(localStorage.getItem('id_user'), key)
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
                                tableBody += "<td><a href='/file/"+idUser +"/" + value.id + "'>View</a></td>";

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
                                $("#data-total").text(response.data.total);
                            });
                            paginationLink(pagination, response);
                        } else {
                            $("#table tbody").empty();
                            $("#dataNotFound").show();
                            pagination.empty();
                            $("#data-total").text('0');
                        }
                    }
                });
            }

            loadData();

            function getDataTypeDocument() {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('api/v1/typedocument/get/user') }}",
                        dataType: "JSON",
                        success: function(response) {
                            let option = "";
                            $.each(response.data, function(index, item) {
                                option += '<option value="' + item.id +
                                    '">' + item.name_type_document + '</option>';
                            });
                            resolve(option)
                        },
                        error: function(error) {
                            reject(error);
                        }
                    });
                })
            }

            function getDataYear() {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('api/v1/year') }}",
                        dataType: "JSON",
                        success: function(response) {
                            let option2 = "";
                            $.each(response.data, function(index, item) {
                                option2 += '<option value="' + item.id +
                                    '">' + item.year + '</option>';
                            });
                            resolve(option2)
                        },
                        error: function(error) {
                            reject(error);
                        }
                    });
                })
            }

            Promise.all([getDataTypeDocument(), getDataYear()])
                .then(function(result) {
                    let dataTypeDocument = result[0];
                    let dataYear = result[1];

                    $("#id_type_document").append(dataTypeDocument);
                    $("#id_year").append(dataYear);
                }).catch(function(err) {
                    console.log(error)
                });

            function validationCreateData() {
                $('#formTambah').validate({
                    rules: {
                        code_arsip: {
                            required: true
                        },
                        id_type_document: {
                            required: true
                        },
                        id_year: {
                            required: true
                        },
                        date_arsip: {
                            required: true
                        },
                        in_or_out_arsip: {
                            required: true
                        },
                        file_arsip: {
                            required: true,
                            extension: "docx|png|jpg|jpeg|xlxs|xlx|csv|doc|pdf"
                        },
                        description: {
                            required: true
                        }

                    },
                    messages: {
                        code_arsip: {
                            required: "Field ini wajib diisi"
                        },
                        id_type_document: {
                            required: "Field ini wajib diisi"
                        },
                        id_year: {
                            required: "Field ini wajib diisi"
                        },
                        date_arsip: {
                            required: "Field ini wajib diisi"
                        },
                        in_or_out_arsip: {
                            required: "Field ini wajib diisi"
                        },
                        file_arsip: {
                            required: "Field ini wajib diisi",
                            extension: "Format only png,jpg,jpeg,pdf,docx,doc,xlxs,xlx,csv"
                        },
                        description: {
                            required: "Field ini wajib diisi",
                        },

                    },
                    highlight: function(element) {
                        $(element).closest('.form-group, .select2').removeClass('has-success').addClass(
                            'has-error');
                    },

                    success: function(element) {
                        $(element).closest('.form-group, .select2').removeClass('has-error').addClass(
                            'has-success');
                    }
                });
            }
            $('#id_type_document, #id_year').on('change', function() {
                $(this).valid();
            });

            validationCreateData();

            $("#formTambah").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let submitButton = $(this).find(":submit");

                submitButton.attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/arsip/create') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        submitButton.attr('disabled', false);
                        if (response.message == "Check your validation") {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successAlert().then(function() {
                                $('#arsipModal').modal('hide');
                                loadData()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        errorAlert();
                    }
                });
            });
        });
    </script>
@endsection
