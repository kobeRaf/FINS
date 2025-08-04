<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemTheme;

class TreasuryController extends Controller
{
    public function view() {
        $latest = SystemTheme::first();
        return view('pages.treasurymodule.views.home', compact('latest'));
    }
}
