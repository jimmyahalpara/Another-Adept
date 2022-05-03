<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Service Adept" id="site_logo">
            </a>
            <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organizations.index') }}">Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('team') }}">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('threads.index') }}">Help Center</a>
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

                            @organization_role('admin')
                            <li><a class="dropdown-item" href="{{ route('members.index') }}">Members</a></li>
                            @endorganization_role

                            @organization_role('manager')
                            <li><a class="dropdown-item" href="{{ route('order.organization') }}">Orders</a></li>
                            @endorganization_role

                            @organization_role('provider')
                            <li><a href="{{ route('order.my.orders') }}" class="dropdown-item">Service Orders</a>
                            </li>
                            @endorganization_role

                            @organization_role('admin')
                            <li><a class="dropdown-item"
                                    href="{{ route('organizations.show', ['organization' => organization_id()]) }}">
                                    Organization Profile
                                </a></li>
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
                                {{ Auth::user()->name }}
                            </a>
                            <ul id="dropdown-menu" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('home.orders') }}">My Orders</a></li>
                                <li><a href="{{ route('invoice.index') }}" class="dropdown-item">Invoices</a></li>
                                <li><a class="dropdown-item" href="{{ route('home.profile') }}">My Profile</a></li>
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
                    @auth
                        <li class="nav-item me-3 me-lg-0">
                            <a class="nav-link d-flex justify-content-between align-items-center"
                                href="{{ route('home.cart') }}">
                                @php
                                    $like_count = Auth::user()
                                        ->services()
                                        ->count();
                                @endphp
                                @if ($like_count > 0)
                                    <i id="user-like-icon" class="fa-solid fa-heart text-danger me-1"></i>
                                    <span id="user-like-number" class="badge bg-danger">{{ $like_count }}</span>
                                @else
                                    <i id="user-like-icon" class="fa-regular fa-heart me-1 "></i>
                                    <span id="user-like-number" class="badge bg-danger "></span>
                                @endif
                            </a>
                        </li>
                    @endauth
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

    #site_logo {
        height: 16vh;
        margin: -5vh;
    }

    #user-like-icon {
        font-size: 1.5em;
    }

</style>
<script>
    var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))

    function toggleNavbar(params) {
        var collapseList = collapseElementList.map(function(collapseEl) {
            return new bootstrap.Collapse(collapseEl)
        })
    }
</script>
