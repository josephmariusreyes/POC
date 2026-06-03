<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * The landing page should render the dealership content.
     */
    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('Northstar Auto Gallery');
    }

    /**
     * Inventory should paginate five vehicles per page from the JSON file.
     */
    public function test_vehicle_listing_paginates_five_items_per_page(): void
    {
        $response = $this->get('/vehicles');

        $response
            ->assertStatus(200)
            ->assertSee('Toyota Camry XSE')
            ->assertSee('BMW 330i')
            ->assertDontSee('Hyundai Palisade SEL')
            ->assertSee('Search inventory')
            ->assertSee('All body styles');
    }

    /**
     * Inquiry submissions should be appended to the demo JSON file.
     */
    public function test_vehicle_inquiry_is_saved_to_json_file(): void
    {
        File::put(public_path('formSubmission.json'), json_encode([], JSON_PRETTY_PRINT));

        $response = $this->post('/vehicles/1/inquiry', [
            'name' => 'Demo Customer',
            'contact' => '0917-555-0101',
            'email' => 'demo@example.com',
            'message' => 'Please share the full inspection report.',
        ]);

        $response
            ->assertRedirect('/vehicles/1')
            ->assertSessionHas('status');

        $submissions = json_decode(File::get(public_path('formSubmission.json')), true);

        $this->assertCount(1, $submissions);
        $this->assertSame('Demo Customer', $submissions[0]['name']);
    }

    /**
     * Saved inquiries should be reviewable from the dedicated page.
     */
    public function test_saved_inquiries_page_reads_from_json(): void
    {
        File::put(public_path('formSubmission.json'), json_encode([
            [
                'vehicle_id' => 2,
                'vehicle_name' => '2023 Honda CR-V EX-L',
                'name' => 'Sample Lead',
                'contact' => '0998-200-3000',
                'email' => 'lead@example.com',
                'message' => 'Is this vehicle still available this week?',
                'submitted_at' => '2026-05-30 10:15:00',
            ],
        ], JSON_PRETTY_PRINT));

        $response = $this->get('/inquiries');

        $response
            ->assertStatus(200)
            ->assertSee('Review saved vehicle inquiries')
            ->assertSee('2023 Honda CR-V EX-L')
            ->assertSee('Sample Lead');
    }
}
