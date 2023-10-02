<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="assets/images/logo.png" alt="">
            </span>
            <div class="text logo-text">
                <span class="name">Codinglab</span>
                <span class="profession">Web developer</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
                <!-- <span class="tooltip">Search</span> -->
            </li>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-home-alt icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                    <!-- <span class="tooltip">Dashboard</span> -->
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-bar-chart-alt-2 icon' ></i>
                        <span class="text nav-text">Data Tables</span>
                    </a>
                    <!-- <span class="tooltip">Data Tables</span> -->
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">User Management</span>
                    </a>
                    <!-- <span class="tooltip">User Management</span> -->
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-history icon' ></i>
                        <span class="text nav-text">Log Activity</span>
                    </a>
                    <!-- <span class="tooltip">Log Activity</span> -->
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            <li class="">
                <a href="#">
                    <i class='bx bx-log-out icon' ></i>
                    <span class="text nav-text">Logout</span>
                </a>
                <!-- <span class="tooltip">Logout</span> -->
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
            
        </div>
    </div>
</nav>

<script>
    const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

    toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
    })
    searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
    })
    modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");

    if(body.classList.contains("dark")){
        modeText.innerText = "Light mode";
    }else{
        modeText.innerText = "Dark mode";
        
    }
    });
</script>