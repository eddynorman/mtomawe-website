<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Hero carousel slide: optional description and ordering for the public landing page.
 */
class CarouselSlide extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'sort_order',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
