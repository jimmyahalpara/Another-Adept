<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><span style="color: #5e9693;">Service Adept</span>
                {{-- <span style="color: #fff;">logist</span> --}}
            </a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Contact us</a>
                    </li>

                    @organization_member(true)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            My Organization
                        </a>
                        <ul id="dropdown-menu" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @organization_role('admin')
                            <li><a class="dropdown-item" href="{{ route('services.index') }}">Services</a></li>
                            @endorganization_role

                            @organization_role('manager')
                            <li><a class="dropdown-item" href="#">Members</a></li>
                            @endorganization_role

                            @organization_role('provider')
                            <li><a class="dropdown-item" href="#">Orders</a></li>
                            @endorganization_role

                            @organization_role('admin')
                            <li><a class="dropdown-item" href="#">Edit Detailss</a></li>
                            @endorganization_role
                        </ul>
                    </li>
                    @endorganization_member



                    @unlessorganization_member
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organizations.create') }}">Launch Your Business</a>
                    </li>
                    @endorganization_member

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user() -> name }}
                            </a>
                            <ul id="dropdown-menu" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">My Orders</a></li>
                                <li><a class="dropdown-item" href="#">My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout.get') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endguest


                </ul>
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#!">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#!">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#!">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</header>
<style>
    /* Color of the links BEFORE scroll */
    .navbar-scroll .nav-link,
    .navbar-scroll .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
        color: #fff;
    }

    /* Color of the links AFTER scroll */
    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon,
    .navbar-scrolled .navbar-brand {
        color: #fff;
    }

    /* Color of the navbar AFTER scroll */
    .navbar-scroll,
    .navbar-scrolled {
        background-color: #cbbcb1;
    }

    .mask-custom {
        backdrop-filter: blur(5px);
        background-color: rgba(255, 255, 255, .15);
        transition: all 0.3s ease-in-out;
    }

    .mask-custom:hover {
        backdrop-filter: blur(20px);
        background-color: rgba(255, 255, 255, 0.501);
    }


    .navbar-brand {
        font-size: 1.75rem;
        letter-spacing: 3px;
    }

    .dropdown-menu {
        background-color: rgba(255, 255, 255, 0.301);
        backdrop-filter: blur(10px);
    }
    nav {
        font-weight: 600;
    }

    
</style>
