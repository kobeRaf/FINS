<?php


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\ItemPayeeController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Treasurer\TreasuryController;
use App\Http\Controllers\Treasurer\AfController;
use App\Http\Controllers\Treasurer\LiveCollectionController;
use App\Http\Controllers\Treasurer\BatchCollectionController;


use App\Http\Controllers\AccountController;

use App\Http\Controllers\Treasurer\Disbursement\ForSignatureController;
use App\Http\Controllers\Treasurer\Disbursement\CashAdvanceController;
use App\Http\Controllers\Treasurer\Disbursement\CaSignatureController;
use App\Http\Controllers\Treasurer\Disbursement\AccountingAuditController;
use App\Http\Controllers\Treasurer\Disbursement\AdaSignatureController;
use App\Http\Controllers\Treasurer\Disbursement\ForOutController;
use App\Http\Controllers\Treasurer\Disbursement\DownloadController;
use App\Http\Controllers\Treasurer\Disbursement\ForReleaseController;
use App\Http\Controllers\Treasurer\Disbursement\LiquidationController;


use App\Http\Controllers\FundController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

      // budget routes                                              
         Route::get('/budget', [BudgetController::class, 'view'])->name('budget.home');  
      // budget routes 

      // budget proposal route section
        Route::get('/budget/proposal', [BudgetController::class, 'indexProposal'])->name('budget.budgetproposal.index');      
        Route::get('/budget/proposal/create', [BudgetController::class, 'createProposal'])->name('budget.budgetproposal.create');      
        Route::get('/budget/proposal/store', [BudgetController::class, 'storeProposal'])->name('budget.budgetproposal.store');      
      // budget proposal route section


    // accounting routes
       Route::get('/accounting', [AccountingController::class, 'view'])->name('accounting.home');    
    // accounting routes

    // treasury routes
        Route::get('/treasury', [TreasuryController::class, 'view'])->name('treasury.home');    
      
          //AFcontroller
          Route::get('treasury/revenue/add-af-controll', [AfController::class, 'index'])->name('treasury.afcontroll.index'); 
          Route::get('treasury/revenue/live-collection', [LiveCollectionController::class, 'index'])->name('treasury.livecollection.index'); 
          Route::get('treasury/revenue/batch-collection', [BatchCollectionController::class, 'index'])->name('treasury.batchcollection.index'); 

          //Disbursementcontroller
          Route::get('treasury/disbursement/forsignature', [ForSignatureController::class, 'index'])->name('treasury.forsignature.index');
          Route::get('treasury/disbursement/cashadvance', [CashAdvanceController::class, 'index'])->name('treasury.cashadvance.index');
          Route::get('treasury/disbursement/casignature', [CaSignatureController::class, 'index'])->name('treasury.casignature.index');
          Route::get('treasury/disbursement/accountingaudit', [AccountingAuditController::class, 'index'])->name('treasury.accountingaudit.index');
          Route::get('treasury/disbursement/adasignature', [AdaSignatureController::class, 'index'])->name('treasury.adasignature.index');
          Route::get('treasury/disbursement/forout', [ForOutController::class, 'index'])->name('treasury.forout.index');
          Route::get('treasury/disbursement/download', [DownloadController::class, 'index'])->name('treasury.download.index');
          Route::get('treasury/disbursement/forrelease', [ForReleaseController::class, 'index'])->name('treasury.forrelease.index');
          Route::get('treasury/disbursement/liquidate', [LiquidationController::class, 'index'])->name('treasury.liquidate.index');

    // treasury routes
    
    //master data
      //fund
        Route::get('/fund', [FundController::class, 'view'])->name('fund.view');
        Route::post('/fund', [FundController::class, 'store'])->name('fund.store');  
        Route::get('/fund/report/{templateId}', [FundController::class, 'report'])->name('fund.report');

      //deparment
        Route::get('/department', [DepartmentController::class, 'view'])->name('department.view');
        Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');  
      // Route::get('/department/report/{templateId}', [DepartmentController::class, 'report'])->name('department.report');

      //payee
        Route::get('/entity', [EntityController::class, 'view'])->name('entity.view');
        Route::post('/entity/store', [EntityController::class, 'store'])->name('entity.store');

      //accounts
        Route::get('/account', [AccountController::class, 'view'])->name('account.view');
        Route::post('/account/store', [AccountController::class, 'store'])->name('account.store');

      //users

    //master data


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
      
        //report
      Route::get('/report', [ReportController::class, 'view'])->name('report.view'); 
      Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
      Route::put('/report/update/{id}', [ReportController::class, 'update'])->name('report.update');
    // Settings routes

    
});