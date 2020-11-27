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
}
