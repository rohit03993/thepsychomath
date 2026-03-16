<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AboutUsController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/test', function() {
    return view('test');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Test Pages Routes
Route::get('/tests', [\App\Http\Controllers\TestPageController::class, 'index'])->name('test-pages.index');
Route::get('/test/{slug}', [\App\Http\Controllers\TestPageController::class, 'show'])->name('test-pages.show');

// Career Library Routes
Route::get('/careers', [\App\Http\Controllers\CareerController::class, 'index'])->name('careers.index');
Route::get('/career/{slug}', [\App\Http\Controllers\CareerController::class, 'show'])->name('careers.show');

// Grade Pages Routes (Class 8-9, Class 10-12, College and Graduates)
Route::get('/grade/{slug}', [\App\Http\Controllers\GradePageController::class, 'show'])->name('grade-pages.show');

// Test Booking Routes
Route::post('/test-bookings', [\App\Http\Controllers\TestBookingController::class, 'store'])->name('test-bookings.store');

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // About Us Routes
        Route::get('/about-us', [AboutUsController::class, 'index'])->name('admin.about-us.index');
        Route::get('/about-us/{id}/edit', [AboutUsController::class, 'edit'])->name('admin.about-us.edit');
        Route::put('/about-us/{id}', [AboutUsController::class, 'update'])->name('admin.about-us.update');
        
        // Why Us Routes
        Route::get('/why-us', [\App\Http\Controllers\Admin\WhyUsController::class, 'index'])->name('admin.why-us.index');
        Route::get('/why-us/{id}/edit', [\App\Http\Controllers\Admin\WhyUsController::class, 'edit'])->name('admin.why-us.edit');
        Route::put('/why-us/{id}', [\App\Http\Controllers\Admin\WhyUsController::class, 'update'])->name('admin.why-us.update');
        
        // Features Routes
        Route::get('/features', [\App\Http\Controllers\Admin\FeatureController::class, 'index'])->name('admin.features.index');
        Route::get('/features/{id}/edit', [\App\Http\Controllers\Admin\FeatureController::class, 'edit'])->name('admin.features.edit');
        Route::put('/features/{id}', [\App\Http\Controllers\Admin\FeatureController::class, 'update'])->name('admin.features.update');
        
        // Clients Routes
        Route::get('/clients', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('admin.clients.index');
        Route::get('/clients/create', [\App\Http\Controllers\Admin\ClientController::class, 'create'])->name('admin.clients.create');
        Route::post('/clients', [\App\Http\Controllers\Admin\ClientController::class, 'store'])->name('admin.clients.store');
        Route::get('/clients/{id}/edit', [\App\Http\Controllers\Admin\ClientController::class, 'edit'])->name('admin.clients.edit');
        Route::put('/clients/{id}', [\App\Http\Controllers\Admin\ClientController::class, 'update'])->name('admin.clients.update');
        Route::delete('/clients/{id}', [\App\Http\Controllers\Admin\ClientController::class, 'destroy'])->name('admin.clients.destroy');
        
        // Services Routes
        Route::get('/services', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.services.index');
        Route::get('/services/{id}/edit', [\App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('admin.services.update');
        
            // Portfolio Routes
            Route::get('/portfolio', [\App\Http\Controllers\Admin\PortfolioController::class, 'index'])->name('admin.portfolio.index');
            Route::post('/portfolio/toggle-homepage', [\App\Http\Controllers\Admin\PortfolioController::class, 'toggleHomepageVisibility'])->name('admin.portfolio.toggle-homepage');
            Route::get('/portfolio/create', [\App\Http\Controllers\Admin\PortfolioController::class, 'create'])->name('admin.portfolio.create');
            Route::post('/portfolio', [\App\Http\Controllers\Admin\PortfolioController::class, 'store'])->name('admin.portfolio.store');
            Route::get('/portfolio/{id}/edit', [\App\Http\Controllers\Admin\PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
            Route::put('/portfolio/{id}', [\App\Http\Controllers\Admin\PortfolioController::class, 'update'])->name('admin.portfolio.update');
            Route::delete('/portfolio/{id}', [\App\Http\Controllers\Admin\PortfolioController::class, 'destroy'])->name('admin.portfolio.destroy');
            
            // Portfolio Categories Routes
            Route::get('/portfolio/categories', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'index'])->name('admin.portfolio.categories.index');
            Route::get('/portfolio/categories/create', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'create'])->name('admin.portfolio.categories.create');
            Route::post('/portfolio/categories', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'store'])->name('admin.portfolio.categories.store');
            Route::get('/portfolio/categories/{id}/edit', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'edit'])->name('admin.portfolio.categories.edit');
            Route::put('/portfolio/categories/{id}', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'update'])->name('admin.portfolio.categories.update');
            Route::delete('/portfolio/categories/{id}', [\App\Http\Controllers\Admin\PortfolioCategoryController::class, 'destroy'])->name('admin.portfolio.categories.destroy');

            // Team Members Routes
            Route::get('/team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'index'])->name('admin.team.index');
            Route::get('/team/create', [\App\Http\Controllers\Admin\TeamMemberController::class, 'create'])->name('admin.team.create');
            Route::post('/team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'store'])->name('admin.team.store');
            Route::get('/team/{id}/edit', [\App\Http\Controllers\Admin\TeamMemberController::class, 'edit'])->name('admin.team.edit');
            Route::put('/team/{id}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'update'])->name('admin.team.update');
            Route::delete('/team/{id}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'destroy'])->name('admin.team.destroy');

            // Testimonials Routes
            Route::get('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('admin.testimonials.index');
            Route::get('/testimonials/create', [\App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('admin.testimonials.create');
            Route::post('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('admin.testimonials.store');
            Route::get('/testimonials/{id}/edit', [\App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
            Route::put('/testimonials/{id}', [\App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('admin.testimonials.update');
            Route::delete('/testimonials/{id}', [\App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');

            // Contact Routes
            Route::get('/contact', [\App\Http\Controllers\Admin\ContactInfoController::class, 'index'])->name('admin.contact.index');
            Route::get('/contact/edit', [\App\Http\Controllers\Admin\ContactInfoController::class, 'edit'])->name('admin.contact.edit');
            Route::put('/contact', [\App\Http\Controllers\Admin\ContactInfoController::class, 'update'])->name('admin.contact.update');
            Route::post('/contact/messages/{id}/read', [\App\Http\Controllers\Admin\ContactInfoController::class, 'markAsRead'])->name('admin.contact.messages.read');
            Route::delete('/contact/messages/{id}', [\App\Http\Controllers\Admin\ContactInfoController::class, 'deleteMessage'])->name('admin.contact.messages.delete');

            // Why Choose Us Routes
            Route::get('/why-choose-us', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'index'])->name('admin.why-choose-us.index');
            Route::get('/why-choose-us/edit', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'edit'])->name('admin.why-choose-us.edit');
            Route::put('/why-choose-us', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'update'])->name('admin.why-choose-us.update');

            // Test Bookings Routes
            Route::get('/test-bookings', [\App\Http\Controllers\Admin\TestBookingController::class, 'index'])->name('admin.test-bookings.index');
            Route::get('/test-bookings/{id}', [\App\Http\Controllers\Admin\TestBookingController::class, 'show'])->name('admin.test-bookings.show');
            Route::delete('/test-bookings/{id}', [\App\Http\Controllers\Admin\TestBookingController::class, 'destroy'])->name('admin.test-bookings.destroy');

            // Test Pages Routes
            Route::get('/test-pages', [\App\Http\Controllers\Admin\TestPageController::class, 'index'])->name('admin.test-pages.index');
            Route::get('/test-pages/create', [\App\Http\Controllers\Admin\TestPageController::class, 'create'])->name('admin.test-pages.create');
            Route::post('/test-pages', [\App\Http\Controllers\Admin\TestPageController::class, 'store'])->name('admin.test-pages.store');
            Route::get('/test-pages/{id}/edit', [\App\Http\Controllers\Admin\TestPageController::class, 'edit'])->name('admin.test-pages.edit');
            Route::put('/test-pages/{id}', [\App\Http\Controllers\Admin\TestPageController::class, 'update'])->name('admin.test-pages.update');

            // Grade Pages Routes
            Route::get('/grade-pages', [\App\Http\Controllers\Admin\GradePageController::class, 'index'])->name('admin.grade-pages.index');
            Route::get('/grade-pages/{id}/edit', [\App\Http\Controllers\Admin\GradePageController::class, 'edit'])->name('admin.grade-pages.edit');
            Route::put('/grade-pages/{id}', [\App\Http\Controllers\Admin\GradePageController::class, 'update'])->name('admin.grade-pages.update');

            // Career Library Routes
            Route::get('/careers', [\App\Http\Controllers\Admin\CareerController::class, 'index'])->name('admin.careers.index');
            Route::get('/careers/create', [\App\Http\Controllers\Admin\CareerController::class, 'create'])->name('admin.careers.create');
            Route::post('/careers', [\App\Http\Controllers\Admin\CareerController::class, 'store'])->name('admin.careers.store');
            Route::get('/careers/{id}/edit', [\App\Http\Controllers\Admin\CareerController::class, 'edit'])->name('admin.careers.edit');
            Route::put('/careers/{id}', [\App\Http\Controllers\Admin\CareerController::class, 'update'])->name('admin.careers.update');
            Route::delete('/careers/{id}', [\App\Http\Controllers\Admin\CareerController::class, 'destroy'])->name('admin.careers.destroy');

            // Theme Settings Routes
            Route::get('/theme', [\App\Http\Controllers\Admin\ThemeController::class, 'index'])->name('admin.theme.index');
            Route::put('/theme', [\App\Http\Controllers\Admin\ThemeController::class, 'update'])->name('admin.theme.update');
            Route::post('/theme/preset', [\App\Http\Controllers\Admin\ThemeController::class, 'applyPreset'])->name('admin.theme.preset');
            Route::post('/theme/reset', [\App\Http\Controllers\Admin\ThemeController::class, 'reset'])->name('admin.theme.reset');
            Route::post('/theme/preview', [\App\Http\Controllers\Admin\ThemeController::class, 'preview'])->name('admin.theme.preview');
            Route::post('/theme/logo', [\App\Http\Controllers\Admin\ThemeController::class, 'uploadLogo'])->name('admin.theme.logo.upload');
            Route::delete('/theme/logo', [\App\Http\Controllers\Admin\ThemeController::class, 'removeLogo'])->name('admin.theme.logo.remove');

            // Menu Management Routes
            Route::get('/menu', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('admin.menu.index');
            Route::get('/menu/create', [\App\Http\Controllers\Admin\MenuController::class, 'create'])->name('admin.menu.create');
            Route::post('/menu', [\App\Http\Controllers\Admin\MenuController::class, 'store'])->name('admin.menu.store');
            Route::get('/menu/{id}/edit', [\App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('admin.menu.edit');
            Route::put('/menu/{id}', [\App\Http\Controllers\Admin\MenuController::class, 'update'])->name('admin.menu.update');
            Route::delete('/menu/{id}', [\App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('admin.menu.destroy');
            Route::post('/menu/reorder', [\App\Http\Controllers\Admin\MenuController::class, 'reorder'])->name('admin.menu.reorder');
    });
});
