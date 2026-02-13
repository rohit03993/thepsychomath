<?php

namespace App\Http\Controllers;

use App\Models\TestPage;
use Illuminate\Http\Request;

class TestPageController extends Controller
{
    /**
     * Display a listing of all test pages
     */
    public function index()
    {
        $testPages = TestPage::where('is_active', true)
            ->where('category', 'psychological')
            ->orderBy('order')
            ->get();
        
        return view('test-pages.index', compact('testPages'));
    }

    /**
     * Display the specified test page
     */
    public function show($slug)
    {
        $testPage = TestPage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Get related test pages (excluding current)
        $relatedPages = TestPage::where('is_active', true)
            ->where('id', '!=', $testPage->id)
            ->orderBy('order')
            ->limit(6)
            ->get();
        
        return view('test-pages.show', compact('testPage', 'relatedPages'));
    }
}
