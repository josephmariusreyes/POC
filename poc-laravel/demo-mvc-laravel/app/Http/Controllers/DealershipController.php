<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\View\View;

class DealershipController extends Controller
{
    /**
     * Landing page with a small featured inventory selection.
     */
    public function home(): View
    {
        return view('pages.home', [
            'featuredVehicles' => Vehicle::featured(),
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
            'vehicles' => Vehicle::paginate(5),
        ]);
    }

    /**
     * Single vehicle page that also hosts the inquiry form.
     */
    public function vehicleDetails(string $vehicle): View
    {
        return view('pages.vehicles.show', [
            'vehicle' => Vehicle::findOrFail((int) $vehicle),
            'relatedVehicles' => Vehicle::all()
                ->where('id', '!=', (int) $vehicle)
                ->take(3)
                ->values(),
        ]);
    }
}