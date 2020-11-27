@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Table Hasil Clustering
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Tampilan Dalam Bentuk Tabel</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kedalaman</th>
                                <th>Kekuatan</th>
                                <th>Nilai Cluster 1</th>
                                <th>Nilai Cluster 2</th>
                                <th>Nilai Cluster 3</th>
                                <th>Nilai Min</th>
                                <th>Kelompok Cluster</th>
                                <th>Iterasi Ke-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($iterasis as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kedalaman }}</td>
                                    <td>{{ $data->kekuatan }}</td>
                                    <td>{{ $data->nilai_cluster_1 }}</td>
                                    <td>{{ $data->nilai_cluster_2 }}</td>
                                    <td>{{ $data->nilai_cluster_3 }}</td>
                                    <td>{{ $data->nilai_min }}</td>
                                    <td>{{ $data->kelompok_cluster }}</td>
                                    <td>{{ $data->iterasi_ke }}</td>
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