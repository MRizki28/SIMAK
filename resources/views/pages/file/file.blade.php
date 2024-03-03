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
                    </div>
                    <div class="card-body">
                        <div class="row " id="content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function getFile() {
                if ($.fn.DataTable.isDataTable("#dataTable")) {
                    $("#dataTable").DataTable().destroy();
                }
                let dataTable = $("#dataTable").DataTable();
                let segments = window.location.pathname.split('/');
                console.log(segments)
                let idUser = segments[2];
                let idArsip = segments[3];
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/v1/arsip/file/') }}/" + idUser + "/" + idArsip,
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        let files = response.data;
                        let contentBody = "";
                        $.each(files, function(index, file) {
                            contentBody +=
                                `<a href="/uploads/arsip/${file.file_arsip}" class="d-flex flex-column mx-3 mt-4" style="color:#575962;" target="_blank">`;
                            if (file.file_arsip.toLowerCase().endsWith('.pdf')) {
                                contentBody +=
                                    '<i class="fas fa-file-pdf fa-2xl text-center mb-1" style="color:red;"></i>';
                            } else if (file.file_arsip.toLowerCase().endsWith('.docx') || file
                                .file_arsip.toLowerCase().endsWith('.doc')) {
                                contentBody +=
                                    '<i class="fas fa-file-word fa-2xl text-center mb-1"></i>';
                            } else if (file.file_arsip.toLowerCase().endsWith('.xlsx') || file
                                .file_arsip.toLowerCase().endsWith('.xls')) {
                                contentBody +=
                                    '<i class="fas fa-file-excel fa-2xl text-center mb-1"></i>';
                            } else {
                                contentBody +=
                                    '<i class="fas fa-file-archive fa-2xl text-center mb-1" style="color:#F2AC34;"></i>';
                            }
                            contentBody += '<span>' + file.file_arsip + '</span>';
                            contentBody += '</a>';
                        });
                        $('#content').append(contentBody)
                    }
                });
            }

            getFile();
        });
    </script>
@endsection
