@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title">File</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="d-flex flex-column mx-3 mt-4">
                                <i class="fas fa-file-archive fa-2xl text-center mb-1" ></i>
                                <span>Nama file.jpg</span>
                            </div>
                            <div class="d-flex flex-column mx-3 mt-4">
                                <i class="fas fa-file-archive fa-2xl text-center mb-1" ></i>
                                <span>Nama file.jpg</span>
                            </div>
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
                $.ajax({
                    type: "get",
                    url: "url",
                    data: "data",
                    dataType: "dataType",
                    success: function(response) {

                    }
                });
            }
        });
    </script>
@endsection
