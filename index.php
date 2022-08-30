<?php
// Require the connection file for the database 
require './php/connect.php';

$humidity = null;
$fires = null;
$faulty_lights = null;
$temp = null;

// // Query for the light intensity 
//     $sql = "SELECT lamp_number,  time_created FROM node";
//     $result = mysqli_query($connect, $sql);

//      $off_lamps= []; 
//      $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
//      $size= count($row);
//      $counter = 0;

//      foreach($row as $item){
//          if ($item["bulb_intensity"] < 10){
//              $counter+= 1;
//              array_push($off_lamps,$item["lamp_number"]);
             
//          }
//      } 

//Code to display the latest humidity value in the database 
  $sql = "SELECT humidity FROM street ORDER BY created_at DESC LIMIT 1";
  $result = mysqli_query($connect, $sql); 
  $humidity = mysqli_fetch_assoc($result)["humidity"];

//Code to display the latest temperature value in the database 

  $sql = "SELECT temperature FROM street ORDER BY created_at DESC LIMIT 1";
  $result = mysqli_query($connect, $sql); 
  $temp = mysqli_fetch_assoc($result)["temperature"];


//Code to display the latest fire state in the database 
  $sql = "SELECT fire FROM node";
  $result = mysqli_query($connect, $sql); 
  $fires = mysqli_fetch_assoc($result)["fire"];

//Code to display the latest lamp state value in the database 
  $sql = "SELECT lamp_state FROM node ORDER BY time_created DESC LIMIT 1";
  $result = mysqli_query($connect, $sql); 
  $lamp_state = mysqli_fetch_assoc($result)["lamp_state"];
  


 
//Code to display the distance value in the database 
$sql = "SELECT distance FROM node ORDER BY time_created DESC LIMIT 1";
$result = mysqli_query($connect, $sql); 
$distance = mysqli_fetch_assoc($result)["distance"];
  
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIGHT STREET</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <script src="plotly.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">

<!-- For the maps -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet-src.js"></script>
  <script src="https://cdn.rawgit.com/aparshin/leaflet-boundary-canvas/f00b4d35/src/BoundaryCanvas.js"></script>

    <!-- <div id="map1"></div> -->
    <style>
        #map {
            width: 780px;
            height: 90vh;  
            }
    </style>

</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
         
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">       
      
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index2.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> STREET EYE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ashesi Street
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>



           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Achimota
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            </ul>
          </li>
         
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
              Spintex Road
                <i class="fas fa-angle-left right"></i>
              </p>
            </a> 
            
              <li class="nav-item">
                
              </li>
              <li class="nav-item">
                
              </li> 
         
          </li>
          <li class="nav-item">
           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                
                <ul class="nav nav-treeview">
                  <li class="nav-item">                 
                    </a>
                  </li>
                </ul>
              </li>
              
            
              
              
            </ul>
          </li>
          <li class="nav-item">
            
            <ul class="nav nav-treeview">
            
            </ul>
          </li>
          
                
            
          </li>
      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-car"></i></span>
              <!-- <i class="fas fa-exclamation-triangle"></i> -->

              <div class="info-box-content">
                <span class="info-box-text">Distance</span>
                <span class="info-box-number">
                <?php echo $distance;?>cm
          
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-temperature-high"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Temperature</span>
                <span class="info-box-number"><?php echo $temp;?> &#x2103;</span> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cloud-sun-rain"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Humidity</span>
                <span class="info-box-number"><?php echo $humidity;  ?> %RH</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-fire"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fires</span>
                <span class="info-box-number"><?php echo $fires;  ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Power Graph</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Power vs Time</strong>
                    </p>

                    <div class="wrapper">

        <div id="chart"></div>
        <script>
          var cnt = 0;
          var time = new Date();
         function getNewDataValues(){
           fetch("http://localhost/capstone/php/fetch_data.php?energy_new=1")
                    .then((response) => {
                        if (response.status === 200) {
                            return response.json();
                        }
                      }).then((data) => {
                        bly.extendTraces('chart',{ 
                          y:[[data["energy_consumed"]]]                          
                        },[0]);
                       
                            cnt++;
                            if(cnt > 500) {
                                Plotly.relayout('chart',{
                                    xaxis: {
                                        range: [cnt-500,cnt]
                                    }
                                });
                            }
                          })
                          .catch((e)=>console.log(e));

          }
           function getData() {
                // return Math.random();
                fetch("http://localhost/capstone/php/fetch_data.php?energy=1")
                    .then((response) => {
                        if (response.status === 200) {
                            return response.json();
                        }
                    }).then((data) => {
                      console.log(data);
                    
                        const energy_array=[];
                        const time_array=[];
                        for(let row of data){               
                          energy_array.push(row["energy_consumed"]);
                          time_array.push(row["created_at"]);
                        }
                        
                        Plotly.plot('chart',[{
                            y:energy_array,
                            x:time_array,                            
                            name: 'Energy Consumed in Watts',
                            type:'line'
                            
                        }]);             
  
                       // setInterval(getData,15);

                    })
            } 
             getData();
            

            
           

           

          
        </script>
    </div>

                    
                    <!-- /.chart-responsive -->
             </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                 
                    <div class="progress-group">
                      

                    
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">                    
                  </div>
                  <div class="col-sm-3 col-6">                   
                  
                  </div>
                  <div class="col-sm-3 col-6">                   
                  
                  </div>
                  <div class="col-sm-3 col-6">
               
                  
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">MAP</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-1 flex-fill" style="overflow: hidden">
                    <!-- Map will be created here -->
                    <div id="map" style="height: 400px">
                    <script src="map.js"></script>
                     <div class="map"></div>
                    </div>
                  </div>          
                </div>
              </div>
              
            </div>
           
            

            

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">State of StreetLamps</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <!-- <th>ID</th> -->
                      <th>Street</th>
                      <th>Status</th>
                      <th>Assigned Officer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Ashesi Street</td>
                      
                      <!-- Let colours change according to data from lightbulb -->

                        <!-- Color of the class should change to reflect condition -->
                      <td><span id="change_colour" class="badge badge-success">ON</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">Ing Inkoom</div>
                       
                      </td>
                    </tr>
                   
                    <tr>
                      <td>Achimota</td>
                      <td><span class="badge badge-danger">OFF</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">Ing Ansog</div>
                      </td>
                    </tr>
                  
                    <tr>
                      <td>Spintex Road</td>
                      <td><span class="badge badge-success">ON</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20"> Ing Debra</div>
                      </td>
                    </tr>
                   
                  
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-road"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Street</span>
                <span class="info-box-number">University Avenue</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-hashtag"></i></span>
              

              <div class="info-box-content">
                <span class="info-box-text">No. of Streetlights</span>
                <span class="info-box-number">5</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-map-marker"></i></span>
              

              <div class="info-box-content">
                <span class="info-box-text">Co-ordinates</span>
                <span class="info-box-number">[5.758773, -0.221253]</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fas fa-traffic-light"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Working Lights </span>
                <span class="info-box-number">4</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <!-- <canvas id="pieChart" height="150"></canvas> -->
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    
                  </li>
                  <li class="nav-item">
                   
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->

           

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong> <a href="https://www.linkedin.com/in/esther-mensah-673703181/">Esther Dzifa Mensah - Undergraduate Capstone project </a>.</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>

<!-- Custom js -->
<script src="js/index.js"></script>
</body>
</html>
