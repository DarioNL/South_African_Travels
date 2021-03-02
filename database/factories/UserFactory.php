<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'city' => $this->faker->city,
            'address' => $this->faker->streetName,
            'zipcode' => '2603 WK',
            'house_number' => $this->faker->numberBetween('1', '130'),
            'phone' => $this->faker->phoneNumber,
            'password' => Hash::make('@SAD2020'),
            'remember_token' => Str::random(10),
        ];
    }
}
