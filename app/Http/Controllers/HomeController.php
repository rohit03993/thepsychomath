<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\WhyUs;
use App\Models\Feature;
use App\Models\Client;
use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\PortfolioCategory;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\ContactInfo;
use App\Models\WhyChooseUs;

class HomeController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::where('is_active', true)->first();
        $whyUs = WhyUs::where('is_active', true)->first();
        $feature = Feature::where('is_active', true)->first();
        $clients = Client::active()->get()->unique('name')->values();
        $service = Service::where('is_active', true)->first();
        $portfolioItems = PortfolioItem::with('category')->active()->get()->unique('id');
        $portfolioCategories = PortfolioCategory::active()->get()->unique('slug');
        $teamMembers = TeamMember::active()->get();
        $testimonials = Testimonial::active()->get();
        $contactInfo = ContactInfo::where('is_active', true)->first();
        $whyChooseUs = WhyChooseUs::where('is_active', true)->first();
        
        // Ensure variables are properly set
        return view('home', [
            'aboutUs' => $aboutUs,
            'whyUs' => $whyUs,
            'feature' => $feature,
            'clients' => $clients,
            'service' => $service,
            'portfolioItems' => $portfolioItems,
            'portfolioCategories' => $portfolioCategories,
            'teamMembers' => $teamMembers,
            'testimonials' => $testimonials,
            'contactInfo' => $contactInfo,
            'whyChooseUs' => $whyChooseUs
        ]);
    }
}

