@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">File</h4>
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
                    <span>File</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex">
                            <div class="d-flex align-items-center" style="color: #777;">
                                <h3 id="user_name"></h3>
                            </div>
                            <div class="ml-auto">
                                <button class="btn btn-primary " id="button-tambah" data-toggle="modal"
                                    data-target="#fileModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-2" id="content">

                        </div>
                        <div id="notFound">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal file --}}
    <div class="modal fade " id="fileModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 550px; top:118px;">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-body">
                        <div class="header">
                            <span style="font-size: 20px;" id="modal-title">Tambah File</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form mt-4">
                            <form action="" id="formTambah">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div id="sja" class="form-group form-show-validation">
                                    <label for="file_arsip">File</label>
                                    <input type="file" class="form-control  required" required name="file_arsip[]"
                                        id="file_arsip" multiple>
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

            let url;
            if (localStorage.getItem('entire_id_arsip')) {
                let idEntireArsip = decryptToken(localStorage.getItem('entire_id_arsip'), key)
                let idEntireUser = decryptToken(localStorage.getItem('id_entire_user'), key)
                console.log(idEntireUser, 'entire user')
                url = "{{ url('v1/arsip/file?id_arsip=') }}" + idEntireArsip + "&id_user=" + idEntireUser;
                let nameUser = localStorage.getItem('nameUser')
                $('#user_name').html(nameUser);
                $('#button-tambah').hide();
            } else {
                let idArsip = decryptToken(localStorage.getItem('personal_id_arsip'), key)
                let idUser = decryptToken(Cookies.get('cookie_user'), key)
                let user_name = localStorage.getItem('user_name')
                $('#user_name').html(user_name);
                url = "{{ url('v1/arsip/file?id_arsip=') }}" + idArsip + "&id_user=" + idUser;
            }

            console.log(url)

            function getFile() {
                $('#content').empty()
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        if (response.data.length === 0) {
                            $('#notFound').html(
                                '<div class="row p-2 d-flex justify-content-center" id="content"><div class="text-center d-flex flex-column-reverse "><span>Tidak ada file</span><i class="fas fa-ban"></i></div></div>'
                            );
                        } else {
                            let files = response.data;
                            let contentBody = "";
                            $.each(files, function(index, file) {
                                contentBody += '<div class="text-right  px-3">'
                                if (localStorage.getItem('entire_id_arsip')) {
                                    contentBody += '<a href="' + file.id + '" data-id="' + file
                                        .id +
                                        '" class="delete-confirm" style="display: none;"><i class="fas fa-times"></i></a>';
                                } else {
                                    contentBody += '<a href="' + file.id + '" data-id="' + file
                                        .id +
                                        '" class="delete-confirm text-danger"><i class="fas fa-times"></i></a>';
                                }
                                contentBody +=
                                    `<a href="/uploads/arsip/${file.file_arsip}" class="d-flex flex-column mx-3 mt-4" style="color:#575962;" target="_blank">`;
                                if (file.file_arsip.toLowerCase().endsWith('.pdf')) {
                                    contentBody +=
                                        '<i class="fas fa-file-pdf fa-2xl text-center mb-1" style="color:red;"></i>';
                                } else if (file.file_arsip.toLowerCase().endsWith('.docx') ||
                                    file
                                    .file_arsip.toLowerCase().endsWith('.doc')) {
                                    contentBody +=
                                        '<i class="fas fa-file-word fa-2xl text-center mb-1" style="color:#1269DB;"></i>';
                                } else if (file.file_arsip.toLowerCase().endsWith('.xlsx') ||
                                    file
                                    .file_arsip.toLowerCase().endsWith('.xls')) {
                                    contentBody +=
                                        '<i class="fas fa-file-excel fa-2xl text-center mb-1" style="color:green;"></i>';
                                } else {
                                    contentBody +=
                                        '<i class="fas fa-file-archive fa-2xl text-center mb-1" style="color:#F2AC34;"></i>';
                                }
                                contentBody += '<span class="nameFile">' + file.file_arsip +
                                    '</span>';
                                contentBody += '</a>';
                                contentBody += '</div>';
                            });
                            $('#notFound').empty();
                            $('#content').append(contentBody);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status === 404) {
                            $('#notFound').html(
                                '<div class="row p-2 justify-content-center" id="content"><div class="text-center d-flex flex-column-reverse "><span>Tidak ada file</span><i class="fas fa-ban"></i></div></div>'
                            );
                        }
                    }
                });
            }

            $(window).on('storage', function(event) {
                protectedModificationSystem(event);
            });


            function validationAddFile() {
                $('#formTambah').validate({
                    rules: {
                        "file_arsip[]": {
                            required: true,
                            extension: "docx|pdf|xls|xlsx|csv|jpg|jpeg|png"
                        }
                    },
                    messages: {
                        "file_arsip[]": {
                            required: "Field ini wajib diisi",
                            extension: "Format hanya png, jpg, jpeg, pdf, docx, doc, xlsx, xls, csv"
                        }
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

            validationAddFile();

            $("#formTambah").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let submitButton = $(this).find(":submit");

                let id_arsip = decryptToken(localStorage.getItem('personal_id_arsip'), key)
                formData.append('id_arsip', id_arsip)
                submitButton.attr("disabled", true);

                $.ajax({
                    type: "POST",
                    url: "{{ url('v1/arsip/add/file') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        submitButton.attr('disabled', false);
                        if (response.error) {
                            Object.keys(response.error).forEach(key => {
                                if (key.startsWith('file_arsip.') && response.error[key]
                                    .includes('Format file tidak sesuai')) {
                                    warningExtentionAlert();
                                    $('.form-group').removeClass('has-error')
                                        .removeClass('has-success').addClass(
                                            'has-error');
                                    $('#file_arsip-error').text(
                                        'Format hanya png, jpg, jpeg, pdf, docx, doc, xlsx, xls, csv'
                                        );
                                    return;
                                }
                            });
                        } else if (response.message == 'Check your validation') {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successAlert().then(function() {
                                $('#fileModal').modal('hide');
                                getFile()
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
                console.log('delet', id)
                deleteAlert().then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('v1/arsip/delete/file') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                console.log(response)
                                if (response.code === 400) {
                                    failedDeleteDataAlert();
                                } else {
                                    successDeleteAlert().then(function() {
                                        getFile();
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

            getFile();

            $('#fileModal').on('hidden.bs.modal', function() {
                $('#file_arsip').val('');
                $('.form-group').removeClass('has-error').removeClass('has-success');
                $('#file_arsip-error').remove();
            });
        });
    </script>
@endsection
