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
                        <div class="table-responsive">
                            <table class=" table " id="dataTable">
                                <thead style="background-color: #f7f8fa;">
                                    <tr class="text-center" style="padding: 0 25px !important;">
                                        <th style="padding: 0 25px !important;" width="50">No</th>
                                        <th style="padding: 0 25px !important;">Jenis Dokumen</th>
                                        <th style="padding: 0 25px !important;" width="120">Aksi</th>
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
                                    <input type="text" class="form-control  required" required name="name_type_document"
                                        id="name_type_document">
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
            function getAllData() {
                if ($.fn.DataTable.isDataTable("#dataTable")) {
                    $("#dataTable").DataTable().destroy();
                }
                let dataTable = $("#dataTable").DataTable();
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/typedocument') }}",
                    dataType: "JSON",
                    success: function(response) {
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody +=
                                "<td style='padding: 0 25px !important;' class='text-center'>" +
                                (index + 1) + "</td>";
                            tableBody +=
                                '<td style="padding: 0 25px !important;"  class="text-center">' +
                                item.name_type_document +
                                '</td>';
                            tableBody +=
                                "<td style='padding: 0 10px !important;'  class='text-left text-center '>" +
                                "<button class='btn btn-sm edit-modal mr-1' data-toggle='modal' data-target='#typeDocumentEditModal' data-id='" +
                                item.id + "'><i class='fas fa-edit'></i></button>" +
                                "<button type='submit' class='delete-confirm btn btn-sm' data-id='" +
                                item.id +
                                "' name='rejected'><i class='fas fa-trash-alt'></i></button>" +
                                "</td>";
                            tableBody += '</tr>';
                        });
                        $("#loading-row").remove();
                        dataTable.clear().rows.add($(tableBody)).draw();
                    }
                });
            }
            getAllData();

            function validationCreateData() {
                $('#formTambah').validate({
                    rules: {
                        name_type_document: {
                            required: true
                        }
                    },
                    messages: {
                        name_type_document: {
                            required: "Field ini wajib diisi"
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.form-group').removeClass('has-success').addClass(
                            'has-error');
                    },

                    success: function(element) {
                        $(element).closest('.form-group').removeClass('has-error').addClass(
                            'has-success');
                    }
                });
            }

            function validationUpdateData() {
                $('#formEdit').validate({
                    rules: {
                        name_type_document: {
                            required: true
                        }
                    },
                    messages: {
                        name_type_document: {
                            required: "Field ini wajib diisi"
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.form-group').removeClass('has-success').addClass(
                            'has-error');
                    },

                    success: function(element) {
                        $(element).closest('.form-group').removeClass('has-error').addClass(
                            'has-success');
                    }
                });
            }
            validationCreateData();
            validationUpdateData();

            //create data
            $("#formTambah").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');

                submitButton.attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/typedocument/create') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        submitButton.attr('disabled', false);
                        if (response.message == "Check your validation") {
                            Swal.fire({
                                title: 'Peringatan',
                                text: 'Input tidak boleh kosong !',
                                icon: 'warning',
                                timer: 5000,
                                showConfirmButton: true
                            });
                        } else if (response.code == 400) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan',
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: true
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Success',
                                text: 'Data berhasil Ditambahkan',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            }).then(function() {
                                $('#typeDocumentModal').modal('hide');
                                getAllData()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        Swal.fire({
                            title: "Error",
                            html: 'Terjadi kesalahan',
                            icon: "error",
                            timer: 5000,
                            showConfirmButton: true
                        });
                    }
                });
            });

            //get data by id
            $(document).on('click', '.edit-modal', function() {
                const id = $(this).data('id');
                console.log("Edit modal clicked, id:", id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/typedocument/get') }}/" + id,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        $('#id').val(response.data.id);
                        $('#name_type_document').val(response.data.name_type_document);
                    }
                });
            });

            //update data
            $("#formEdit").submit(function(e) {
                e.preventDefault();
                let id = $('#id').val();
                console.log("Form submitted for editing, id:", id);
                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');
                submitButton.attr('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/typedocument/update') }}/" + id,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        submitButton.attr('disabled', false);
                        if (response.message == "Check your validation") {
                            Swal.fire({
                                title: 'Peringatan',
                                text: 'Input tidak boleh kosong !',
                                icon: 'warning',
                                timer: 5000,
                                showConfirmButton: true
                            });
                        } else if (response.code == 400) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan',
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: true
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Success',
                                text: 'Data berhasil diperbaharui',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            }).then(function() {
                                $('#typeDocumentEditModal').modal('hide');
                                getAllData();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        Swal.fire({
                            title: "Error",
                            html: 'Terjadi kesalahan',
                            icon: "error",
                            timer: 5000,
                            showConfirmButton: true
                        });
                    }
                });

            });

            //deleteData

            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus ?',
                    text: 'Anda tidak dapat mengembalikan  ini',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('api/v1/typedocument/delete') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                if (response.code === 400) {
                                    Swal.fire({
                                        title: 'Gagal menghapus data',
                                        text: 'Data sedang digunakan !',
                                        icon: 'error',
                                        timer: 5000,
                                        showConfirmButton: true
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Data berhasil dihapus',
                                        icon: 'success',
                                        timer: 5000,
                                        showConfirmButton: true
                                    }).then(function() {
                                        getAllData();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan',
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: true
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
