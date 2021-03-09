@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data Gempa Bumi
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Data Gempa Bumi 10 Tahun</h3>
                    <div class="pull-right">
                        <a data-target="#tambahData" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Kedalaman</th>
                                <th>Kekuatan</th>
                                <th>Nama Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($data_gempa as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->tahun }}</td>
                                    <td>{{ $data->latitude }}</td>
                                    <td>{{ $data->longitude }}</td>
                                    <td>{{ $data->kedalaman }}</td>
                                    <td>{{ $data->kekuatan }}</td>
                                    <td>{{ $data->lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="POST" action="{{ route('admin.data.post') }}">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-home"></i>&nbsp;Tambah Data Gempa<b></b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama">Tahun</label>
                                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun') }}">
                                        @error('tahun')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Latitude</label>
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}">
                                        @error('latitude')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Longitude</label>
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}">
                                        @error('longitude')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Kedalaman</label>
                                        <input type="text" class="form-control @error('kedalaman') is-invalid @enderror" name="kedalaman" value="{{ old('kedalaman') }}">
                                        @error('kedalaman')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Kekuatan</label>
                                        <input type="text" class="form-control @error('kekuatan') is-invalid @enderror" name="kekuatan" value="{{ old('kekuatan') }}">
                                        @error('kekuatan')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Lokasi</label>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}">
                                        @error('lokasi')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Waktu Detail</label>
                                        <input type="date" class="form-control @error('waktu_detail') is-invalid @enderror" name="waktu_detail" value="{{ old('waktu_detail') }}">
                                        @error('waktu_detail')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
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