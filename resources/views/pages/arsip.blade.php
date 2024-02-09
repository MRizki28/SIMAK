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
                                {{-- Form Sort --}}
                                <div class="input-group-append ml-2">
                                    <button class="btn dropdown-toggle" type="button" data-value="" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" id="filter-button"> <span
                                            id="filter-label">
                                        </span> <i class="fas fa-filter"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-value="asc" href="#">A - Z</a>
                                        <a class="dropdown-item" data-value="desc" href="#">Z - A</a>
                                        <a class="dropdown-item" data-value="latest" href="#">Terbaru</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" data-value="clear" href="#">Hapus
                                            Filter</a>
                                    </div>
                                </div>

                                {{-- Form Search --}}
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Cari..." id="form-search">
                                    <span class="input-icon-addon" id="search-button">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-5 col-12 p-0 d-flex justify-content-end align-items-center " style="margin-right: 20px;">
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
                            <table class=" table " id="dataTable">
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
                                    <tr>
                                        <td style="padding: 0 25px !important;">1</td>
                                        <td style="padding: 0 25px !important;">SR-001</td>
                                        <td style="padding: 0 25px !important;">Rizki</td>
                                        <td style="padding: 0 25px !important;">Surat Masuk</td>
                                        <td style="padding: 0 25px !important;">2024</td>
                                        <td style="padding: 0 25px !important;">File</td>
                                        <td style="padding: 0 25px !important;">2024-05-02</td>
                                        <td style="padding: 0 25px !important;">Private</td>
                                        <td style="padding: 0 25px !important;">Aksi</td>
                                    </tr>
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
                                    <input type="text" class="form-control  required" required
                                        name="name_type_document">
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
@endsection