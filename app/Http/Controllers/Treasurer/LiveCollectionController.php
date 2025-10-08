<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiveCollectionController extends Controller
{
    public function index() {
      return view('pages.treasurymodule.views.revenue.livecollection.index');
    }
}
