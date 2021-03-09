<?php

namespace App\Http\Controllers;

use App\DataGempa;
use App\Iterasi;
use App\NilaiCost;
use App\PusatCluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index(){
        $max = PusatCluster::max('iterasi_ke');
        $iterasis = Iterasi::where('iterasi_ke',$max)->first();
        $datas = Count(DataGempa::all());
        $costs = NilaiCost::where('iterasi_ke',$max)->select('nilai_cost')->first();
        $datas = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke',$max)->groupBy('kelompok_cluster')->get();
        
        return view('layouts/frontend',compact('datas','iterasis','datas','costs','arrays'));
    }

    public function peta(){
            $max = PusatCluster::max('iterasi_ke');
            $iterasis = Iterasi::where('iterasi_ke',$max)->first();
            $datas = Count(DataGempa::all());
            $costs = NilaiCost::where('iterasi_ke',$max)->select('nilai_cost')->first();
            $datas = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke',$max)->groupBy('kelompok_cluster')->get();
            Session::put('success','Pilih tahun yang akan ditampilkan');
            $arrays = [
                'cluster_1' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','1')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_2' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','2')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_3' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','3')->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            ];
            return view('layouts/frontend',compact('datas','iterasis','datas','costs','arrays'));
    }

    public function getPeta(){
        if (isset($_GET['tahun'])) {
            $max = PusatCluster::max('iterasi_ke');
            $iterasis = Iterasi::where('iterasi_ke',$max)->first();
            $costs = NilaiCost::where('iterasi_ke',$max)->select('nilai_cost')->first();
            $datas = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke',$max)->where('tahun',$_GET['tahun'])->groupBy('kelompok_cluster')->get();
            $tahun = $_GET['tahun'];
            $jumlah = count(Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->where('iterasi_ke',$max)->where('tahun',$_GET['tahun'])->get());
            Session::put('success','Data Berhasil Ditampilkan');
            $arrays = [
                'cluster_1' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','1')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_2' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','2')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_3' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude','kekuatan','kedalaman','lokasi','waktu_detail')->where('iterasi_ke',$max)->where('kelompok_cluster','3')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            ];
            return view('layouts/frontend',compact('datas','iterasis','datas','costs','arrays','tahun','jumlah'));
        }
    }
}
