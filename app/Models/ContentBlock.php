<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CMS-managed HTML fragment identified by a stable slug (About, Mission, Vision, etc.).
 */
class ContentBlock extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'body_html',
    ];
}
