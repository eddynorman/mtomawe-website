<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Public news / announcement entry authored from the admin panel.
 */
class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'body_html',
        'published_at',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope: only published rows with a non-null publish timestamp in the past.
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Post>  $query
     * @return \Illuminate\Database\Eloquent\Builder<Post>
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Public URLs resolve posts by slug instead of numeric id.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
