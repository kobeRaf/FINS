<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\TreasuryController;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    // budget routes                                              
    Route::get('/budget', [BudgetController::class, 'view'])->name('budget.home');  
    // budget proposal route section
    Route::get('/budget/proposal', [BudgetController::class, 'indexProposal'])->name('budget.budgetproposal.index');      
    Route::get('/budget/proposal/create', [BudgetController::class, 'createProposal'])->name('budget.budgetproposal.create');      
    Route::get('/budget/proposal/store', [BudgetController::class, 'storeProposal'])->name('budget.budgetproposal.store');      



    // accounting routes
    Route::get('/accounting', [AccountingController::class, 'view'])->name('accounting.home');    


    // treasury routes
    Route::get('/treasury', [TreasuryController::class, 'view'])->name('treasury.home');    


    // Settings routes
      //system
    Route::get('/system', [SystemController::class, 'view'])->name('system.view');    
    Route::get('/system/create', [SystemController::class, 'create'])->name('system.create');
    Route::post('/system/store', [SystemController::class, 'store'])->name('system.store');
      //logo
    Route::get('/logo', [LogoController::class, 'view'])->name('logo.view');
    Route::post('/logo/store', [LogoController::class, 'store'])->name('logo.store');
    Route::put('/logo/update/{id}', [LogoController::class, 'update'])->name('logo.update');
    Route::delete('/logo/delete/{id}', [LogoController::class, 'destroy'])->name('logo.destroy');

    Route::get('/report', [ReportController::class, 'view'])->name('report.view'); 
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
    Route::put('/report/update/{id}', [ReportController::class, 'update'])->name('report.update');


    
});