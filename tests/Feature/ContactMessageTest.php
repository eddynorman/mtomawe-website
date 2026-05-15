<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Ensures the public contact form validates input and persists {@see ContactMessage} rows.
 */
class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_creates_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Ada Visitor',
            'phone' => '+254 700 111222',
            'email' => 'ada@example.com',
            'message' => 'We would love to book a school trip.',
        ]);

        $response->assertRedirect(route('contact.create'));
        $response->assertSessionHas('status');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'ada@example.com',
        ]);
        $this->assertSame(1, ContactMessage::query()->count());
    }

    public function test_contact_form_validation_errors(): void
    {
        $response = $this->from(route('contact.create'))->post(route('contact.store'), [
            'name' => '',
            'phone' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'phone', 'email', 'message']);
        $this->assertSame(0, ContactMessage::query()->count());
    }
}
