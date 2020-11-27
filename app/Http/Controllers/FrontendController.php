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
        $iterasis = Iterasi::where('iterasi_ke','3')->first();
        $datas = Count(DataGempa::all());
        $costs = NilaiCost::where('iterasi_ke','3')->select('nilai_cost')->first();
        $max = PusatCluster::where('iterasi_ke','3')->first();
        $datas = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke','3')->groupBy('kelompok_cluster')->get();
        
        return view('layouts/frontend',compact('datas','iterasis','datas','costs','arrays'));
    }

    public function peta(){
        if (isset($_GET['tahun'])) {
            $iterasis = Iterasi::where('iterasi_ke','3')->first();
            $datas = Count(DataGempa::all());
            $costs = NilaiCost::where('iterasi_ke','3')->select('nilai_cost')->first();
            $max = PusatCluster::where('iterasi_ke','3')->first();
            $datas = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'),'kelompok_cluster')->where('iterasi_ke','3')->groupBy('kelompok_cluster')->get();
            Session::put('success','Menampilkan data pada tahun "'.$_GET['tahun'].'"');
            $arrays = [
                'cluster_1' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude')->where('iterasi_ke','3')->where('kelompok_cluster','1')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_2' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude')->where('iterasi_ke','3')->where('kelompok_cluster','2')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
                'cluster_3' =>  Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->select('latitude','longitude')->where('iterasi_ke','3')->where('kelompok_cluster','3')->where('tahun',$_GET['tahun'])->groupBy('data_gempas.id')->orderBy('latitude','desc')->get(),
            ];
            return view('layouts/frontend',compact('datas','iterasis','datas','costs','arrays'));
        }
    }
}
