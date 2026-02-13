<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::whereNull('parent_id')
            ->orderBy('order')
            ->with(['children' => function($query) {
                $query->orderBy('order');
            }])
            ->get();

        return view('admin.menu.index', compact('menuItems'));
    }

    public function create()
    {
        $parentMenus = MenuItem::whereNull('parent_id')->orderBy('order')->get();
        $maxOrder = MenuItem::whereNull('parent_id')->max('order') ?? 0;
        
        return view('admin.menu.create', compact('parentMenus', 'maxOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:500',
            'type' => 'required|in:link,dropdown,scroll',
            'order' => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:menu_items,id',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $parentMenus = MenuItem::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('order')
            ->get();

        return view('admin.menu.edit', compact('menuItem', 'parentMenus'));
    }

    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:500',
            'type' => 'required|in:link,dropdown,scroll',
            'order' => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:menu_items,id|different:' . $id,
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        // Delete children first (cascade)
        $menuItem->children()->delete();
        $menuItem->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items');
        
        // Handle JSON string input
        if (is_string($items)) {
            $items = json_decode($items, true);
        }

        if (!is_array($items)) {
            return redirect()->back()->with('error', 'Invalid items data.');
        }

        DB::transaction(function() use ($items) {
            foreach ($items as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    MenuItem::where('id', $item['id'])->update(['order' => (int)$item['order']]);
                }
            }
        });

        return redirect()->back()->with('success', 'Menu order updated successfully.');
    }
}
