<?php

namespace App\Http\Controllers;

use App\DataGempa;
use App\Iterasi;
use App\NilaiCost;
use App\PusatCluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
class ProsesClusteringController extends Controller
{
    public function prosesClustering(){
        $max = PusatCluster::max('iterasi_ke');
        $cluster1 = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')
                            ->select('latitude','longitude','tahun','kekuatan','kedalaman')
                            ->where('kelompok_cluster','1')
                            ->where('iterasi_ke','3')
                            ->orderBy('tahun')
                            ->get();
        $cluster2 = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')
                            ->select('latitude','longitude','tahun','kekuatan','kedalaman')
                            ->where('kelompok_cluster','2')
                            ->where('iterasi_ke','3')
                            ->orderBy('tahun')
                            ->get();
        $cluster3 = Iterasi::join('data_gempas','data_gempas.id','iterasis.data_gempa_id')
                            ->select('latitude','longitude','tahun','kekuatan','kedalaman')
                            ->where('kelompok_cluster','3')
                            ->where('iterasi_ke','3')
                            ->orderBy('tahun')
                            ->get();

        $datas = PusatCluster::join('data_gempas','data_gempas.id','pusat_clusters.data_gempa_id')->get();
        $max_cost = NilaiCost::max('iterasi_ke');
        $max_min_1 = $max-1;
        $cluster_satu = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','1')->where('iterasi_ke','3')->first();
        $cluster_dua = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','2')->where('iterasi_ke','3')->first();
        $cluster_tiga = Iterasi::select(DB::raw('count(kelompok_cluster) as jumlah'))->where('kelompok_cluster','3')->where('iterasi_ke','3')->first();
        $cost_awal = NilaiCost::first();
        $cost_sebelumnya = NilaiCost::select('nilai_cost')->orderBy('id','desc')->skip(1)->first();
        $cost_akhir = NilaiCost::select('nilai_cost')->where('iterasi_ke','3')->first();
        return view('admin/proses_cluster/pusat_cluster',compact('datas','max','max_cost','cluster_satu','cluster_dua','cluster_tiga','cost_awal','cost_sebelumnya','cost_akhir','cluster1','cluster2','cluster3'));
    }

    public function generateClustering(){
        $max = PusatCluster::max('iterasi_ke');
        $data_gempa = DataGempa::inRandomOrder()->select('id')->take(3)->get();
        $max_cluster = PusatCluster::max('iterasi_ke');
        for ($i=0; $i <count($data_gempa) ; $i++) { 
            if (empty($max_cluster)) {
                $post = new PusatCluster;
                $post->iterasi_ke = 1;
                $post->cluster_ke = $i+1;
                $post->data_gempa_id = $data_gempa[$i]->id;
                $post->save();
            }
            else{
                $post = new PusatCluster;
                $post->iterasi_ke = $max+1;
                $post->cluster_ke = $i+1;
                $post->data_gempa_id = $data_gempa[$i]->id;
                $post->save();
            }
        }

        $max2 = PusatCluster::max('iterasi_ke');
        $data_gempa_cluster = DataGempa::select('id','kedalaman','kekuatan')->get();
        $pusat_medoids_pertama = PusatCluster::join('data_gempas','data_gempas.id','pusat_clusters.data_gempa_id')
                        ->select('iterasi_ke','kedalaman','kekuatan')
                        ->where('cluster_ke','1')
                        ->where('iterasi_ke',$max2)
                        ->orderBy('iterasi_ke','desc')
                        ->first();
        $pusat_medoids_kedua = PusatCluster::join('data_gempas','data_gempas.id','pusat_clusters.data_gempa_id')
                        ->select('kedalaman','kekuatan')
                        ->where('cluster_ke','2')
                        ->where('iterasi_ke',$max2)
                        ->orderBy('iterasi_ke','desc')
                        ->first();
        $pusat_medoids_ketiga = PusatCluster::join('data_gempas','data_gempas.id','pusat_clusters.data_gempa_id')
                        ->select('kedalaman','kekuatan')
                        ->where('cluster_ke','3')
                        ->where('iterasi_ke',$max2)
                        ->orderBy('iterasi_ke','desc')
                        ->first();
        $array = [];
        for ($i=0; $i <count($data_gempa_cluster) ; $i++) { 
                $hasil_pertama = pow(($data_gempa_cluster[$i]->kedalaman - $pusat_medoids_pertama->kedalaman),2) + pow(($data_gempa_cluster[$i]->kekuatan - $pusat_medoids_pertama->kekuatan),2);
                $hasil_kedua = pow(($data_gempa_cluster[$i]->kedalaman - $pusat_medoids_kedua->kedalaman),2) + pow(($data_gempa_cluster[$i]->kekuatan - $pusat_medoids_kedua->kekuatan),2);
                $hasil_ketiga = pow(($data_gempa_cluster[$i]->kedalaman - $pusat_medoids_ketiga->kedalaman),2) + pow(($data_gempa_cluster[$i]->kekuatan - $pusat_medoids_ketiga->kekuatan),2);
                $array[] = [
                    'data_gempa_id' =>  $data_gempa_cluster[$i]->id,
                    'iterasi_ke'    =>  $pusat_medoids_pertama['iterasi_ke'],
                    'nilai_cluster_1'    =>  \sqrt($hasil_pertama),
                    'nilai_cluster_2'    =>  \sqrt($hasil_kedua),
                    'nilai_cluster_3'    =>  \sqrt($hasil_ketiga),
                ];
        }
        Iterasi::insert($array);

        $max3 = PusatCluster::max('iterasi_ke');
        $datas_min = Iterasi::select('id','nilai_cluster_1','nilai_cluster_2','nilai_cluster_3')->where('iterasi_ke',$max3)->get();
        for ($i=0; $i < count($datas_min); $i++) { 
            $a =   [
                $array[0] = $datas_min[$i]->nilai_cluster_1,
                $array[1] = $datas_min[$i]->nilai_cluster_2,
                $array[2] = $datas_min[$i]->nilai_cluster_3,
            ];
            Iterasi::where('id',$datas_min[$i]->id)->update([
                'nilai_min' =>  min($a),
            ]);
        }

        $data_kelompok = Iterasi::select('id','nilai_min')->where('iterasi_ke',$max3)->get();
        $array = [];
        for ($i=0; $i <count($data_kelompok) ; $i++) { 
            $data2 = Iterasi::select('id','nilai_cluster_1','nilai_cluster_2','nilai_cluster_3')->where('id',$data_kelompok[$i]->id)->get();
            for ($a=0; $a <count($data2) ; $a++) { 
                if ($data_kelompok[$i]->nilai_min == $data2[$a]->nilai_cluster_1) {
                    Iterasi::where('id',$data_kelompok[$i]->id)->update([
                        'kelompok_cluster'  =>  '1',
                    ]); 
                }
                elseif ($data_kelompok[$i]->nilai_min == $data2[$a]->nilai_cluster_2) {
                    Iterasi::where('id',$data_kelompok[$i]->id)->update([
                        'kelompok_cluster'  =>  '2',
                    ]); 
                }
                elseif ($data_kelompok[$i]->nilai_min == $data2[$a]->nilai_cluster_3) {
                    Iterasi::where('id',$data_kelompok[$i]->id)->update([
                        'kelompok_cluster'  =>  '3',
                    ]); 
                }
            }
        }

        $data_cost = Iterasi::select(DB::raw('SUM(nilai_min) as nilai_cost'))->where('iterasi_ke',$max3)->get();
        // return $data_cost;
        NilaiCost::create([
            'iterasi_ke'    =>  $max3,
            'nilai_cost'    =>  $data_cost[0]->nilai_cost,
        ]);

        return redirect()->route('admin.proses_clustering.proses_clustering');
    }
}
