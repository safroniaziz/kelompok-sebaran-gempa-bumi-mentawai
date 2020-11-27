<?php

namespace App\Http\Controllers;

use App\Iterasi;
use App\NilaiCost;
use App\PusatCluster;
use Illuminate\Http\Request;

class DataClusteringController extends Controller
{
    public function pusatCluster(){
        $pusat_clusters = PusatCluster::join('data_gempas','data_gempas.id','pusat_clusters.data_gempa_id')->get();
        return view('admin/data_clustering.pusat_cluster',compact('pusat_clusters'));
    }

    public function dataIterasi(){
        $iterasis = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')->get();
        return view('admin/data_clustering.iterasi',compact('iterasis'));
    }

    public function nilaiCost(){
        $nilai_costs = NilaiCost::get();
        return view('admin/data_clustering.nilai_cost',compact('nilai_costs'));
    }
}
