<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model for a single key/value site configuration row (theme + contact metadata).
 */
class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];
}
