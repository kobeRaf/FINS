    <div class="sidebar offcanvas d-md-none" id="mobileSidebar">
        <div class="sidebar-content">
            <button class="btn btn-sm btn-outline-danger mb-3" onclick="toggleSidebar()">✕</button>
            <h5>{{ config('app.name', 'Laravel') }}</h5>

            <ul class="nav flex-column mt-3">
                <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Dashboard</a></li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#budgetMenu" role="button" aria-expanded="false" aria-controls="budgetMenu">
                        Budget ▾
                    </a>
                    <div class="collapse" id="budgetMenu">
                        <ul class="list-unstyled ms-3">
                            <li><a href="#" class="nav-link">Budget Requests</a></li>
                            <li><a href="#" class="nav-link">Appropriations</a></li>
                            <li><a href="#" class="nav-link">Allotments</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#accountingMenu" role="button" aria-expanded="false" aria-controls="accountingMenu">
                        Accounting ▾
                    </a>
                    <div class="collapse" id="accountingMenu">
                        <ul class="list-unstyled ms-3">
                            <li><a href="#" class="nav-link">Journal Entries</a></li>
                            <li><a href="#" class="nav-link">Obligations</a></li>
                            <li><a href="#" class="nav-link">Reports</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#treasuryMenu" role="button" aria-expanded="false" aria-controls="treasuryMenu">
                        Treasury ▾
                    </a>
                    <div class="collapse" id="treasuryMenu">
                        <ul class="list-unstyled ms-3">
                            <li><a href="#" class="nav-link">Disbursements</a></li>
                            <li><a href="#" class="nav-link">Cash Advances</a></li>
                            <li><a href="#" class="nav-link">Collections</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item"><a href="{{ url('system')}}" class="nav-link">System Settings</a></li>
            </ul>

            <!-- Mobile Footer -->
            <div class="sidebar-footer mb-4">
                <div class="dropdown mb-4">
                    <a class="btn btn-outline-secondary dropdown-toggle w-100" href="#" role="button"
                       id="userDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->first }}
                    </a>
                    <ul class="dropdown-menu w-100" aria-labelledby="userDropdownMobile">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>