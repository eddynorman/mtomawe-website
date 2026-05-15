<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Inbound visitor message from the public contact form.
 */
class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'read_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    /**
     * Whether the message has been reviewed in the admin inbox.
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
}
