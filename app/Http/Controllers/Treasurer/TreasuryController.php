<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemTheme;

class TreasuryController extends Controller
{
    public function view() {
        $latest = SystemTheme::first();
        return view('pages.treasurymodule.views.home', compact('latest'));
    }
}
