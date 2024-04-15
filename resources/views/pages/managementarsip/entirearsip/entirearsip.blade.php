@extends('Layouts.Base')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="page-header">
                            <h4 class="page-title">Arsip <span id="nameUser"></span></h4>
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
                                    <a href="/personal-arsip">
                                        <span>tahun arsip</span>
                                    </a>
                                </li>
                                <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/personal-arsip/jenis-dokumen">
                                        <span>jenis dokumen</span>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <span style="font-size: 13px;" class="font-weight-bold">personal arsip</span>
                                </li>
                            </ul>
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
                                        <th style="padding: 0 25px !important;">Kode Arsip</th>
                                        <th style="padding: 0 25px !important;">Pembuat</th>
                                        <th style="padding: 0 25px !important;">Jenis Dokumen</th>
                                        <th style="padding: 0 25px !important;">Label</th>
                                        <th style="padding: 0 25px !important;">Tahun Arsip</th>
                                        <th style="padding: 0 25px !important;">File</th>
                                        <th style="padding: 0 25px !important;">Tanggal</th>
                                        <th style="padding: 0 25px !important;">Deskripsi</th>
                                        <th style="padding: 0 25px !important;">Type Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                                <tfoot id="dataNotFound">
                                    <tr class="text-center text-muted" id="template-empty-info">
                                        <td colspan="9" class=" ">
                                            <i class="fas fa-folder-open mr-1"></i> Data tidak ditemukan ...
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

    <script>
        $(document).ready(function() {
            let nameUser = localStorage.getItem('nameUser')
            $('#nameUser').text(nameUser);

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
                id_user = decryptToken(localStorage.getItem('id_entire_user'), key)
                id_year = decryptToken(localStorage.getItem('id_entire_year'), key)
                id_type_document = decryptToken(localStorage.getItem('id_entire_type_document'), key)
                console.log('id_year', id_year)
                console.log('id_type_document', id_type_document)
                let endpoint = url || ("/v1/arsip/entire?id_user=" + id_user + "&id_year=" +
                    id_year + "&id_type_document=" + id_type_document);

                let startDateParam = params.startDate || "";
                let endDateParam = params.endDate || "";

                if (params.search || startDateParam || endDateParam) {
                    endpoint += "&search=" + params.search + "&startDate=" + startDateParam + "&endDate=" +
                        endDateParam;
                }

                console.log(endpoint)

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
                        let idUser = decryptToken(Cookies.get('cookie_user'), key)
                        if (response.code == 200) {
                            $.each(response.data.data, function(item, value) {
                                let name_type_document = value.type_document
                                    .name_type_document;
                                let file_arsip = value.file_arsip;
                                let name = value.user.name;
                                let year = value.year.year
                                let id_arsip = value.id;
                                console.log(file_arsip)
                                $("#table tbody").empty();
                                tableBody += "<tr>";
                                tableBody += "<td>" + value.code_arsip + "</td>"
                                tableBody += "<td>" + name + "</td>"
                                tableBody += "<td>" + name_type_document +
                                    "</td>"
                                if (value.in_or_out_arsip == 'jenisLain') {
                                    tableBody += "<td>" + "Jenis Lain" +
                                        "</td>"
                                } else if (value.in_or_out_arsip == 'suratMasuk') {
                                    tableBody += "<td>" + "Surat Masuk" +
                                        "</td>"
                                } else if (value.in_or_out_arsip == 'suratKeluar') {
                                    tableBody += "<td>" + "Surat Keluar" +
                                        "</td>"
                                }
                                tableBody += "<td>" + year + "</td>"
                                tableBody += "<td><a href='/file/personal' data-id_arsip='" +
                                    id_arsip + "'><i class='fas fa-eye fa-xl'></i></a></td>";
                                tableBody += "<td>" + value.date_arsip + "</td>"
                                tableBody += "<td>" + value.description + "</td>"
                                tableBody += "<td>" + (value.is_private === 0 ?
                                    "<i class='fas fa-lock-open'></i>" :
                                    "<i class='fas fa-lock'></i>") + "</td>";
                                tableBody += "</tr>";

                                $("#table tbody").append(tableBody);
                                $("#dataNotFound").hide();
                                $("#data-total").text(response.data.total);

                                $("a[data-id_arsip]").off("click").on("click", function() {
                                    let id_arsip = encryptToken($(this).data("id_arsip"), key);
                                    localStorage.setItem("entire_id_arsip", id_arsip);
                                    localStorage.removeItem("user_name");
                                });
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

            $(window).on('storage', function(event) {
                protectedModificationSystem(event);
            });

        });
    </script>
@endsection
