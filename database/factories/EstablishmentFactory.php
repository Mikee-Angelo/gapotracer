<?php

namespace Database\Factories;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstablishmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Establishment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'staff_name' => $this->faker->word,
        'address' => $this->faker->text,
        'contact_no' => $this->faker->word,
        'type' => $this->faker->randomElement(['Shop', 'Fastfood', 'Mall', 'Grocery', 'Supermarket', 'Hospital']),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
