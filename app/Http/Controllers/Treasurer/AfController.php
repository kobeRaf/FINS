<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AfController extends Controller
{
    public function index() {
      return view('pages.treasurymodule.views.revenue.afcontroll.index');
    }
}
