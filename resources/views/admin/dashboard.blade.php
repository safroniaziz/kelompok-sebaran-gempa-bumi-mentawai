@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
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
    </style>
@endpush
@section('content')
    <div class="callout callout-info ">
        <h4>SELAMAT DATANG!</h4>
        <p>
            SISTEM INFORMASI PEMETAAN KELOMPOK SEBARAN TITIK GEMPA BUMI MENTAWAI DENGAN METODE K-MEDOIDS CLUSTERING 

            <br>
            <b><i>Catatan:</i></b> Untuk keamanan, jangan lupa keluar setelah menggunakan aplikasi
        </p>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $datas }}</h3>

                    <p>Jumlah Data</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $iterasis->iterasi_ke }}</h3>

                    <p>Jumlah Iterasi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3>{{ number_format($cost_awal->nilai_cost) }}</h3>

                    <p>Nilai Cost Awal</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                    <div class="inner">
                    <h3>{{ number_format($costs->nilai_cost) }}</h3>

                    <p>Nilai Cost Terakhir</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box" >
                <span class="info-box-icon bg-blue"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Cluster Satu</span>
                <span class="info-box-number">
                    {{ $cluster_satu['jumlah'] }} <a style="font-weight: 500">Data</a>
                </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box" >
                <span class="info-box-icon bg-green"><i class="fa fa-list-alt"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Cluster Dua</span>
                <span class="info-box-number">
                    {{ $cluster_dua['jumlah'] }} <a style="font-weight: 500">Data</a>
                </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box" >
                <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Cluster Tiga</span>
                <span class="info-box-number">
                    {{ $cluster_tiga['jumlah'] }} <a style="font-weight: 500">Data</a>
                </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box" >
                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Jumlah Tahun</span>
                <span class="info-box-number">
                    10 <a style="font-weight: 500">Tahun</a>
                </span>
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