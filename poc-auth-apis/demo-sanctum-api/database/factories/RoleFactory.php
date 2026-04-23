<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
    public function superAdmin()
    {
        return $this->state(fn () => [
            'name' => 'SuperAdmin',
        ]);
    }

    public function eventOrganizer()
    {
        return $this->state(fn () => [
            'name' => 'EventOrganizer',
        ]);
    }

    public function queAdmin()
    {
        return $this->state(fn () => [
            'name' => 'QueAdmin',
        ]);
    }

    public function queEncoder()
    {
        return $this->state(fn () => [
            'name' => 'QueEncoder',
        ]);
    }
}
