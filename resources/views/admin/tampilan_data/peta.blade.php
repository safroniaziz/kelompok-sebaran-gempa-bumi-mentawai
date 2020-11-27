@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Peta Hasil Clustering
@endsection
@section('user-login','Administrator')
@section('sidebar-menu')
    @include('admin/sidebar')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Tampilan Dalam Bentuk Peta</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <form action="{{ route('admin.tampilan_data.get_peta') }}" method="GET">
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
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Tampilkan</button>
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
    </div>
    <td id="legend">
    </td>
@endsection
@push('scripts')
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
@endpush