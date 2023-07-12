<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class d_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /***
            $table->string('username');
            $table->string('email');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('password');
            $table->timestamps();       
             */
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'password' => fake()->password(12,20)

        ];
    }
}
