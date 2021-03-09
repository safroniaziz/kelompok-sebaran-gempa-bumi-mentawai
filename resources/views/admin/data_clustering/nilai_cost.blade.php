@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data Nilai Cost Clustering
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Data Nilai Cost</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"></button>
                            <p>
                                <strong>Penjelasan :</strong>
                            </p>
                            <p>
                            1. Nilai Cost adalah nilai akhir dari jumlah seluruh nilai minimal yang didapatkan. <br> 
                            2. Nilai Cost awal yang di dapatkan pada studi kasus ini adalah 44307.38. <br> 
                            3. Nilai Cost akhir yang di dapatkan pada studi kasus ini adalah 44487.82. <br> 
                            
                            </p>
                    </div>
                    <table class="table table-bordered table-hover" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Iterasi Ke-</th>
                                <th>Nilai Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($nilai_costs as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->iterasi_ke }}</td>
                                    <td>{{ $data->nilai_cost }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush