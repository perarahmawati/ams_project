<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="assets/images/el-smart_logo.png" alt="">
            </span>
            <div class="text logo-text">
                <span class="name">El-Smart</span>
                <span class="type">Asset Management</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="text search-box">
        <i class='bx bx-search icon'></i>
        <input type="text" placeholder="Search">
    </div>
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <!-- <div class="menu_title">
                    <span class="title">Main Menu</span>
                    <span class="line"></span>
                </div> -->
                <li class="nav-link {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('pages.dashboard.index') }}">
                        <i class='bx bx-home-alt icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-link {{ 'data-tables' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('pages.data-tables.index') }}">
                        <i class='bx bx-data icon'></i>
                        <span class="text nav-text">Data Tables</span>
                    </a>
                </li>
                <li class="nav-link {{ 'user-management' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('pages.user-management.index') }}">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">User Management</span>
                    </a>
                </li>
                <!-- Revisi!! -->
                <!-- <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-history icon' ></i>
                        <span class="text nav-text">History Logs</span>
                        <i class='bx bx-chevron-down icon arrow' ></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-link {{ 'user-logs' == request()->path() ? 'active' : '' }}">
                            <a href="{{ route('pages.history-logs.user-logs.index') }}">
                                <i class='bx bx-run icon'></i>
                                <span class="text">User Logs</span>
                            </a>
                        </li>
                        <li class="nav-link {{ 'activity-logs' == request()->path() ? 'active' : '' }}">
                            <a href="{{ route('pages.history-logs.activity-logs.index') }}">
                                <i class='bx bx-bar-chart icon'></i>
                                <span class="text">Activity Logs</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <div class="menu_title">
                    <span class="title">Message</span>
                    <span class="line"></span>
                </div> -->
                <li class="nav-link {{ 'message' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('pages.message.index') }}">
                        <i class='bx bx-message-square-dots icon'></i>
                        <span class="text nav-text">Message</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-content">
        <ul>
            <!-- <div class="menu_title">
                <span class="title">Account</span>
                <span class="line"></span>
            </div> -->
            <li>
                <a href="#">
                    <i class='bx bx-log-out icon' ></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>
            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>