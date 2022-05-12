<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->words(5, true),
      'description' => $this->faker->text,
      'private' => $this->faker->boolean,
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   *
   * @return \Illuminate\Database\Eloquent\Factories\Factory
   */
  public function private()
  {
    return $this->state(function (array $attributes) {
      return [
        'private' => true,
      ];
    });
  }
}
