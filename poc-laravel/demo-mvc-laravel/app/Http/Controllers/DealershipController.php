<?php

namespace App\Http\Controllers;

use App\Services\InquiryDataService;
use App\Services\VehicleDataService;
use Illuminate\View\View;

class DealershipController extends Controller
{
    public function __construct(
        protected VehicleDataService $vehicles,
        protected InquiryDataService $inquiries,
    ) {
    }

    /**
     * Landing page with a small featured inventory selection.
     */
    public function home(): View
    {
        return view('pages.home', [
            'featuredVehicles' => $this->vehicles->featured(),
        ]);
    }

    /**
     * Static about page for the dummy dealership.
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Inventory page with manual pagination over the JSON file.
     */
    public function vehicles(): View
    {
        return view('pages.vehicles.index', [
            'vehicles' => $this->vehicles->paginate(5),
            'bodyStyles' => $this->vehicles->availableBodyStyles(),
        ]);
    }

    /**
     * Single vehicle page that also hosts the inquiry form.
     */
    public function vehicleDetails(string $vehicle): View
    {
        $vehicleId = (int) $vehicle;

        return view('pages.vehicles.show', [
            'vehicle' => $this->vehicles->findOrFail($vehicleId),
            'relatedVehicles' => $this->vehicles->all()
                ->where('id', '!=', $vehicleId)
                ->take(3)
                ->values(),
        ]);
    }

    /**
     * Review page for saved inquiries stored in the public JSON file.
     */
    public function inquiries(): View
    {
        return view('pages.inquiries.index', [
            'inquiries' => $this->inquiries->all(),
        ]);
    }
}