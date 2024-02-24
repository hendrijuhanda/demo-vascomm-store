<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => app('hash')->make('Pass@word1'),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'is_active' => $this->faker->boolean()
        ];
    }
}
