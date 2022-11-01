<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('public/backend/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/datatable.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/dataTables.bootstrap.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/skins/_all-skins.min.css')}}">
  <link rel="icon" href="{{asset('public/frontend/images/logofm.png')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin.blank')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <img src="{{asset('public/frontend/images/foneemobilelogo_final.png')}}" alt="" height="40px"/>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('public/uploads/product/' .Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('public/uploads/product/' .Auth::user()->avatar)}}" class="user-image" alt="User Image">
              <span class="hidden-xs">
                {{-- @php
                    $name = Auth::user()->email;
                    if($name){
                        echo $name;
                    }
                @endphp --}}
                {{Auth::user()->email}}
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('public/uploads/product/' .Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                <p>
                  {{Auth::user()->name}}
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="{{route('admin.profile')}}"><i class="fa fa-user"></i> Profile</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                  </div>
                  
                </div>
                <!-- /.row -->
              </li>
              
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="{{asset('public/uploads/product/' .Auth::user()->avatar)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            {{Auth::user()->name}}
            </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{route('admin.dashboard')}}">
            <i class="fa fa-bar-chart"></i> <span>Dashboard Admin</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.dashboard.revenue')}}">
            <i class="fa fa-money"></i> <span>Doanh thu</span>
          </a>
        </li>
        <li class="">
          <a href="{{route('admin.brand.index')}}">
            <i class="fa fa-free-code-camp" ></i> <span>Thương hiệu</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.brand.add')}}"><i class="fa fa-plus"></i> Thêm thương hiệu </a></li>
            <li><a href="{{route('admin.brand.index')}}"><i class="fa fa-tag"></i> Danh sách thương hiệu</a></li>
          </ul>
        </li>
        <li class="">
          <a href="{{route('admin.blog.index')}}">
            <i class="fa fa-newspaper-o" ></i> <span>Bài viết</span>
          </a>
        </li>
        <li class="">
          <a href="{{route('admin.product.index')}}">
            <i class="fa fa-cart-plus" ></i> <span>Sản phẩm</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.product.add')}}"><i class="fa fa-plus"></i> Thêm sản phẩm</a></li>
            <li><a href="{{route('admin.product.index')}}"><i class="fa fa-tag"></i> Danh sách sản phẩm</a></li>
          </ul>
        </li>
        <li>
          <a href="{{route('admin.order.index')}}">
            <i class="fa fa-shopping-bag"></i> <span>Đơn hàng</span>
            
          </a>
          
        </li>
        <li>
          <a href="{{route('admin.customer.index')}}">
            <i class="fa fa-users"></i> <span>Khách hàng</span>
            
          </a>
        </li>
        <li>
          <a href="{{route('admin.user.index')}}">
            <i class="fa fa-user-secret"></i> <span>Phân quyền</span>
            
          </a>
        </li>
        
        
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('admin_header')
 
      
      <?php
            $message = Session::get('message');
            if($message){
            ?> 
              <div class="alert alert-success alert-dismissible"  style="right: 14px;position: absolute;margin-top: -39px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                 {{ $message }}
                 {{Session::put('message', null)}}
              </div>
            
            <?php
            }
            $danger = Session::get('danger');
            if($danger){
            ?> 
              <div class="alert alert-danger alert-dismissible"  style="right: 14px;position: absolute;margin-top: -39px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                 {{ $danger }}
              </div>
            
            <?php
            }         
        ?>
    </section>
    
    <!-- Main content -->
    <section class="content">
       @yield('admin_content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  // $(function (e){
  //   $("#select_all").Click(function(){
  //     $(".checkbox").prop('checked', $(this).prop('checked'));
  //   });
  // });
  var select_all = document.getElementById("select_all"); //select all checkbox
        var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

        //select all checkboxes
        select_all.addEventListener("change", function (e) {
            for (i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = select_all.checked;
            }
        });


        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function (e) { //".checkbox" change
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if (this.checked == false) {
                    select_all.checked = false;
                }
                //check "select all" if all checkbox items are checked
                if (document.querySelectorAll('.checkbox:checked').length == checkboxes.length) {
                    select_all.checked = true;
                }
            });
        }
        
        

</script>
<script src="{{asset('public/backend/dist/js/backend.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function () {
   
  window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove(); 
      });
  }, 3000);
   
  });
  </script>
  <script>
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img style="width:150px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#gallery-photo-add').on('change', function() {
      $("#remove").remove();
        imagesPreview(this, 'div.preview-img');
    });
    $('#gallery-photo-add-one').on('change', function() {
      $("#remove-one").remove();
        imagesPreview(this, 'div.preview-img-one');
    });
});
</script>
<!-- jQuery 3 -->

<script src="{{asset('public/backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('public/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/backend/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>
<script src="{{asset('public/backend/dist/js/datatable.js')}}"></script>
{{-- ckeditor --}}
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
  $(function(){
    $('.revenuebymonth').change(function(){
      $("#revenueby").submit();
    });
  });
</script>
<script>
  let listday = $("#container2").attr("data-list-day");
  listday = JSON.parse(listday);
  let revenueday = $("#container2").attr("data-money");
  revenueday = JSON.parse(revenueday);
  let revenuedaydefault = $("#container2").attr("data-money-default");
  revenuedaydefault = JSON.parse(revenuedaydefault);
  // console.log(revenueday);
  Highcharts.chart('container2', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Doanh thu FoneeMobile tháng này'
    },
    xAxis: {
        categories: listday
    },
    yAxis: {
        title: {
            text: 'Doanh thu VND'
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Giao dịch hoàn tất',
        marker: {
            symbol: 'square'
        },
        data: revenueday
       

    },
      {
          name: 'Đã tiếp nhận',
          marker: {
              symbol: 'circle'
          },
          data: revenuedaydefault
        

      }
    ]
});
</script>
<script>
  let orderstatus = $("#container3").attr("data-order-status");
  orderstatus = JSON.parse(orderstatus);
  Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Thống kê trạng thái đơn hàng'
    },
    tooltip: {
        pointFormat: '<b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        colorByPoint: true,
        data: orderstatus
    }]
});
</script>
<script>
  
  $(document).ready( function () {
    $('#myTableProduct').DataTable();
  });
</script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  
</script>
<script>
  CKEDITOR.replace('ckeditor1', options);
  CKEDITOR.replace('ckeditor2', options);
  CKEDITOR.replace('ckeditor3', options);
</script>
{{-- <script>
  CKEDITOR.replace( 'ckeditor1', {
        filebrowserBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
    CKEDITOR.replace( 'ckeditor2', {
        filebrowserBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/backend/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
</script> --}}
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  });
</script>

</body>
</html>
