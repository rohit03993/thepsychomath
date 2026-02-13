<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Best Career Counselling in India - The Psycho Math')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files - Using CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    <!-- Dynamic Theme Variables -->
    @php
        $themeSettings = \App\Models\ThemeSetting::getActive();
    @endphp
    @if($themeSettings)
    <style id="dynamic-theme-vars">
        {!! $themeSettings->generateCss() !!}
    </style>
    @endif
    
    <!-- Critical Mobile Menu Styles - Inline to ensure they load first -->
    <style>
      /* Hamburger button: visible on mobile only, high z-index, clear tap target */
      @media (max-width: 992px) {
        .mobile-nav-toggle {
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
          visibility: visible !important;
          opacity: 1 !important;
          position: relative !important;
          z-index: 10002 !important;
          width: 48px !important;
          min-width: 48px !important;
          height: 48px !important;
          min-height: 48px !important;
          padding: 0 !important;
          margin: 0 !important;
          margin-left: auto !important;
          order: 2 !important;
          flex-shrink: 0 !important;
          background: transparent !important;
          border: none !important;
          border-radius: 8px !important;
          cursor: pointer !important;
          pointer-events: auto !important;
          color: #fff !important;
          -webkit-tap-highlight-color: rgba(255,255,255,0.2);
        }
        .mobile-nav-toggle .mobile-nav-toggle-icon {
          font-size: 28px !important;
          line-height: 1 !important;
          font-family: Arial, sans-serif !important;
          color: inherit !important;
        }
      }
      @media (min-width: 993px) {
        .mobile-nav-toggle { display: none !important; }
      }
      /* Call Now: hidden on mobile */
      @media (max-width: 992px) {
        #header .get-started-btn {
          display: none !important;
          visibility: hidden !important;
          opacity: 0 !important;
        }
        #header .container { overflow: visible !important; }
      }
    </style>

    @stack('styles')
</head>
<body style="overflow-x: hidden;">
    @include('partials.header')
    
    <!-- Mobile Menu - Clean Simple Solution -->
    <script>
      (function() {
        'use strict';
        
        function initMobileMenu() {
          const toggle = document.querySelector('.mobile-nav-toggle');
          const icon = document.querySelector('.mobile-nav-toggle-icon');
          const navbar = document.querySelector('#navbar');
          
          if (!toggle || !navbar || toggle.dataset.mobileMenuBound) return false;
          toggle.dataset.mobileMenuBound = '1';
          
          function setOpen(open) {
            var overlay = document.getElementById('navbar-overlay');
            if (open) {
              navbar.classList.add('navbar-mobile');
              document.body.classList.add('navbar-open');
              document.body.style.overflow = 'hidden';
              if (icon) icon.textContent = '\u2715';
              toggle.setAttribute('aria-expanded', 'true');
              toggle.setAttribute('aria-label', 'Close menu');
              if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'navbar-overlay';
                overlay.setAttribute('aria-hidden', 'true');
                overlay.style.cssText = 'position:fixed;top:70px;left:0;width:100vw;height:calc(100vh - 70px);background:rgba(0,0,0,0.6);z-index:999;cursor:pointer;';
                overlay.addEventListener('click', function() { setOpen(false); });
                document.body.appendChild(overlay);
              }
            } else {
              navbar.classList.remove('navbar-mobile');
              document.body.classList.remove('navbar-open');
              document.body.style.overflow = '';
              if (icon) icon.textContent = '\u2630';
              toggle.setAttribute('aria-expanded', 'false');
              toggle.setAttribute('aria-label', 'Open menu');
              if (overlay && overlay.parentNode) overlay.parentNode.removeChild(overlay);
            }
          }
          
          toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            setOpen(!navbar.classList.contains('navbar-mobile'));
          });
          
          // Handle dropdown clicks and close menu on nav link click
          navbar.addEventListener('click', function(e) {
            if (window.innerWidth > 992 || !navbar.classList.contains('navbar-mobile')) return;
            let clicked = e.target;
            if (clicked.tagName === 'SPAN' || clicked.tagName === 'I') clicked = clicked.closest('a');
            if (!clicked || clicked.tagName !== 'A') return;

            const dropdown = clicked.closest('.dropdown');
            const isDropdownToggle = dropdown && clicked.parentElement === dropdown;
            const isNestedToggle = dropdown && clicked.closest('.dropdown .dropdown') && clicked.parentElement === clicked.closest('.dropdown .dropdown');

            if (isDropdownToggle) {
              e.preventDefault();
              e.stopPropagation();
              dropdown.classList.toggle('active');
              var parent = dropdown.parentElement;
              if (parent) {
                Array.from(parent.children).forEach(function(c) {
                  if (c !== dropdown && c.classList.contains('dropdown')) c.classList.remove('active');
                });
              }
              return;
            }
            if (isNestedToggle) {
              e.preventDefault();
              e.stopPropagation();
              clicked.closest('.dropdown .dropdown').classList.toggle('active');
              return;
            }

            // Regular nav link: close menu (let default navigation happen)
            if (clicked.getAttribute('href')) setOpen(false);
          });
          
          return true;
        }
        
        // Initialize
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', initMobileMenu);
        } else {
          initMobileMenu();
        }
        
        setTimeout(initMobileMenu, 100);
        setTimeout(initMobileMenu, 500);
        window.addEventListener('load', initMobileMenu);
      })();
    </script>

    <main id="main" style="min-height: 100vh;">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Preloader - Completely removed -->
    @php
        $contactInfo = \App\Models\ContactInfo::where('is_active', true)->first();
        $phoneRaw = $contactInfo && $contactInfo->phone ? trim($contactInfo->phone) : '+916396292221';
        $phoneForTel = 'tel:' . preg_replace('/\s+/', '', ltrim($phoneRaw, 'tel:'));
    @endphp
    <a href="{{ $phoneForTel }}" class="call-now-btn d-flex align-items-center justify-content-center" aria-label="Call us"><i class="bi bi-telephone-fill"></i></a>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Force page to signal loaded - Don't wait for external resources -->
    <script>
      // Immediately mark page as loaded
      document.body.classList.add('loaded');
      
      // Force load event when DOM is ready (don't wait for images or external resources)
      (function() {
        function signalLoaded() {
          // Dispatch load event immediately
          if (document.readyState === 'complete') {
            if (!window.pageLoadSignaled) {
              window.pageLoadSignaled = true;
              window.dispatchEvent(new Event('load'));
            }
          }
        }
        
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', function() {
            setTimeout(signalLoaded, 50);
          });
        } else {
          setTimeout(signalLoaded, 50);
        }
        
        // Force after 200ms max - don't wait longer
        setTimeout(function() {
          if (!window.pageLoadSignaled) {
            window.pageLoadSignaled = true;
            window.dispatchEvent(new Event('load'));
            document.body.classList.add('page-loaded');
          }
        }, 200);
      })();
    </script>

    <!-- Vendor JS Files - Using CDN (async, non-blocking) -->
    <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.1.0/dist/purecounter_vanilla.js" async defer onerror="void(0)"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async defer onerror="void(0)"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js" async defer onerror="void(0)"></script>
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js" async defer onerror="void(0)"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" async defer onerror="void(0)"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" async defer onerror="void(0)"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}" async defer></script>

    @stack('scripts')
</body>
</html>
