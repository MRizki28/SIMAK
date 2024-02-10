	<!--   Core JS Files   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{asset('static/js/core/popper.min.js')}}"></script>
	<script src="{{asset('static/js/core/bootstrap.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/chart.js/chart.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/chart-circle/circles.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('static/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>
	<script src="{{asset('static/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{asset('static/js/atlantis.min.js')}}"></script>
	<script src="{{asset('static/js/setting-demo.js')}}"></script>
	<script src="{{asset('static/js/setting-demo2.js')}}"></script>
	<script src="{{asset('static/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('static/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('static/helper/helper.js') }}"></script>

	{{-- Jquery Validate --}}
	<script src="{{asset('static/js/plugin/jquery-validate/jquery.form.js')}}"></script>
	<script src="{{asset('static/js/plugin/jquery-validate/jquery.validate.js')}}"></script>

	{{-- Numeral --}}
	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

	{{-- SweetAlert --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	{{-- Data tables --}}
	<script src="{{ asset('static/js/plugin/datatables/datatables.min.js') }}"></script>

	{{-- Moment --}}
	<script src="{{ asset('static/js/plugin/moment.js') }}"></script>

	{{-- DateRangePicker --}}
	<script src="{{ asset('static/js/plugin/dateRangePicker/dateRangePicker.js') }}"></script>

	{{-- Font --}}
	<script src="{{ asset('static/js/plugin/webfont/webfont.min.js') }}"></script>

	<script>
		WebFont.load({
				google: {
					"families": ["Lato:300,400,700,900"]
				},
				custom: {
					"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
					"simple-line-icons"
				],
				urls: ["{{asset('static/css/fonts.css')}}"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

    {{-- logout --}}
    <script>
        const urlLogout = 'v1/logout'
        $(document).ready(function() {
            $('#iconLogout').click(function(e) {
                Swal.fire({
                    title: 'Yakin ingin Logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    resolveButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.preventDefault();
                        $.ajax({
                            url: `{{ url('${urlLogout}') }}`,
                            method: 'POST',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response);
                                window.location.href = '/login';
                            },
                            error: function(xhr, status, error) {
                                alert('Error: Failed to logout. Please try again.');
                            }
                        });
                    }
                });
            });
        });
    </script>
    {{-- avatar sidebar user --}}
    {{-- <script>
        $(document).ready(function(){

            function setAvatarSidebar(name) {
                let avatarElement = $('#avatarUsersSidebar');
                let initials = getInitials(name);

                avatarElement.css({
                    'background-color': '#F0AB48',
                    'color': '#ffffff',
                    'font-size': '21.6px',
                    'line-height': '25.92px',
                    'text-align': 'center',
                    'display': 'flex',
                    'align-items': 'center',
                    'justify-content': 'center',
                });

                avatarElement.text(initials);
            }
            // set initials name users
            function getInitials(name) {
                return name.charAt(0).toUpperCase();
            }
            // get data
            function fetchDataAndUpdate() {
                $.ajax({
                    url: '/v1/users-settings',
                    method: 'GET',
                    success: function (response) {
                        let nameUser = response.data.name;
                        $('#nameUser').text(response.data.name);
                        setAvatarSidebar(nameUser);
                    },
                    error: function (error) {
                        console.error('Error fetching user data:', error);
                    }
                });
            }
            fetchDataAndUpdate();
        })
    </script> --}}


