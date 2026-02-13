<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_description',
        'content',
        'hero_image',
        'featured_image',
        'features',
        'test_details',
        'who_can_take',
        'what_you_get',
        'order',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'features' => 'array',
        'test_details' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
