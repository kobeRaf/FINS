<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\SystemTheme;

class AccountingController extends Controller
{
    public function view() {
        $latest = SystemTheme::first();
        return view('pages.accountingmodule.views.home', compact('latest'));
    }
}
