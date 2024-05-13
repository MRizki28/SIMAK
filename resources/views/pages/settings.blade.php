@extends('Layouts.Base')
@section('content')
    <style>
        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
    <div class="p-3 mt-3">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="account-settings">
                                        <div class="user-profile">
                                            <div class="user-avatar">
                                                <img src="{{ asset('profile-anonym.jpeg') }}" alt="User">
                                            </div>
                                            <h5 class="user-name" id="name"></h5>
                                            <h6 class="user-email" id="email"></h6>
                                        </div>
                                        <div class="about">
                                            <p>Silahkan ganti password anda</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h2 class="mb-2 text-primary">Setting</h2>
                                        </div>
                                        <form id="formSetting" class="w-100">
                                            @csrf
                                            <div class="col-md-6">
                                                <div class="form-group form-show-validation">
                                                    <label for="password_old">Password Lama</label>
                                                    <input type="password" class="form-control" name="password_old"
                                                        id="password_old" placeholder="Input here">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-show-validation">
                                                    <label for="password">Password Baru</label>
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Input here">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-show-validation">
                                                    <label for="password_confirmation">Konfirmasi password</label>
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        placeholder="Input here">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mr-5 mt-5">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-outline-primary">Update
                                                        Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function validationSetting() {
                $('#formSetting').validate({
                    rules: {
                        password_old: {
                            required: true
                        },
                        password: {
                            required: true
                        },
                        password_confirmation: {
                            required: true
                        },
                    },
                    messages: {
                        password_old: {
                            required: "Field ini wajib diisi"
                        },
                        password: {
                            required: "Field ini wajib diisi"
                        },
                        password_confirmation: {
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

            validationSetting()

            $('#formSetting').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this)
                let submitButton = $(this).find(':submit')

                submitButton.attr('disabled', true)
                $.ajax({
                    type: "POST",
                    url: "{{ url('v1/auth/setting') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        submitButton.attr('disabled', false)
                        if (response.message && response
                            .message
                            .includes('Old password is wrong')) {
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Password Lama salah!',
                                icon: 'warning',
                                showConfirmButton: true
                            });
                        }else if (response.errors && response.errors.password && response
                            .errors
                            .password
                            .includes('The password field confirmation does not match.')) {
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Pastikan password konfirmasi sama !',
                                icon: 'warning',
                                showConfirmButton: true
                            });
                        } else if (response.message == 'Check your validation') {
                            warningAlert();
                        } else if (response.code == 400) {
                            errorAlert();
                        } else {
                            successSettingPasswordAlert().then(function() {
                                location.reload()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitButton.attr('disabled', false);
                        errorAlert();
                    }
                });
            })
        });
    </script>
@endsection
