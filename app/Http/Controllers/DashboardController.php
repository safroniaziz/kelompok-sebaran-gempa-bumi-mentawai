<?php

namespace App\Http\Controllers;

use App\DataGempa;
use App\Iterasi;
use App\NilaiCost;
use App\PusatCluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $max = PusatCluster::max('iterasi_ke');
        $min = PusatCluster::min('iterasi_ke');
        $iterasis = Iterasi::where('iterasi_ke',$max)->select('iterasi_ke')->first();
        $datas = Count(DataGempa::all());
        $costs = NilaiCost::where('iterasi_ke',$max)->select('nilai_cost')->first();
        $cost_awal = NilaiCost::where('iterasi_ke',$min)->select('nilai_cost')->first();

        $cluster_satu = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','1')->where('iterasi_ke',$max)->first();
        $cluster_dua = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','2')->where('iterasi_ke',$max)->first();
        $cluster_tiga = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','3')->where('iterasi_ke',$max)->first();
        return view('admin/dashboard',compact('iterasis','datas','costs','cost_awal','cluster_satu','cluster_dua','cluster_tiga'));
    }
}
