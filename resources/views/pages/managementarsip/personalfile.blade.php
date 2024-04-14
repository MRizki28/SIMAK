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
                                <button class="btn btn-primary " data-toggle="modal" data-target="#fileModal">
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

    <script>
        $(document).ready(function() {
            user_name = localStorage.getItem('user_name')
            $('#user_name').html(user_name);

            function getFile() {
                let segments = window.location.pathname.split('/');
                console.log(segments)
                let idUser = segments[2];
                let idArsip = segments[3];
                $('#content').empty()

                localStorage.setItem('id_arsip', idArsip);
                $.ajax({
                    type: "GET",
                    url: "{{ url('v1/arsip/file/') }}/" + idUser + "/" + idArsip,
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
                                contentBody += '<div class=" px-3">'
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
            getFile();
        });
    </script>
@endsection
