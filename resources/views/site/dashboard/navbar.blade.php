<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center ">
            <li class="flex-1 md:flex-none md:mr-3 ">
                <div class="relative inline-block ">
                    <button onclick="toggleDD('myDropdown')" class="drop-button text-gray-600 py-2 px-2 focus:outline-none hover:text-blue-500">
                                    <span class="pr-2">
                                        <i class="em em-robot_face"></i>
                                    </span>{{auth()->user()->name}}
                        <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                    </button>
                    <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-black right-0 mt-3 p-3 overflow-auto z-30 invisible">
                        <input type="text" class="drop-search focus:outline-none rounded p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                        <a href="{{route('site.profile.index')}}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                        <div class="border border-gray-800"></div>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <div>
                                <i class="fas fa-sign-out-alt fa-fw text-white float-left mt-1 ml-2 mr-1"></i><input type="submit" class="bg-gray-800 text-white text-sm no-underline hover:no-underline block text-white cursor-pointer" value="Выйти">
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </ul>
</nav>
<!-- /.navbar -->
