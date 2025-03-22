<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="me-sm-4 ">
        <a href="{{route('welcome')}}" class="logo justify-content-center d-flex align-items-center  ">
            <img class="w-100" src="{{asset('front')}}/assets/img/1.png" alt="">

        </a>
    </div>
    <div class="d-flex justify-content-center  align-items-center ms-3 ms-lg-0">
        <div>
            <a href="{{ route('welcome') }}" class="text-decoration-none">
                <span class="text-logo logo fs-3 fw-bold">Crave</span>
            </a>

        </div>
        <i class="bi bi-list toggle-sidebar-btn cursor-pointer  "></i>
    </div>

    </div>

    <!-- Navigation -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center mb-0">
            <!-- Profile Dropdown -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset('front')}}/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;" />
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{Auth::user()->email}}</h6>
                        <span>Owner</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('profile.edit')}}">
                            <i class="bi bi-person me-2"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-2 fs-5"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>

                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    </div>
</header>

