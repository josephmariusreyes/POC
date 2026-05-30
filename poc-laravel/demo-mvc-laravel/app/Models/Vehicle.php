<?php

namespace App\Models;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Vehicle
{
    /**
     * Load the raw vehicle records from the JSON file in public.
     */
    public static function all(): Collection
    {
        $records = json_decode(File::get(public_path('vehicles.json')), true) ?? [];

        return collect($records)->map(function (array $vehicle) {
            return $vehicle;
        });
    }

    /**
     * Paginate the collection manually because this demo is file-backed.
     */
    public static function paginate(int $perPage = 5): LengthAwarePaginator
    {
        $vehicles = static::all()->values();
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
     * Find one vehicle by its id so route-model-style pages can work without a database.
     */
    public static function findOrFail(int $id): array
    {
        return static::all()->firstWhere('id', $id)
            ?? abort(404, 'Vehicle not found.');
    }

    /**
     * Surface a few featured units for the landing page hero section.
     */
    public static function featured(int $limit = 3): Collection
    {
        return static::all()->sortByDesc('year')->take($limit)->values();
    }
}