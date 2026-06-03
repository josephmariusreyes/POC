<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class InquiryDataService
{
    /**
     * Read the saved inquiry submissions from the public JSON file.
     */
    public function all(): Collection
    {
        $records = json_decode(File::get(public_path('formSubmission.json')), true) ?? [];

        return collect($records)
            ->sortByDesc('submitted_at')
            ->values();
    }

    /**
     * Append a new inquiry record into the JSON file.
     */
    public function create(array $submission): void
    {
        $existing = $this->all()->values()->all();
        $existing[] = $submission;

        File::put(
            public_path('formSubmission.json'),
            json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}