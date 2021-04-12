<?php

namespace Database\Factories;

use App\Models\Statistics;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StatisticsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistics::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link' =>$this->faker->domainName,
            'link_type' => $this->faker->randomElement(['product', 'category', 'static-page', 'checkout', 'homepage']),
            'customer_uuid' => $this->faker->uuid,
        ];
    }
}
