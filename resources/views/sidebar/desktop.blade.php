<style>
    .sidebar {
    display: flex;
    flex-direction: column;
    height: 100vh; /* Full height */
    }

    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Optional: style scrollbar */
    .sidebar-content::-webkit-scrollbar {
        width: 6px;
    }
    .sidebar-content::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.3);
        border-radius: 3px;
    }
</style>


@php
    $route = request()->segment(1);
@endphp

<div class="sidebar d-none d-md-flex flex-column" id="desktopSidebar">
    <div class="sidebar-content px-3 py-2">
        <!-- System Name + Toggle Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-truncate" style="max-width: 20%;">{{ $latest->system_name ?? 'APP' }}</h5>
            <button class="btn btn-sm btn-primary" style="min-width: 36px;" onclick="toggleDesktopSidebar()">☰</button>
        </div>

        <ul class="nav flex-column mt-3 accordion" id="mainSidebarAccordion">
            {{--Home--}}
            <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link"><i class="bi bi-house-door me-3"></i> Home</a></li>

            {{--Master Data--}}
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#master"
                    role="button" aria-expanded="{{ $route === 'master' ? 'true' : 'false' }}"
                    aria-controls="master">
                    <i class="bi bi-database me-3"></i>  Master Data <b>▾</b>
                    </a>
                    <div class="collapse {{ in_array($route ,['fund', 'department']) ? 'show' : '' }}" id="master" data-bs-parent="#mainSidebarAccordion">
                        <ul class="list-unstyled ms-3 accordion">
                            <li><a href="{{ url('/fund') }}" class="nav-link"><i class="bi bi-wallet2 me-2"></i>Funds</a></li>
                            <li><a href="{{ url('/department') }}" class="nav-link"><i class="bi bi-building me-2"></i>Departments</a></li>
                            <li><a href="{{ url('/entity') }}" class="nav-link"><i class="bi bi-person-lines-fill me-2"></i>Entity</a></li>
                            <li><a href="{{ url('/account') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i>Chart of Accounts</a></li>
                            <li><a href="{{ url('/projects') }}" class="nav-link"><i class="bi bi-kanban me-2"></i>Projects / Activities</a></li>
                            <li><a href="{{ url('/documents') }}" class="nav-link"><i class="bi bi-file-earmark-text me-2"></i>Documents</a></li>
                            <li><a href="{{ url('/transactions') }}" class="nav-link"><i class="bi bi-repeat me-2"></i>Transactions</a></li>
                            <li><a href="{{ url('/users') }}" class="nav-link"><i class="bi bi-people me-2"></i>Users</a></li>
                        </ul>
                    </div>
                </li>
            {{--Master Data--}}

            {{-- Budget --}}
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#budgetMenu"
                    role="button" aria-expanded="{{ $route === 'budget' ? 'true' : 'false' }}"
                    aria-controls="budgetMenu">
                    <i class="bi bi-cash-stack me-3"></i> Budget <b>▾</b>
                    </a>
                    <div class="collapse {{ $route === 'budget' ? 'show' : '' }}" id="budgetMenu" data-bs-parent="#mainSidebarAccordion">
                        <ul class="list-unstyled ms-3 accordion">
                            <li><a href="{{ url('budget')}}" class="nav-link"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a></li>
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#budgetProposalIndex" role="button" aria-expanded="false" aria-controls="budgetProposalIndex">
                                <i class="bi bi-file-text"></i>  Budget Proposal <b>▾</b>
                                </a>
                                <div class="collapse {{ Request::is('budget/proposal*') ? 'show' : '' }}" id="budgetProposalIndex">
                                    <ul class="list-unstyled ms-3">
                                        <li><a href="{{ route('budget.budgetproposal.index')}}" class="nav-link"><i class="bi bi-envelope me-1"></i> Proposal List</a></li>
                                        <li><a href="{{ route('budget.budgetproposal.create')}}" class="nav-link">Create Proposal</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#budgetSubMenu" role="button" aria-expanded="false" aria-controls="budgetSubMenu">
                                    Sub Menu ▾
                                </a>
                                <div class="collapse" id="budgetSubMenu">
                                    <ul class="list-unstyled ms-3">
                                        <li><a href="#" class="nav-link">Budget Request</a></li>
                                        <li><a href="#" class="nav-link">Appropriations</a></li>
                                        <li><a href="#" class="nav-link">Allotments</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#" class="nav-link">Link 1</a></li>
                            <li><a href="#" class="nav-link">Link 2</a></li>
                        </ul>
                    </div>
                </li>
            {{-- Budget --}}

            {{-- Accounting --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#accountingMenu"
                    role="button" aria-expanded="{{ $route === 'accounting' ? 'true' : 'false' }}"
                    aria-controls="accountingMenu">
                    <i class="bi bi-journal-text me-3"></i>  Accounting  <b>▾</b>
                    </a>
                    <div class="collapse {{ $route === 'accounting' ? 'show' : '' }}" id="accountingMenu" data-bs-parent="#mainSidebarAccordion">
                        <ul class="list-unstyled ms-3">
                            <li><a href="{{ url('accounting')}}" class="nav-link">Dashboard</a></li>
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#accountingSubMenu" role="button" aria-expanded="false" aria-controls="accountingSubMenu">
                                    Sub Menu ▾
                                </a>
                                <div class="collapse" id="accountingSubMenu">
                                    <ul class="list-unstyled ms-3">
                                        <li><a href="#" class="nav-link">Journal Entries</a></li>
                                        <li><a href="#" class="nav-link">Obligations</a></li>
                                        <li><a href="#" class="nav-link">Reports</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#" class="nav-link">Link 1</a></li>
                            <li><a href="#" class="nav-link">Link 2</a></li>
                        </ul>
                    </div>
                </li> --}}
            {{-- Accounting --}}

            {{-- Treasury --}}
                @php
                    $isTreasury = request()->is('treasury*');
                    $isAFControl = request()->is('treasury/revenue/add-af-controll');
                    $isRevenue = request()->is('treasury/revenue/live-collection*') || request()->is('treasury/revenue/batch-collection*');

                    $isDisbursement = request()->is('treasury/disbursement/forsignature*') ||
                                        request()->is('treasury/disbursement/cashadvance*') ||
                                        request()->is('treasury/disbursement/casignature*') ||
                                        request()->is('treasury/disbursement/accountingaudit*') ||
                                        request()->is('treasury/disbursement/adasignature*') ||
                                        request()->is('treasury/disbursement/forout*') ||
                                        request()->is('treasury/disbursement/download*') ||
                                        request()->is('treasury/disbursement/forrelease*') ||
                                        request()->is('treasury/disbursement/liquidate*');
                @endphp

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#treasuryMenu" aria-expanded="{{ $isTreasury ? 'true' : 'false' }}" aria-controls="treasuryMenu">
                        <i class="bi bi-bank me-3"></i> Treasury <b>▾</b>
                    </a>
                    <div class="collapse {{ $isTreasury ? 'show' : '' }}" id="treasuryMenu" data-bs-parent="#mainSidebarAccordion">
                        <ul class="list-unstyled ms-3 accordion" id="submenu">

                            <li><a href="{{ route('treasury.home') }}" class="nav-link">Dashboard</a></li>
                            
                            {{-- Master Data --}}
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#treasuryMasterData" role="button"
                                    aria-expanded="false" aria-controls="treasuryMasterData">
                                    Master Data ▾
                                </a>
                                <div class="collapse" id="treasuryMasterData" data-bs-parent="#submenu">
                                    <ul class="list-unstyled ms-3">
                                        <li>
                                            <a class="nav-link" data-bs-toggle="collapse" href="#treasuryRevenue-afcontroll" role="button"
                                                aria-expanded="{{ $isAFControl ? 'true' : 'false' }}"
                                                aria-controls="treasuryRevenue-afcontroll">
                                                AF Control ▾
                                            </a>
                                            <div class="collapse {{ $isAFControl ? 'show' : '' }}" id="treasuryRevenue-afcontroll">
                                                <ul class="list-unstyled ms-3">
                                                    <li><a href="{{ route('treasury.afcontroll.index') }}" class="nav-link">Add New Series</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Revenue --}}
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#treasuryRevenue-collection" role="button"
                                    aria-expanded="{{ $isRevenue ? 'true' : 'false' }}"
                                    aria-controls="treasuryRevenue-collection">
                                    Revenue ▾
                                </a>
                                <div class="collapse {{ $isRevenue ? 'show' : '' }}" id="treasuryRevenue-collection" data-bs-parent="#submenu">
                                    <ul class="list-unstyled ms-3">
                                        <li><a href="{{ route('treasury.livecollection.index') }}" class="nav-link">Live Collection</a></li>
                                        <li><a href="{{ route('treasury.batchcollection.index') }}" class="nav-link">Offline Collection</a></li>
                                        <li><a href="#" class="nav-link">Save Collection</a></li>
                                        <li><a href="#" class="nav-link">Unremitted Collection</a></li>
                                        <li><a href="#" class="nav-link">Remittances</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Disbursement --}}
                            <li>
                                <a class="nav-link" data-bs-toggle="collapse" href="#treasuryDisbursement" role="button"
                                    aria-expanded="{{ $isDisbursement ? 'true' : 'false' }}" aria-controls="treasuryDisbursement">
                                    Disbursement ▾
                                </a>
                                <div class="collapse {{ $isDisbursement ? 'show' : '' }}" id="treasuryDisbursement" data-bs-parent="#submenu">
                                    <ul class="list-unstyled ms-3">
                                        <li><a href="{{ route('treasury.forsignature.index') }}" class="nav-link">For Signature</a></li>
                                        <li><a href="{{ route('treasury.cashadvance.index') }}" class="nav-link">Cash Advance</a></li>
                                        <li><a href="{{ route('treasury.casignature.index') }}" class="nav-link">CA Signature</a></li>
                                        <li><a href="{{ route('treasury.accountingaudit.index') }}" class="nav-link">Accounting Audit</a></li>
                                        <li><a href="{{ route('treasury.adasignature.index') }}" class="nav-link">ADA Signature</a></li>
                                        <li><a href="{{ route('treasury.forout.index') }}" class="nav-link">For Out</a></li>
                                        <li><a href="{{ route('treasury.download.index') }}" class="nav-link">Download</a></li>
                                        <li><a href="{{ route('treasury.forrelease.index') }}" class="nav-link">For Release</a></li>
                                        <li><a href="{{ route('treasury.liquidate.index') }}" class="nav-link">Liquidation</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>
            {{-- Treasury --}}


            {{-- System Settings --}}
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#system"
                    role="button" aria-expanded="{{ $route === 'system' ? 'true' : 'false' }}"
                    aria-controls="system">
                    <i class="bi bi-gear me-3"></i> System Settings <b>▾</b>
                    </a>
                    <div class="collapse {{ in_array($route, ['system', 'logo', 'report']) ? 'show' : '' }}" id="system" data-bs-parent="#mainSidebarAccordion">
                        <ul class="list-unstyled ms-3 accordion">
                            <li class="nav-item"><a href="{{ url('system') }}" class="nav-link">Theme</a></li>
                            <li class="nav-item"><a href="{{ url('logo') }}" class="nav-link">Report Logo</a></li>
                            <li class="nav-item"><a href="{{ url('report') }}" class="nav-link">Report Template</a></li>
                        </ul>
                    </div>
                </li>
            {{-- System Settings --}}

            {{--User Manual--}}
                 {{-- <li class="nav-item"><a href="{{ url('manual.html') }}" class="nav-link"><i class="bi bi-journal-bookmark me-3"></i> User Manual</a></li> --}}
            {{--User Manual--}}

        </ul>

    </div>

        <!-- Desktop Footer -->
        <div class="sidebar-footer mb-4">
            <div class="dropdown mb-4">
                <a class="btn btn-outline-secondary dropdown-toggle w-100" href="#" role="button"
                   id="userDropdownDesktop" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->first }}
                </a>
                <ul class="dropdown-menu w-100" aria-labelledby="userDropdownDesktop">
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</div>