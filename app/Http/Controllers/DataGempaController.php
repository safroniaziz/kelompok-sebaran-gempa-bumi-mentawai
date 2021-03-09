<?php

namespace App\Http\Controllers;

use App\DataGempa;
use Illuminate\Http\Request;

class DataGempaController extends Controller
{
    public function index(){
        $data_gempa = DataGempa::get();
        return view('admin/data_gempa.index',compact('data_gempa'));
    }

    public function post(Request $request){
        $data = new DataGempa;
        $data->tahun = $request->tahun;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->kedalaman = $request->kedalaman;
        $data->kekuatan = $request->kekuatan;
        $data->lokasi = $request->lokasi;
        $data->waktu_detail = $request->waktu_detail;
        $data->save();

        return redirect()->route('admin.data_gempa')->with(['success'   =>  'Data Gempa Berhasil Ditambahkan !!']);
    }
}
