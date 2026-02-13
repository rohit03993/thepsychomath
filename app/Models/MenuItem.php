<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    protected $fillable = [
        'title',
        'link',
        'type',
        'order',
        'parent_id',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public static function getActiveMenu(): \Illuminate\Database\Eloquent\Collection
    {
        return self::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->get();
    }
}
