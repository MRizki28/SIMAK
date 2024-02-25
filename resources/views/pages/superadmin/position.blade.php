@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title">Jabatan</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-primary " data-toggle="modal" data-target="#positionModal">Tambah
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
                                        <th style="padding: 0 25px !important;">Kode Jabatan</th>
                                        <th style="padding: 0 25px !important;">Jabatan</th>
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
    <div class="modal fade " id="positionModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="code_position">Kode Jabatan</label>
                                    <input type="text" class="form-control  " required name="code_position"
                                        id="code_position" placeholder="LR-001">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="position">Jabatan</label>
                                    <input type="text" class="form-control" required name="position" id="position"
                                        placeholder="input here">
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
    <div class="modal fade " id="positionEditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="code_position">Kode Jabatan</label>
                                    <input type="text" class="form-control  " required name="code_position"
                                        id="ecode_position" placeholder="LR-001" readonly="readonly">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="position">Jabatan</label>
                                    <input type="text" class="form-control" required name="position" id="eposition"
                                        placeholder="input here">
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
                    url: "{{ url('api/v1/position') }}",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody +=
                                "<td style='padding: 0 25px !important;' class='text-center'>" +
                                (index + 1) + "</td>";
                            tableBody +=
                                '<td style="padding: 0 25px !important;"  class="text-center">' +
                                item.code_position +
                                '</td>';
                            tableBody +=
                                '<td style="padding: 0 25px !important;"  class="text-center">' +
                                item.position +
                                '</td>';
                            tableBody +=
                                "<td style='padding: 0 10px !important;'  class='text-left text-center '>" +
                                "<button class='btn btn-sm edit-modal mr-1' data-toggle='modal' data-target='#positionEditModal' data-id='" +
                                item.id + "'><i class='fas fa-edit'></i></button>" +
                                "<button type='submit' class='delete-confirm btn btn-sm' data-id='" +
                                item.id +
                                "' name='rejected'><i class='fas fa-trash-alt'></i></button>" +
                                "</td>";
                            tableBody += '</tr>';
                        });
                        dataTable.clear().rows.add($(tableBody)).draw();
                    }
                });
            }
            getAllData()

            function validationCreateData() {
                $('#formTambah').validate({
                    rules: {
                        code_position: {
                            required: true
                        },
                        position: {
                            required: true
                        }
                    },
                    messages: {
                        code_position: {
                            required: "Field ini wajib diisi"
                        },
                        position: {
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

            function validationEditData() {
                $('#formEdit').validate({
                    rules: {
                        code_position: {
                            required: true
                        },
                        position: {
                            required: true
                        }
                    },
                    messages: {
                        code_position: {
                            required: "Field ini wajib diisi"
                        },
                        position: {
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

            validationEditData()

            $("#formTambah").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');
                submitButton.attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/position/create') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        submitButton.attr('disabled', false);
                        if (response.errors && response.errors.code_position && response.errors
                            .code_position
                            .includes('The code position has already been taken.')) {
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Kode jabatan sudah terdaftar sebelumnya !',
                                icon: 'warning',
                                showConfirmButton: true
                            });
                        } else if (response.message == 'Check your validation') {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successAlert().then(function() {
                                $('#positionModal').modal('hide');
                                getAllData()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        errorAlert();
                    }
                });
            });

            $(document).on('click', '.edit-modal', function() {
                const id = $(this).data('id');
                console.log("Edit modal clicked, id:", id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/position/get') }}/" + id,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        $('#id').val(response.data.id);
                        $('#ecode_position').val(response.data.code_position);
                        $('#eposition').val(response.data.position);
                    }
                });
            });

            $("#formEdit").submit(function(e) {
                e.preventDefault();
                let id = $('#id').val();
                console.log(id)
                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');
                submitButton.attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/position/update') }}/" + id,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        submitButton.attr('disabled', false);
                        if (response.errors && response.errors.code_position && response.errors
                            .code_position
                            .includes('The code position has already been taken.')) {
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Kode jabatan sudah terdaftar sebelumnya !',
                                icon: 'warning',
                                showConfirmButton: true
                            });
                        } else if (response.message == 'Check your validation') {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successAlert().then(function() {
                                $('#positionEditModal').modal('hide');
                                getAllData()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        errorAlert();
                    }
                });
            });

            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                deleteAlert().then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('api/v1/position/delete') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                if (response.code === 400) {
                                    failedDeleteDataAlert();
                                } else {
                                    successDeleteAlert().then(function() {
                                        getAllData();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                errorAlert();
                            }
                        });
                    }
                })
            });

            function resetModal() {
                $('#id').val('').removeClass('border-danger');
                $('.form-group').removeClass('has-success').removeClass('has-error');
                $('#code_position').val('');
                $('#position').val('');
                $('#ecode_position').val('');
                $('#eposition').val('');
                $('#code_position-error').remove();
                $('#position-error').remove();
                $('#ecode_position-error').remove();
                $('#eposition-error').remove();
                
            }

            $('#positionModal , #positionEditModal' ).on('hidden.bs.modal', function() {
                resetModal()
            });
        });
    </script>
@endsection
