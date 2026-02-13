<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestPageController extends Controller
{
    /**
     * Display a listing of test pages.
     */
    public function index()
    {
        $testPages = TestPage::orderBy('order')->get();
        return view('admin.test-pages.index', compact('testPages'));
    }

    /**
     * Show the form for editing the specified test page.
     */
    public function edit($id)
    {
        $testPage = TestPage::findOrFail($id);
        return view('admin.test-pages.edit', compact('testPage'));
    }

    /**
     * Update the specified test page in storage.
     */
    public function update(Request $request, $id)
    {
        $testPage = TestPage::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:test_pages,slug,' . $id,
            'category' => 'required|string|in:psychological,aptitude,achievement,career,educational,social',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'test_details_key' => 'nullable|array',
            'test_details_value' => 'nullable|array',
            'who_can_take' => 'nullable|string',
            'what_you_get' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            if ($testPage->hero_image && Storage::disk('public')->exists($testPage->hero_image)) {
                Storage::disk('public')->delete($testPage->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('test-pages', 'public');
        } else {
            $validated['hero_image'] = $testPage->hero_image;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            if ($testPage->featured_image && Storage::disk('public')->exists($testPage->featured_image)) {
                Storage::disk('public')->delete($testPage->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('test-pages', 'public');
        } else {
            $validated['featured_image'] = $testPage->featured_image;
        }

        // Process features array (remove empty values)
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($item) {
                return !empty(trim($item));
            });
            $validated['features'] = array_values($validated['features']); // Re-index array
        }

        // Process test_details from form (test_details_key[] and test_details_value[])
        if ($request->has('test_details_key') && $request->has('test_details_value')) {
            $testDetails = [];
            $keys = $request->input('test_details_key', []);
            $values = $request->input('test_details_value', []);
            
            foreach ($keys as $index => $key) {
                $key = trim($key);
                $value = isset($values[$index]) ? trim($values[$index]) : '';
                if (!empty($key) && !empty($value)) {
                    $testDetails[$key] = $value;
                }
            }
            $validated['test_details'] = $testDetails;
        } elseif (isset($validated['test_details'])) {
            // Fallback if sent as array directly
            $testDetails = [];
            foreach ($validated['test_details'] as $key => $value) {
                if (!empty(trim($key)) && !empty(trim($value))) {
                    $testDetails[trim($key)] = trim($value);
                }
            }
            $validated['test_details'] = $testDetails;
        } else {
            $validated['test_details'] = $testPage->test_details;
        }

        $validated['is_active'] = $request->has('is_active');

        $testPage->update($validated);

        return redirect()->route('admin.test-pages.index')
            ->with('success', 'Test page updated successfully!');
    }
}
