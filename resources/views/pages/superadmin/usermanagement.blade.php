@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title">User Manajemen</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-primary " data-toggle="modal" data-target="#userManagementModal">Tambah
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
                                        <th style="padding: 0 25px !important;">Name</th>
                                        <th style="padding: 0 25px !important;">Email</th>
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
    <div class="modal fade " id="userManagementModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control  " required name="name" id="name">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" required name="email" id="email">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="id_position">Jabatan</label>
                                    <select name="id_position" id="id_position" style="width: 100%; height: 30px;">
                                        <option value="" selected disabled hidden>Choose here</option>
                                    </select>

                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control " readonly="readonly" required name="password"
                                        id="password" value="12345678">
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
    <div class="modal fade " id="userManagementEditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="id" id="eid">
                                <div class="form-group form-show-validation">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control  " required name="name" id="ename">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" required name="email" id="eemail">
                                </div>
                                <div class="form-group form-show-validation">
                                    <label for="id_position">Jabatan</label>
                                    <select name="id_position" id="eid_position" style="width: 100%; height: 30px;">
                                        <option value="" selected disabled hidden>Choose here</option>
                                    </select>
                                </div>
                                <div class="button-footer d-flex justify-content-between mt-4">
                                    <div id="button-reset" class="display-none">
                                        <button class="btn btn-success text-white mr-3 d-flex justify-content-start"
                                            id="reset-password-btn">Reset
                                            Password</button>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-end" style="width: 100%;">
                                        <button type="button" class="btn btn-danger text-white mr-3"
                                            data-dismiss="modal" aria-label="Close">Batal</button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
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
            $("#id_position").select2();
            $("#eid_position").select2();
            $(".select2-selection").addClass("form-control");

            function getAllData() {
                if ($.fn.DataTable.isDataTable("#dataTable")) {
                    $("#dataTable").DataTable().destroy();
                }
                let dataTable = $("#dataTable").DataTable();
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/auth') }}",
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
                                item.name +
                                '</td>';
                            tableBody +=
                                '<td style="padding: 0 25px !important;"  class="text-center">' +
                                item.email +
                                '</td>';
                            if (item.position !== null) {
                                tableBody +=
                                    '<td style="padding: 0 25px !important;"  class="text-center">' +
                                    item.position.position + '</td>';
                            } else {
                                tableBody +=
                                    '<td style="padding: 0 25px !important;"  class="text-center">Admin</td>';
                            }
                            tableBody +=
                                "<td style='padding: 0 10px !important;'  class='text-left text-center '>" +
                                "<button class='btn btn-sm edit-modal mr-1' data-toggle='modal' data-target='#userManagementEditModal' data-id='" +
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
                        name: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        id_position: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        name: {
                            required: "Field ini wajib diisi"
                        },
                        id_position: {
                            required: "Field ini wajib diisi"
                        },
                        email: {
                            required: "Field ini wajib diisi"
                        },
                        password: {
                            required: "Field ini wajib diisi"
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
            validationCreateData();

            function validationEditData() {
                $('#formEdit').validate({
                    rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        id_position: {
                            required: true
                        },
                    },
                    messages: {
                        name: {
                            required: "Field ini wajib diisi"
                        },
                        id_position: {
                            required: "Field ini wajib diisi"
                        },
                        email: {
                            required: "Field ini wajib diisi"
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

            validationEditData();

            $('#id_position').on('change', function() {
                $(this).valid();
            });


            $("#formTambah").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');
                submitButton.attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/auth/register') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        submitButton.attr('disabled', false);
                        if (response.errors && response.errors.email && response.errors.email
                            .includes('The email has already been taken.')) {
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Email sudah terdaftar sebelumnya !',
                                icon: 'warning',
                                showConfirmButton: true
                            });
                        } else if (response.message == 'Check your validation') {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successAlert().then(function() {
                                $('#userManagementModal').modal('hide');
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

            function getDataPosition() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/position') }}",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let option = "";
                        $.each(response.data, function(index, item) {
                            option += '<option value="' + item.id +
                                '">' + item.position + '</option>';
                        });
                        $('#id_position').append(option)
                        $('#eid_position').append(option)
                    }
                });
            }

            getDataPosition();

            $(document).on('click', '.edit-modal', function() {
                const id = $(this).data('id');
                $('#reset-password-btn').data('id', id);
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/auth/get') }}/" + id,
                    dataType: "json",
                    success: function(response) {
                        console.log('disini', response)
                        $('#eid').val(response.data.id);
                        $('#ename').val(response.data.name);
                        $('#eemail').val(response.data.email);
                        $('#eid_position').val(response.data.id_position).trigger('change');
                    }
                });
            });

            $(document).on('click', '#reset-password-btn', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const value = $(this).attr('id');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log(id)

                Swal.fire({
                    title: 'Reset Password!',
                    text: 'Yakin ingin mereset password user ini',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let data = {
                            _token: csrfToken,
                        };
                        $('#reset-password-btn').prop(
                            'disabled', true);

                        $.ajax({
                            type: "POST",
                            url: "{{ url('api/v1/auth/resetpassword') }}/" + id,
                            data: data,
                            dataType: "JSON",
                            success: function(response) {
                                $('#reset-password-btn').prop(
                                    'disabled', true);
                                if (response.code == 400) {
                                    errorAlert();
                                } else {
                                    successAlert().then(function() {
                                        $('#userManagementEditModal').modal(
                                            'hide');
                                        $('#reset-password-btn').prop(
                                            'disabled', true);
                                    });
                                }
                            },
                            error: function(error) {
                                errorAlert();
                                console.log(error)
                            }
                        });
                    }
                });
            });

            $("#formEdit").submit(function(e) {
                e.preventDefault();
                let id = $('#eid').val();
                console.log("Form submitted for editing, id:", id);
                let formData = new FormData(this);
                let submitButton = $(this).find(':submit');
                submitButton.attr('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/auth/update') }}/" + id,
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
                                $('#userManagementEditModal').modal('hide');
                                getAllData();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        errorAlert();
                    }
                });
            });

            function resetModal() {
                $('#id').val('').removeClass('border-danger');
                $('.form-group').removeClass('has-error').removeClass('has-success');
                $('#id_position').val('');
                $('#eid_position').val('');
                $('#name').val('');
                $('#ename').val('');
                $('#email').val('');
                $('#eemail').val('');
                $('#password').val('12345678');
                $('#id_position-error').remove();
                $('#eid_position-error').remove();
                $('#name-error').remove();
                $('#ename-error').remove();
                $('#email-error').remove();
                $('#eemail-error').remove();
                $('#password-error').remove();
                
            }

            $('#userManagementModal , #userManagementEditModal').on('hidden.bs.modal', function() {
                resetModal();
                $('#reset-password-btn').prop(
                    'disabled', false);
            });

        });
    </script>
@endsection
