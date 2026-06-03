<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class VehicleDataService
{
    /**
     * Load every vehicle record from the JSON file.
     */
    public function all(): Collection
    {
        $records = json_decode(File::get(public_path('vehicles.json')), true) ?? [];

        return collect($records)->map(function (array $vehicle) {
            return $vehicle;
        });
    }

    /**
     * Paginate the in-memory vehicle collection for the inventory page.
     */
    public function paginate(int $perPage = 5): LengthAwarePaginator
    {
        $vehicles = $this->all()->values();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $vehicles->forPage($currentPage, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $vehicles->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    /**
     * Resolve one vehicle by id for the detail page and form submissions.
     */
    public function findOrFail(int $id): array
    {
        return $this->all()->firstWhere('id', $id)
            ?? abort(404, 'Vehicle not found.');
    }

    /**
     * Pick a few newer vehicles for the homepage.
     */
    public function featured(int $limit = 3): Collection
    {
        return $this->all()->sortByDesc('year')->take($limit)->values();
    }

    /**
     * Build filter choices from the loaded inventory so the UI stays in sync with the data.
     */
    public function availableBodyStyles(): Collection
    {
        return $this->all()
            ->pluck('body_style')
            ->unique()
            ->sort()
            ->values();
    }
}