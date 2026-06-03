<?php

namespace App\Models;

use App\Services\InquiryDataService;
use Illuminate\Support\Collection;

class FormSubmission
{
    /**
     * Read the saved submissions so legacy callers still have access.
     */
    public static function all(): Collection
    {
        return app(InquiryDataService::class)->all();
    }

    /**
     * Append one inquiry into the JSON file so the demo behaves like persistence.
     */
    public static function create(array $submission): void
    {
        app(InquiryDataService::class)->create($submission);
    }
}