@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Grafik Hasil Clustering 
@endsection
@section('user-login','Administrator')
@section('sidebar-menu')
    @include('admin/sidebar')
@endsection
@push('styles')
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
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Pencarian Data</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.tampilan_data.get_grafik') }}" method="GET">
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
                    <?php
                        if (isset($_GET['tahun'])) {
                    ?>
                        <div class="alert alert-success alert-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="font-size:15px;">
                                        Keterangan Peta
                                    </h6>
                                    <p style="font-size:12px"> 
                                        1. Grafik menampilkan {{ $jumlah }} data gempa yang terjadi pada tahun {{ $tahun }} dalam 3 cluster<br>
                                        2. Cluster terbanyak ada pada cluster 3 dengan jumlah {{ $datas[0]['jumlah'] }} data <br>
                                        3. Cluster terbanyak kedua ada pada cluster 2 dengan jumlah {{ $datas[1]['jumlah'] }} data <br>
                                        4. Cluster terbanyak ketiga ada pada cluster 1 dengan jumlah {{ $datas[2]['jumlah'] }} data <br>
                                        </p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }
                        else{
                    ?>
                        <div class="alert alert-success alert-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="font-size:15px;">
                                        Keterangan Grafik
                                    </h6>
                                    <p style="font-size:12px"> 
                                    1. Grafik menampilkan 1356 data gempa yang terjadi dari tahun 2010-2009 dalam 3 cluster<br>
                                    2. Cluster terbanyak ada pada cluster 3 dengan jumlah 1126 data <br>
                                    3. Cluster terbanyak kedua ada pada cluster 2 dengan jumlah 150 data <br>
                                    4. Cluster terbanyak ketiga ada pada cluster 1 dengan jumlah 80 data <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Tampilan Diagram Batang</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <h6 class="text-center text-bold">Tampilan Dalam Diagram Batang</h6>
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Tampilan Diagram Lingkaran</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <h6 class="text-center text-bold">Tampilan Dalam Diagram Lingkaran</h6>
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

    </div>
@endsection
@push('scripts')
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
    
    
@endpush