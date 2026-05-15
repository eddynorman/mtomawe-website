<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A single gallery photograph with display heading and optional ordering within its category.
 */
class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'heading',
        'image_path',
        'sort_order',
    ];

    /**
     * @return BelongsTo<GalleryCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }
}
