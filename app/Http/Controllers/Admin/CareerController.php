<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    /**
     * Get validation rules for career
     */
    private function getValidationRules($careerId = null): array
    {
        $slugRule = $careerId 
            ? 'required|string|max:255|unique:careers,slug,' . $careerId
            : 'required|string|max:255|unique:careers,slug';

        return [
            'title' => 'required|string|max:255',
            'slug' => $slugRule,
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'scope' => 'nullable|string',
            'who_can_pursue' => 'nullable|string',
            'what_you_get' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Handle image uploads for hero and featured images
     */
    private function handleImageUploads(Request $request, Career $career = null): array
    {
        $images = [];

        if ($request->hasFile('hero_image')) {
            if ($career && $career->hero_image && Storage::disk('public')->exists($career->hero_image)) {
                Storage::disk('public')->delete($career->hero_image);
            }
            $images['hero_image'] = $request->file('hero_image')->store('careers', 'public');
        } elseif ($career) {
            unset($images['hero_image']);
        }

        if ($request->hasFile('featured_image')) {
            if ($career && $career->featured_image && Storage::disk('public')->exists($career->featured_image)) {
                Storage::disk('public')->delete($career->featured_image);
            }
            $images['featured_image'] = $request->file('featured_image')->store('careers', 'public');
        } elseif ($career) {
            unset($images['featured_image']);
        }

        return $images;
    }

    /**
     * Clean and format features array
     */
    private function cleanFeatures(array $features): array
    {
        return array_values(array_filter(array_map('trim', $features)));
    }

    /**
     * Delete career images from storage
     */
    private function deleteCareerImages(Career $career): void
    {
        if ($career->hero_image && Storage::disk('public')->exists($career->hero_image)) {
            Storage::disk('public')->delete($career->hero_image);
        }

        if ($career->featured_image && Storage::disk('public')->exists($career->featured_image)) {
            Storage::disk('public')->delete($career->featured_image);
        }
    }

    public function index()
    {
        $careers = Career::orderBy('order')->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules());

        $images = $this->handleImageUploads($request);
        $validated = array_merge($validated, $images);

        if (isset($validated['features'])) {
            $validated['features'] = $this->cleanFeatures($validated['features']);
        }

        $validated['is_active'] = $request->has('is_active');

        Career::create($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career created successfully!');
    }

    public function edit($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate($this->getValidationRules($id));

        $images = $this->handleImageUploads($request, $career);
        $validated = array_merge($validated, $images);

        if (isset($validated['features'])) {
            $validated['features'] = $this->cleanFeatures($validated['features']);
        }

        $validated['is_active'] = $request->has('is_active');

        $career->update($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career updated successfully!');
    }

    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $this->deleteCareerImages($career);
        $career->delete();

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career deleted successfully!');
    }
}
