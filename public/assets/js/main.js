/**
 * The Psycho Math - Main JavaScript
 */

(function() {
  "use strict";

  // Remove preloader immediately if it exists
  try {
    const preloader = document.getElementById('preloader');
    if (preloader) {
      preloader.remove();
    }
  } catch(e) {
    console.log('Preloader removal error:', e);
  }

  // Function to initialize everything
  function init() {
    try {
      /**
       * Mobile nav toggle - Handled by mobile-menu.js
       * This code is kept for dropdown functionality only
       */
      const navbar = document.querySelector('#navbar');
      if (navbar) {
        // Handle dropdown toggles - ONLY on desktop, mobile handled by inline script
        // Don't interfere with mobile menu handlers
        if (window.innerWidth > 992) {
          const dropdowns = navbar.querySelectorAll('.dropdown > a');
          dropdowns.forEach(function(dropdownLink) {
            // Only add hover handlers for desktop
            dropdownLink.addEventListener('mouseenter', function() {
              if (window.innerWidth > 992) {
                const dropdown = this.parentElement;
                dropdown.classList.add('active');
              }
            });
          });
        }
        
        // Nested dropdowns handled by inline mobile menu script
        // No need to duplicate handlers here
        
        // On desktop, ensure dropdowns stay open when clicking inside them
        navbar.querySelectorAll('.dropdown > ul').forEach(function(dropdownMenu) {
          dropdownMenu.addEventListener('click', function(e) {
            // Only stop propagation on desktop
            if (window.innerWidth > 992) {
              e.stopPropagation(); // Prevent closing when clicking inside dropdown
            }
          });
          
          // Keep dropdown open when mouse enters
          dropdownMenu.addEventListener('mouseenter', function() {
            if (window.innerWidth > 992) {
              this.parentElement.classList.add('active');
            }
          });
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
          // Close all dropdowns on mobile when resizing
          if (window.innerWidth <= 992) {
            navbar.querySelectorAll('.dropdown').forEach(function(dropdown) {
              dropdown.classList.remove('active');
            });
          }
        });
      }

      /**
       * Header scroll effect - reduce opacity when scrolled
       */
      const header = document.querySelector('#header');
      if (header) {
        function handleHeaderScroll() {
          if (window.scrollY > 50) {
            header.classList.add('scrolled');
          } else {
            header.classList.remove('scrolled');
          }
        }
        window.addEventListener('load', handleHeaderScroll);
        window.addEventListener('scroll', handleHeaderScroll);
        // Check on page load
        handleHeaderScroll();
      }
      
      /**
       * Scroll to top button
       */
      const backtotop = document.querySelector('.back-to-top');
      
      if (backtotop) {
        function toggleBacktotop() {
          if (window.scrollY > 100) {
            backtotop.classList.add('active');
          } else {
            backtotop.classList.remove('active');
          }
        }
        window.addEventListener('load', toggleBacktotop);
        document.addEventListener('scroll', toggleBacktotop);
      }

      /**
       * Smooth scroll for navigation links
       * Handles both same-page scrolling and cross-page navigation
       */
      function scrollToSection(hash) {
        if (!hash) return;
        const target = document.querySelector(hash);
        if (target) {
          const headerOffset = 80;
          const elementPosition = target.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
      }

      // Handle scrollto links
      document.querySelectorAll('a.scrollto').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          const href = this.getAttribute('href');
          if (!href) return;
          
          // Check if link contains a hash
          const hashMatch = href.match(/#(.+)$/);
          if (hashMatch) {
            const hash = '#' + hashMatch[1];
            const currentPath = window.location.pathname;
            const linkPath = href.split('#')[0];
            
            // If on same page (home page), scroll to section
            if (currentPath === '/' || currentPath === linkPath || linkPath === '' || linkPath === '/') {
              e.preventDefault();
              scrollToSection(hash);
            }
            // If on different page, let browser navigate (will scroll after page load)
            // The hash will be in the URL and handled on page load below
          }
        });
      });

      // Handle hash in URL on page load (for cross-page navigation)
      function handleHashOnLoad() {
        if (window.location.hash) {
          // Small delay to ensure page is fully loaded
          setTimeout(function() {
            scrollToSection(window.location.hash);
          }, 100);
        }
      }

      // Run on page load
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', handleHashOnLoad);
      } else {
        handleHashOnLoad();
      }

      // Also handle hash changes (e.g., browser back/forward)
      window.addEventListener('hashchange', function() {
        scrollToSection(window.location.hash);
      });

      /**
       * Portfolio filter
       */
      const portfolioFilters = document.querySelectorAll('#portfolio-flters li');
      const portfolioItems = document.querySelectorAll('.portfolio-item');

      if (portfolioFilters.length > 0 && portfolioItems.length > 0) {
        portfolioFilters.forEach(filter => {
          filter.addEventListener('click', function() {
            // Remove active class from all filters
            portfolioFilters.forEach(f => f.classList.remove('filter-active'));
            // Add active class to clicked filter
            this.classList.add('filter-active');

            const filterValue = this.getAttribute('data-filter');

            portfolioItems.forEach(item => {
              if (filterValue === '*' || item.classList.contains(filterValue.replace('.', ''))) {
                item.style.display = 'block';
              } else {
                item.style.display = 'none';
              }
            });
          });
        });
      }

      /**
       * Initialize AOS (Animate On Scroll) if available
       */
      if (typeof AOS !== 'undefined') {
        AOS.init({
          duration: 1000,
          easing: 'ease-in-out',
          once: true,
          mirror: false
        });
      }

      /**
       * Initialize Swiper for testimonials if available
       */
      if (typeof Swiper !== 'undefined') {
        const slider = document.querySelector('.testimonials-slider');
        if (slider) {
          try {
            const testimonialsSwiper = new Swiper('.testimonials-slider', {
              slidesPerView: 1,
              spaceBetween: 30,
              loop: false, // Changed to false to prevent continuous requests
              autoplay: {
                delay: 5000,
                disableOnInteraction: true, // Changed to true
                stopOnLastSlide: true, // Stop when reaching last slide
              },
              pagination: {
                el: '.swiper-pagination',
                clickable: true,
              },
            });
          } catch(e) {
            console.log('Swiper initialization error:', e);
          }
        }

        /**
         * Initialize Swiper for Team section (mobile only)
         */
        const teamMobile = document.querySelector('.team-mobile');
        if (teamMobile) {
          try {
            new Swiper('.team-mobile', {
              slidesPerView: 'auto',
              spaceBetween: 20,
              loop: true,
              autoplay: {
                delay: 3000,
                disableOnInteraction: false,
              },
              pagination: {
                el: '.team-mobile .swiper-pagination',
                clickable: true,
              },
              breakpoints: {
                768: {
                  enabled: false, // Disable on desktop
                }
              }
            });
          } catch(e) {
            console.log('Team Swiper initialization error:', e);
          }
        }

        /**
         * Initialize Swiper for Portfolio section (mobile only)
         */
        const portfolioMobile = document.querySelector('.portfolio-mobile');
        if (portfolioMobile) {
          try {
            new Swiper('.portfolio-mobile', {
              slidesPerView: 'auto',
              spaceBetween: 20,
              loop: true,
              autoplay: {
                delay: 3000,
                disableOnInteraction: false,
              },
              pagination: {
                el: '.portfolio-mobile .swiper-pagination',
                clickable: true,
              },
              breakpoints: {
                768: {
                  enabled: false, // Disable on desktop
                }
              }
            });
          } catch(e) {
            console.log('Portfolio Swiper initialization error:', e);
          }
        }

        /**
         * Initialize Swiper for Clients section (mobile only)
         */
        const clientsMobile = document.querySelector('.clients-mobile');
        if (clientsMobile) {
          try {
            new Swiper('.clients-mobile', {
              slidesPerView: 2,
              spaceBetween: 15,
              centeredSlides: true,
              loop: true,
              autoplay: {
                delay: 3000,
                disableOnInteraction: false,
              },
              pagination: {
                el: '.clients-mobile .swiper-pagination',
                clickable: true,
              },
              breakpoints: {
                768: {
                  enabled: false, // Disable on desktop
                }
              }
            });
          } catch(e) {
            console.log('Clients Swiper initialization error:', e);
          }
        }
      }

      /**
       * Initialize GLightbox for gallery if available
       */
      if (typeof GLightbox !== 'undefined') {
        try {
          const lightbox = GLightbox({
            selector: '.portfolio-lightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: false
          });
        } catch(e) {
          console.log('GLightbox initialization error:', e);
        }
      } else {
        // Fallback: Make images clickable to open in new tab if GLightbox not available
        document.querySelectorAll('.portfolio-lightbox').forEach(link => {
          link.addEventListener('click', function(e) {
            e.preventDefault();
            window.open(this.href, '_blank');
          });
        });
      }

      // Ensure preloader is completely removed
      const preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.remove();
      }
    } catch(e) {
      console.log('Init error:', e);
    }
  }

  // Run when DOM is ready - multiple fallbacks to ensure it runs
  function runInit() {
    try {
      init();
    } catch(e) {
      console.error('Init error:', e);
      // Retry after a short delay
      setTimeout(init, 100);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', runInit);
  } else {
    // DOM is already ready
    runInit();
  }

  // Also run on window load as backup
  window.addEventListener('load', function() {
    if (typeof init === 'function') {
      runInit();
    }
    document.body.classList.add('page-loaded');
  });
  
  // Immediate initialization if script loads late
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(runInit, 100);
  }

})();
