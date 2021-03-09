<?php

namespace App\Http\Controllers;

use App\Iterasi;
use App\PusatCluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TampilanDataController extends Controller
{
    public function table(){
        $max = PusatCluster::max('iterasi_ke');
        $iterasis = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->where('iterasi_ke',$max)->get();
        return view('admin/tampilan_data.table',compact('iterasis'));
    }

    public function grafik(){
        $max = PusatCluster::max('iterasi_ke');
        $datas = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke',$max)->groupBy('kelompok_cluster')->get();
        return view('admin/tampilan_data.grafik',compact('datas'));
    }

    public function peta(){
        $max = PusatCluster::max('iterasi_ke');
        $arrays = [
            'cluster_1' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','1')->where('tahun','2011')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            'cluster_2' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','2')->where('tahun','2011')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            'cluster_3' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','3')->where('tahun','2011')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
        ];
        // $arrays = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kelompok_cluster')->where('iterasi_ke',$max)->groupBy('data_gempa_id')->orderBy('kelompok_cluster','asc')->get();
        return view('admin/tampilan_data.peta',compact('arrays'));
    }
    
    public function getPeta(){
        if (isset($_GET['tahun'])) {
            Session::put('success','Menampilkan data pada tahun "'.$_GET['tahun'].'"');
            $max = PusatCluster::max('iterasi_ke');
            $tahun = $_GET['tahun'];
            $jumlah = count(Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->where('iterasi_ke',$max)->where('tahun',$_GET['tahun'])->get());
            Session::put('success','Data Berhasil Ditampilkan');
            $arrays = [
                'cluster_1' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','1')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_2' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','2')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_3' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','lokasi','tahun','kedalaman','kekuatan','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','3')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            ];
            return view('admin/tampilan_data.peta',compact('arrays','jumlah','tahun'));
        }
    }

    public function getGrafik(){
        if (isset($_GET['tahun'])) {
            Session::put('success','Menampilkan data pada tahun "'.$_GET['tahun'].'"');
            $max = PusatCluster::max('iterasi_ke');
            $datas = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke',$max)->where('tahun',$_GET['tahun'])->groupBy('kelompok_cluster')->get();
            $tahun = $_GET['tahun'];
            $jumlah = count(Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->where('iterasi_ke',$max)->where('tahun',$_GET['tahun'])->get());
            return view('admin/tampilan_data.grafik',compact('datas','jumlah','tahun'));
        }
    }
}
