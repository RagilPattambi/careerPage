<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class careerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'designation' => $this->faker->sentence(),
            'experience' => $this->faker->unique()->numberBetween(1, 10),
            'expiry_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'job_description' => $this->faker->paragraph(5),
        ];
    }
}
