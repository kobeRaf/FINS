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
                <div class="collapse {{ $route === 'fund' ? 'show' : '' }}" id="master" data-bs-parent="#mainSidebarAccordion">
                    <ul class="list-unstyled ms-3 accordion">
                        <li><a href="{{ url('/fund') }}" class="nav-link">Fund</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                        <li><a href="#" class="nav-link">Link 2</a></li>
                    </ul>
                </div>
            </li>

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
            
            {{-- Accounting --}}
            <li class="nav-item">
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
            </li>

            {{-- Treasury --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#treasuryMenu"
                role="button" aria-expanded="{{ $route === 'treasury' ? 'true' : 'false' }}"
                aria-controls="treasuryMenu">
                   <i class="bi bi-bank me-3"></i> Treasury <b>▾</b>
                </a>
                <div class="collapse {{ $route === 'treasury' ? 'show' : '' }}" id="treasuryMenu" data-bs-parent="#mainSidebarAccordion">
                    <ul class="list-unstyled ms-3 accordion" id="submenu">
                        <li><a href="{{ url('treasury')}}" class="nav-link">Dashboard</a></li>

                        <li>
                            <a class="nav-link" data-bs-toggle="collapse" href="#treasuryMasterData" role="button" aria-expanded="false" aria-controls="treasuryMasterData">
                                Master Data ▾
                            </a>
                            <div class="collapse" id="treasuryMasterData" data-bs-parent="#submenu">
                                <ul class="list-unstyled ms-3">
                                    <li><a href="#" class="nav-link">Link 1</a></li>
                                    <li><a href="#" class="nav-link">Link 2</a></li>
                                    <li><a href="#" class="nav-link">Link 3</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link" data-bs-toggle="collapse" href="#treasuryCashAdvance" role="button" aria-expanded="false" aria-controls="treasuryCashAdvance">
                                Cash Advance ▾
                            </a>
                            <div class="collapse" id="treasuryCashAdvance" data-bs-parent="#submenu">
                                <ul class="list-unstyled ms-3">
                                    <li><a href="#" class="nav-link">Cash Advance List</a></li>
                                    <li><a href="#" class="nav-link">Create Cash Advance</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link" data-bs-toggle="collapse" href="#sampleSubMenu" role="button" aria-expanded="false" aria-controls="sampleSubMenu">
                                Sample List ▾
                            </a>
                            <div class="collapse" id="sampleSubMenu" data-bs-parent="#submenu">
                                <ul class="list-unstyled ms-3">
                                    <li><a href="#" class="nav-link">Sample 1</a></li>
                                    <li><a href="#" class="nav-link">Sample 2</a></li>
                                </ul>
                            </div>
                        </li>

                        <li><a href="#" class="nav-link">Reports</a></li>
                        <li><a href="#" class="nav-link">Admin Task</a></li>
                    </ul>
                </div>
            </li>

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

            {{--User Manual--}}
            <li class="nav-item"><a href="{{ url('manual.html') }}" class="nav-link"><i class="bi bi-journal-bookmark me-3"></i> User Manual</a></li>
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