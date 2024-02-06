<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    @yield('tittle')
  </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/css/bootstrap.min.css')}}" >
  <!-- themefy CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/themefy_icon/themify-icons.css')}}">
  <!-- swiper slider CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/swiper_slider/css/swiper.min.css')}}">
  <!-- select2 CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/select2/css/select2.min.css')}}">
  <!-- select2 CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/niceselect/css/nice-select.css')}}">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/owl_carousel/css/owl.carousel.css')}}" >
  <!-- gijgo css -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/gijgo/gijgo.min.css')}}" >
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/font_awesome/css/all.min.css')}}" >
  <link rel="stylesheet" href="{{asset('static/auth/vendors/tagsinput/tagsinput.css')}}" >

  <!-- date picker -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/datepicker/date-picker.css')}}" >

  <!-- datatable CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/datatable/css/jquery.dataTables.min.css')}}" >
  <link rel="stylesheet" href="{{asset('static/auth/vendors/datatable/css/responsive.dataTables.min.css')}}" >
  <link rel="stylesheet" href="{{asset('static/auth/vendors/datatable/css/buttons.dataTables.min.css')}}" >
  <!-- text editor css -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/text_editor/summernote-bs4.css')}}" >
  <!-- morris css -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/morris/morris.css')}}">
  <!-- metarial icon css -->
  <link rel="stylesheet" href="{{asset('static/auth/vendors/material_icon/material-icons.css')}}" >

  <!-- menu css  -->
  <link rel="stylesheet" href="{{asset('static/auth/css/metisMenu.css')}}">
  <!-- style CSS -->
  <link rel="stylesheet" href="{{asset('static/auth/css/style.css')}}" >
  <link rel="stylesheet" href="{{asset('static/auth/css/colors/default.css')}}" id="colorSkinCSS">
  <link rel="stylesheet" href="{{asset('static/auth/css/base.css')}}">
  <link rel="stylesheet" href="{{asset('static/auth/css/login.css')}}">
</head>

<body class="crm_body_bg">
  <div class="container pt-5">
    <div class="row mt-5 d-flex justify-content-center">
      <div class="card_box box_shadow white_bg col-md-3 col-10 mt-5 p-0">
        <form class="form col-12 p-0" method="POST" action="#">
          <div class="card-header text-center white_box_tittle p-4">
            <h2 class="card-title title-up mb-0"> <i class="fas fa-graduation-cap"></i>@yield('header')</h2>
            <span><b>@yield('app_name')</b></span><br>
            <span>@yield('instance')</span>
          </div>
          <div class="card-body">
            <div class="input-group no-border mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Username" name="username">
            </div>

            <div class="input-group no-border">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-unlock"></i>
                </span>
              </div>
              <input id="password" type="password" placeholder="Password" class="form-control" name="password">
            </div>

            <div class="form-check mt-1 d-flex align-items-center">
              <small>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="show-password">
                  <span class="form-check-sign"></span>
                  Show Password
                </label>
              </small>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <button class="btn bg-secondary btn-round btn-lg" type="submit">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer class="text-center text-sm mt-5 text-muted">
    @yield('footer')
  </footer>
  <!-- footer  -->
  <!-- jquery slim -->
  <script src="{{asset('static/auth/js/jquery-3.4.1.min.js')}}"></script>
  <!-- popper js -->
  <script src="{{asset('static/auth/js/popper.min.js')}}"></script>
  <!-- bootstarp js -->
  <script src="{{asset('static/auth/js/bootstrap.min.js')}}"></script>
  <!-- sidebar menu  -->
  <script src="{{asset('static/auth/js/metisMenu.js')}}"></script>
  <!-- waypoints js -->
  <script src="{{asset('static/auth/vendors/count_up/jquery.waypoints.min.js')}}"></script>
  <!-- waypoints js -->
  <script src="{{asset('static/auth/vendors/chartlist/Chart.min.js')}}"></script>
  <!-- counterup js -->
  <script src="{{asset('static/auth/vendors/count_up/jquery.counterup.min.js')}}"></script>
  <!-- swiper slider js -->
  <script src="{{asset('static/auth/vendors/swiper_slider/js/swiper.min.js')}}"></script>
  <!-- nice select -->
  <script src="{{asset('static/auth/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
  <!-- owl carousel -->
  <script src="{{asset('static/auth/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
  <!-- gijgo css -->
  <script src="{{asset('static/auth/vendors/gijgo/gijgo.min.js')}}"></script>
  <!-- responsive table -->
  <script src="{{asset('static/auth/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/buttons.flash.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/jszip.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/pdfmake.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/vfs_fonts.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datatable/js/buttons.print.min.js')}}"></script>

  <!-- date picker  -->
  <script src="{{asset('static/auth/vendors/datepicker/datepicker.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datepicker/datepicker.en.js')}}"></script>
  <script src="{{asset('static/auth/vendors/datepicker/datepicker.custom.js')}}"></script>

  <script src="{{asset('static/auth/js/chart.min.js')}}"></script>
  <!-- progressbar js -->
  <script src="{{asset('static/auth/vendors/progressbar/jquery.barfiller.js')}}"></script>
  <!-- tag input -->
  <script src="{{asset('static/auth/vendors/tagsinput/tagsinput.js')}}"></script>
  <!-- text editor js -->
  <script src="{{asset('static/auth/vendors/text_editor/summernote-bs4.js')}}"></script>
  <script src="{{asset('static/auth/vendors/am_chart/amcharts.js')}}"></script>

  <script src="{{asset('static/auth/vendors/apex_chart/apexcharts.js')}}"></script>
  <script src="{{asset('static/auth/vendors/apex_chart/apex_realestate.js')}}"></script>
  <!-- <script src="static/auth/vendors/apex_chart/default.js"></script> -->

  <script src="{{asset('static/auth/vendors/chart_am/core.js')}}"></script>
  <script src="{{asset('static/auth/vendors/chart_am/charts.js')}}"></script>
  <script src="{{asset('static/auth/vendors/chart_am/animated.js')}}"></script>
  <script src="{{asset('static/auth/vendors/chart_am/kelly.js')}}"></script>
  <script src="{{asset('static/auth/vendors/chart_am/chart-custom.js')}}"></script>
  <!-- custom js -->
  <script src="{{asset('static/auth/js/custom.js')}}"></script>

  <script src="{{asset('static/auth/vendors/apex_chart/bar_active_1.js')}}"></script>
  <script src="{{asset('static/auth/vendors/apex_chart/apex_chart_list.js')}}"></script>
  <script src="{{asset('static/auth/vendors/sweetalert2/sweetalert2.all.js')}}"></script>
  <script src="{{asset('static/auth/js/login.js')}}"></script>
</body>

</html>