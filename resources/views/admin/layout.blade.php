<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Career Mapper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #212529;
            color: #fff;
            padding: 20px 0;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #FFD700;
            color: #212529;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h4 class="px-3 mb-4">Admin Panel</h4>
                <nav>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.about-us.index') }}" class="{{ request()->routeIs('admin.about-us.*') ? 'active' : '' }}">
                        <i class="bi bi-info-circle"></i> About Us
                    </a>
                    <a href="{{ route('admin.why-us.index') }}" class="{{ request()->routeIs('admin.why-us.*') ? 'active' : '' }}">
                        <i class="bi bi-star"></i> Why Us
                    </a>
                    <a href="{{ route('admin.features.index') }}" class="{{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
                        <i class="bi bi-star-fill"></i> Features
                    </a>
                    <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i> Clients
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i> Services
                    </a>
                    <a href="{{ route('admin.portfolio.index') }}" class="{{ request()->routeIs('admin.portfolio.*') && !request()->routeIs('admin.portfolio.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Portfolio
                    </a>
                    <a href="{{ route('admin.portfolio.categories.index') }}" class="{{ request()->routeIs('admin.portfolio.categories.*') ? 'active' : '' }}" style="padding-left: 40px; font-size: 0.9rem;">
                        <i class="bi bi-tags"></i> Portfolio Categories
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Team
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-quote"></i> Testimonials
                    </a>
                    <a href="{{ route('admin.contact.index') }}" class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i> Contact
                    </a>
                    <a href="{{ route('admin.why-choose-us.index') }}" class="{{ request()->routeIs('admin.why-choose-us.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i> Why Choose Us
                    </a>
                    <a href="{{ route('admin.test-pages.index') }}" class="{{ request()->routeIs('admin.test-pages.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> Test Pages
                    </a>
                    <a href="{{ route('admin.careers.index') }}" class="{{ request()->routeIs('admin.careers.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark"></i> Career Library
                    </a>
                    <a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                        <i class="bi bi-list-ul"></i> Menu Management
                    </a>
                    <a href="{{ route('admin.test-bookings.index') }}" class="{{ request()->routeIs('admin.test-bookings.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Test Bookings
                    </a>
                    <a href="{{ route('admin.grade-pages.index') }}" class="{{ request()->routeIs('admin.grade-pages.*') ? 'active' : '' }}">
                        <i class="bi bi-mortarboard"></i> Grade Pages
                    </a>
                    <hr class="my-2 mx-3 border-secondary">
                    <a href="{{ route('admin.theme.index') }}" class="{{ request()->routeIs('admin.theme.*') ? 'active' : '' }}">
                        <i class="bi bi-palette"></i> Theme Settings
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="bi bi-house"></i> View Website
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-link text-white text-decoration-none w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
