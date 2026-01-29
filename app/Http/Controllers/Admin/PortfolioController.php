<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Models\PortfolioCategory;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories with their items
        $categories = PortfolioCategory::with(['portfolioItems' => function($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();
        
        // Also get items without categories (orphaned items)
        $orphanedItems = PortfolioItem::whereNull('portfolio_category_id')
            ->orWhereNotIn('portfolio_category_id', PortfolioCategory::pluck('id'))
            ->orderBy('order')
            ->get();

        $showOnHomepage = optional(ThemeSetting::getActive())->getAttribute('show_portfolio') !== false;
        
        return view('admin.portfolio.index', compact('categories', 'orphanedItems', 'showOnHomepage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PortfolioCategory::active()->orderBy('order')->get();
        return view('admin.portfolio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle thumbnail upload (optional)
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('portfolio/thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        } else {
            $validated['thumbnail'] = $validated['image']; // Use main image as thumbnail if not provided
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? PortfolioItem::max('order') + 1;

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolioItem = PortfolioItem::with('category')->findOrFail($id);
        $categories = PortfolioCategory::active()->orderBy('order')->get();
        return view('admin.portfolio.edit', compact('portfolioItem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists (only for local storage, not external URLs)
            if ($portfolioItem->image && !str_starts_with($portfolioItem->image, 'http')) {
                if (Storage::disk('public')->exists($portfolioItem->image)) {
                Storage::disk('public')->delete($portfolioItem->image);
                }
            }
            
            $imagePath = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = $portfolioItem->image;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists (only for local storage, not external URLs)
            if ($portfolioItem->thumbnail && !str_starts_with($portfolioItem->thumbnail, 'http')) {
                if (Storage::disk('public')->exists($portfolioItem->thumbnail)) {
                Storage::disk('public')->delete($portfolioItem->thumbnail);
                }
            }
            
            $thumbnailPath = $request->file('thumbnail')->store('portfolio/thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        } else {
            $validated['thumbnail'] = $portfolioItem->thumbnail ?? $validated['image'];
        }

        $validated['is_active'] = $request->has('is_active');

        $portfolioItem->update($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        
        // Delete images if exists (only for local storage, not external URLs)
        if ($portfolioItem->image && !str_starts_with($portfolioItem->image, 'http')) {
            if (Storage::disk('public')->exists($portfolioItem->image)) {
            Storage::disk('public')->delete($portfolioItem->image);
            }
        }
        if ($portfolioItem->thumbnail && !str_starts_with($portfolioItem->thumbnail, 'http') && $portfolioItem->thumbnail !== $portfolioItem->image) {
            if (Storage::disk('public')->exists($portfolioItem->thumbnail)) {
            Storage::disk('public')->delete($portfolioItem->thumbnail);
            }
        }
        
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item deleted successfully!');
    }

    /**
     * Toggle whether the Portfolio section is shown on the homepage (even when empty).
     */
    public function toggleHomepageVisibility(Request $request)
    {
        $theme = ThemeSetting::getActive();
        if (!$theme) {
            $theme = new ThemeSetting();
            $theme->is_active = true;
            $theme->save();
        }
        $theme->show_portfolio = $request->boolean('show_portfolio');
        $theme->save();

        return redirect()->route('admin.portfolio.index')
            ->with('success', $theme->show_portfolio ? 'Portfolio section is now visible on the homepage.' : 'Portfolio section is now hidden on the homepage.');
    }
}