<?php

namespace App\Http\Controllers;

use App\Services\InquiryDataService;
use App\Services\VehicleDataService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehicleInquiryController extends Controller
{
    public function __construct(
        protected VehicleDataService $vehicles,
        protected InquiryDataService $inquiries,
    ) {
    }

    /**
     * Validate and store one inquiry in a JSON file instead of a database table.
     */
    public function store(Request $request, string $vehicle): RedirectResponse
    {
        $vehicleRecord = $this->vehicles->findOrFail((int) $vehicle);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $this->inquiries->create([
            'vehicle_id' => $vehicleRecord['id'],
            'vehicle_name' => $vehicleRecord['year'].' '.$vehicleRecord['make'].' '.$vehicleRecord['model'],
            'name' => $validated['name'],
            'contact' => $validated['contact'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'submitted_at' => now()->toDateTimeString(),
        ]);

        return redirect()
            ->route('vehicles.show', $vehicleRecord['id'])
            ->with('status', 'Your inquiry has been saved to formSubmission.json.');
    }
}