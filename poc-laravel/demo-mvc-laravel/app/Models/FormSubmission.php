<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class FormSubmission
{
    /**
     * Append one inquiry into the JSON file so the demo behaves like persistence.
     */
    public static function create(array $submission): void
    {
        $path = public_path('formSubmission.json');
        $existing = json_decode(File::get($path), true) ?? [];

        $existing[] = $submission;

        File::put($path, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}