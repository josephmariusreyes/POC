<?php

namespace App\Models;

use App\Services\VehicleDataService;
use Illuminate\Support\Collection;

class Vehicle
{
    /**
     * Load the raw vehicle records from the JSON file in public.
     */
    public static function all(): Collection
    {
        return app(VehicleDataService::class)->all();
    }

    /**
     * Find one vehicle by its id so route-model-style pages can work without a database.
     */
    public static function findOrFail(int $id): array
    {
        return app(VehicleDataService::class)->findOrFail($id);
    }

    /**
     * Surface a few featured units for the landing page hero section.
     */
    public static function featured(int $limit = 3): Collection
    {
        return app(VehicleDataService::class)->featured($limit);
    }
}