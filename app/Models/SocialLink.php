<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Social network link rendered in the public footer (Font Awesome icon class + URL).
 */
class SocialLink extends Model
{
    protected $fillable = [
        'label',
        'icon_class',
        'url',
        'sort_order',
    ];
}
