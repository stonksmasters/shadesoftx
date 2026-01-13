<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test appointment form validation with valid data.
     */
    public function test_appointment_form_validation_with_valid_data(): void
    {
        $response = $this->post('/appointments', [
            'name' => 'John Doe',
            'phone' => '512-555-0199',
            'email' => 'john@example.com',
            'service_type' => 'residential',
            'selected_date' => '2026-01-15',
        ]);

        $response->assertSessionHas('success', 'Appointment booked successfully!');
        $response->assertRedirect();
    }

    /**
     * Test appointment form validation with missing required fields.
     */
    public function test_appointment_form_validation_with_missing_fields(): void
    {
        $response = $this->post('/appointments', [
            'name' => 'John Doe',
            // Missing other required fields
        ]);

        $response->assertSessionHasErrors(['phone', 'email', 'service_type', 'selected_date']);
    }

    /**
     * Test contact form validation with valid data.
     */
    public function test_contact_form_validation_with_valid_data(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '512-555-0100',
            'message' => 'I would like to get a quote for window tinting.',
        ]);

        $response->assertSessionHas('success', 'Message sent successfully!');
        $response->assertRedirect();
    }

    /**
     * Test contact form validation with invalid email.
     */
    public function test_contact_form_validation_with_invalid_email(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Smith',
            'email' => 'invalid-email',
            'phone' => '512-555-0100',
            'message' => 'Test message',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test contact form validation with message too long.
     */
    public function test_contact_form_validation_with_long_message(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '512-555-0100',
            'message' => str_repeat('a', 1001), // Exceeds max:1000
        ]);

        $response->assertSessionHasErrors(['message']);
    }

    /**
     * Test contact form validation with invalid phone number.
     */
    public function test_contact_form_validation_with_invalid_phone(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => 'abc-def-ghij', // Invalid phone format
            'message' => 'Test message',
        ]);

        $response->assertSessionHasErrors(['phone']);
    }
}
