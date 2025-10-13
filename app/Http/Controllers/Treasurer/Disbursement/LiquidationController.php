<?php

namespace App\Http\Controllers\Treasurer\Disbursement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiquidationController extends Controller
{
    public function index(){
              return view('pages.treasurymodule.views.disbursement.liquidate.index');
    }
}
