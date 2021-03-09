@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data Pusat Cluster Clustering
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Data Pusat Cluster</h3>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"></button>
                            <p>
                                <strong>Penjelasan :</strong>
                            </p>
                            <p>
                            1. Pusat Cluster (centroid) adalah bentuk objek dari seluruh titik dalam objek yang digunakan sebagai pusat data. <br> 
                            2. Pusat Cluster dipilih secara acak sebanyak jumlah cluster (k) yang akan dikelompokan, dalam hal ini adalah 3 cluster, sehingga mengambil secara acak sebanyak 3 pusat medoid <br>
                            3. Pusat Cluster akan dilakukan minimal sebanyak 2 kali <br>
                            4. Jika Nilai Cost dari Pusat CLuster baru < Pusat CLuster lama, maka akan dipilih pusat cluster (centroid) baru untuk menggantikan pusat cluster lama <br>
                            5. Pemilihan pusat cluster akan dihentikan ketika Nilai cost baru > dari nilai cost awal
                            </p>
                    </div>
                    <table class="table table-bordered table-hover" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Iterasi Ke-</th>
                                <th>Cluster Ke-</th>
                                <th>Kedalaman</th>
                                <th>Kekuatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($pusat_clusters as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->iterasi_ke }}</td>
                                    <td>{{ $data->cluster_ke }}</td>
                                    <td>{{ $data->kedalaman }}</td>
                                    <td>{{ $data->kekuatan }}</td>
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