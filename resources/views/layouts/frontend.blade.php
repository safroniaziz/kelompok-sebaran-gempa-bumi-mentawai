
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>eBusiness Bootstrap Template - Index</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/frontend/assets/img/favicon.png ') }}" rel="icon">
  <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon.png ') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900 " rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/frontend/assets/vendor/bootstrap/css/bootstrap.min.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/icofont/icofont.min.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/animate.css/animate.min.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/font-awesome/css/font-awesome.min.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/nivo-slider/css/nivo-slider.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css ') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/venobox/venobox.css ') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/frontend/assets/css/style.css ') }}" rel="stylesheet">
  <style>
    #chartdiv {
        width: 90%;
        height: 450px;
    }
    #chartdiv2 {
        width: 70%;
        height: 380px;
    }
    #chartdiv3 {
        width: 100%;
        height: 500px;
    }
</style>

  <!-- =======================================================
  * Template Name: eBusiness - v2.1.1
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">
            <img src="{{ asset('assets/images/logo.png') }}" alt=""> <span style="font-size: 15px;">CLustering Gempa Bumi</span>
        </a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Slider Section ======= -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('assets/images/seismograf.jpg') }}" alt="" title="#slider-direction-1" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Clustering Gempa Bumi</h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h1 class="title2">Dataset Gempa Bumi Mentawai 10 Tahun (Tahun 2010 - 2019)</h1>
                </div>
                <!-- layer 3 -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Tampilan Dalam Grafik</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @section('chart_data2')
                    chart.data = [
                        @foreach ($datas as $data)
                            {
                                "country": "Cluster {{ $data['kelompok_cluster'] }}",
                                "litres": {{ $data['jumlah'] }}
                            },
                            
                        @endforeach
                    ];
                    @endsection
                    <div id="chartdiv2"></div>
                </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            @section('chart_data')

                chart.data = [
                    @foreach ($datas as $data)
                        {
                            "country": "Cluster {{ $data['kelompok_cluster'] }}",
                            "visits": {{ $data['jumlah'] }}
                        },
                    @endforeach
                ];
            @endsection
            <div id="chartdiv"></div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->
    <!-- ======= Skills Section ======= -->
    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Tampilan Dalam Peta</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- single-well start-->
            <div class="col-md-12 col-sm-12col-xs-12">
              <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body table-responsive">
                    <form action="{{ route('frontend.peta') }}" method="GET">
                      {{ csrf_field() }} {{ method_field('GET') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Pilih Tahun</label>
                                    <select name="tahun" class="form-control" id="">
                                        <option disabled selected>-- pilih tahun --</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Tampilkan</i></button>
                            </div>
                        </div>
                    </form>
                    @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                      </div>
                    @endif
                    <div id="map" style="height: 700px; width:100%"></div>
                  </div>
              </div>
            </div>
            <!-- End col-->
          </div>
        </div>
      </div><!-- End About Section -->
      <!-- ======= Skills Section ======= -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>eBusiness</strong>. All Rights Reserved
              </p>
            </div>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
            -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/frontend/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/appear/jquery.appear.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/knob/jquery.knob.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/parallax/parallax.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/venobox/venobox.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/frontend/assets/js/main.js') }}"></script>
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  <script>
  
  am4core.ready(function() {

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("chartdiv", am4charts.XYChart);
  chart.scrollbarX = new am4core.Scrollbar();

  // Add data
  @yield('chart_data')

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "country";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "visits";
  series.dataFields.categoryX = "country";
  series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;

  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  var hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
  });

  // Cursor
  chart.cursor = new am4charts.XYCursor();

  }); // end am4core.ready()
  </script>

  
  <!-- Resources -->
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  
  <!-- Chart code -->
  <script>
  am4core.ready(function() {
  
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end
  
  // Create chart instance
  var chart = am4core.create("chartdiv2", am4charts.PieChart);
  
  // Add data
  @yield('chart_data2')
  
  // Add and configure Series
  var pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "litres";
  pieSeries.dataFields.category = "country";
  pieSeries.slices.template.stroke = am4core.color("#fff");
  pieSeries.slices.template.strokeOpacity = 1;
  
  // This creates initial animation
  pieSeries.hiddenState.properties.opacity = 1;
  pieSeries.hiddenState.properties.endAngle = -90;
  pieSeries.hiddenState.properties.startAngle = -90;
  
  chart.hiddenState.properties.radius = am4core.percent(0);
  
  
  }); // end am4core.ready()
  </script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNUmHx3Et1_3SI2gQOe23vG0olB5cAmkk"></script>
  <script type="text/javascript">
      var flightPath;
            var map;
      
      var markers = [
          <?php 
            if(isset($_GET['tahun'])){
              ?>
                <?php foreach ($arrays['cluster_1'] as $data): ?>
                    {
                
                    "lat": '<?php echo $data['latitude'] ?>',
                    "lng": '<?php echo $data['longitude']; ?>',
                    "description": '<?php echo 'Latitude :'.$data['latitude'].'<br>'.'<br>'.'Longitude :'.$data['longitude'] ?>',
                
                    "icon": "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"
                
                
                },
                <?php endforeach ?>
              <?php
            }
          ?>
      ];
  
      var markers2 = [
        <?php 
            if(isset($_GET['tahun'])){
              ?>
          <?php foreach ($arrays['cluster_2'] as $data): ?>
              {
          
              "lat": '<?php echo $data['latitude'] ?>',
              "lng": '<?php echo $data['longitude']; ?>',
              "description": '<?php echo 'Latitude :'.$data['latitude'].'<br>'.'<br>'.'Longitude :'.$data['longitude'] ?>',
          
              "icon": "{{ asset('assets/images/marker_1.jpeg') }}"
          
          
          },
          <?php endforeach ?>
          <?php
            }
          ?>
      ];
      var icon2 = {
          url: "{{ asset('assets/images/marker.png') }}", // url
          scaledSize: new google.maps.Size(20, 20), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
      };
      var markers3 = [
        <?php 
            if(isset($_GET['tahun'])){
              ?>
          <?php foreach ($arrays['cluster_3'] as $data): ?>
              {
          
              "lat": '<?php echo $data['latitude'] ?>',
              "lng": '<?php echo $data['longitude']; ?>',
              "description": '<?php echo 'Latitude :'.$data['latitude'].'<br>'.'<br>'.'Longitude :'.$data['longitude'] ?>',
          
              "icon": icon2
          
          
          },
          <?php endforeach ?>
          <?php
            }
          ?>
      ];
  
      window.onload = function () {
      LoadMap();
  }
  function LoadMap() {
      var mapOptions = {
          // center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
          // center: {lat: -3.7597956, lng: 102.2702553},
          zoom: 17,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var infoWindow = new google.maps.InfoWindow();
      var latlngbounds = new google.maps.LatLngBounds();
      var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      var legend = document.getElementById("legend");
      // legend.innerHTML = "";
      for (var i = 0; i < markers.length; i++) {
          var data = markers[i]
          var myLatlng = new google.maps.LatLng(data.lat, data.lng);
          var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: data.title,
              icon: data.icon
          });
       
  
          (function (marker, data) {
              google.maps.event.addListener(marker, "click", function (e) {
                  infoWindow.setContent("<div style = 'width:150px;height:80px'>" + data.description + "</div>");
                  infoWindow.open(map, marker);
              });
          })(marker, data);
          latlngbounds.extend(marker.position);
   
         
      }
      var bounds = new google.maps.LatLngBounds();
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);
  
      for (var i = 0; i < markers2.length; i++) {
          var data2 = markers2[i]
          var myLatlng2 = new google.maps.LatLng(data2.lat, data2.lng);
          var marker2 = new google.maps.Marker({
              position: myLatlng2,
              map: map,
              title: data2.title,
              icon: data2.icon
          });
       
  
          (function (marker2, data2) {
              google.maps.event.addListener(marker2, "click", function (e) {
                  infoWindow.setContent("<div style = 'width:150px;height:80px'>" + data2.description + "</div>");
                  infoWindow.open(map, marker2);
              });
          })(marker2, data2);
          latlngbounds.extend(marker2.position);
   
         
      }
      var bounds = new google.maps.LatLngBounds();
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);
  
      for (var i = 0; i < markers3.length; i++) {
          var data3 = markers3[i]
          var myLatlng3 = new google.maps.LatLng(data3.lat, data3.lng);
          var marker3 = new google.maps.Marker({
              position: myLatlng3,
              map: map,
              title: data3.title,
              icon: data3.icon
          });
       
  
          (function (marker3, data3) {
              google.maps.event.addListener(marker3, "click", function (e) {
                  infoWindow.setContent("<div style = 'width:150px;height:80px'>" + data3.description + "</div>");
                  infoWindow.open(map, marker3);
              });
          })(marker3, data3);
          latlngbounds.extend(marker3.position);
   
         
      }
      var bounds = new google.maps.LatLngBounds();
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);
  
      
      var jarak = [
        <?php 
            if(isset($_GET['tahun'])){
              ?>
          <?php foreach ($arrays['cluster_1'] as $data): ?>
              {
              "lat": parseFloat('<?php echo $data['latitude']; ?>'),
              "lng": parseFloat('<?php echo $data['longitude']; ?>'),
          },
          <?php endforeach ?>
          <?php
            }
          ?>
      ];
      var jarakPath = new google.maps.Polyline({
              path: jarak,
              geodesic: true,
              strokeColor: '#000080',
              strokeOpacity: 1.0,
              strokeWeight: 2
          });
      jarakPath.setMap(map);
  
      var jarak2 = [
        <?php 
            if(isset($_GET['tahun'])){
              ?>
          <?php foreach ($arrays['cluster_2'] as $data): ?>
              {
              "lat": parseFloat('<?php echo $data['latitude']; ?>'),
              "lng": parseFloat('<?php echo $data['longitude']; ?>'),
          },
          <?php endforeach ?>
          <?php
            }
          ?>
      ];
      var jarakPath2 = new google.maps.Polyline({
              path: jarak2,
              geodesic: true,
              strokeColor: 'red',
              strokeOpacity: 1.0,
              strokeWeight: 2
      });
      jarakPath2.setMap(map);
  
  
      var jarak3 = [
        <?php 
            if(isset($_GET['tahun'])){
              ?>
          <?php foreach ($arrays['cluster_3'] as $data): ?>
              {
              "lat": parseFloat('<?php echo $data['latitude']; ?>'),
              "lng": parseFloat('<?php echo $data['longitude']; ?>'),
          },
          <?php endforeach ?>
          <?php
            }
          ?>
      ];
      var jarakPath3 = new google.maps.Polyline({
              path: jarak3,
              geodesic: true,
              strokeColor: 'yellow',
              strokeOpacity: 1.0,
              strokeWeight: 2
      });
      jarakPath3.setMap(map);
  
  }
  
       
  </script>
</body>

</html>