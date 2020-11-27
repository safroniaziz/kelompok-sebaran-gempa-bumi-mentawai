<?php

namespace App\Http\Controllers;

use App\DataGempa;
use App\Iterasi;
use App\NilaiCost;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $iterasis = Iterasi::where('iterasi_ke','3')->select('iterasi_ke')->first();
        $datas = Count(DataGempa::all());
        $costs = NilaiCost::where('iterasi_ke','3')->select('nilai_cost')->first();
        return view('admin/dashboard',compact('iterasis','datas','costs'));
    }
}
