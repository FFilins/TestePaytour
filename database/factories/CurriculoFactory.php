<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculo>
 */
class CurriculoFactory extends Factory
{
    private array $escolaridades = [
        'fundamental-incompleto',
        'fundamental-completo',
        'medio-incompleto',
        'medio-completo',
        'superior-incompleto',
        'superior-completo',
        
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'telefone' => $this->faker->phoneNumber(),
            'cargo' => $this->faker->word,
            'escolaridade' => $this->faker->randomElement($this->escolaridades),
            'observacoes' => $this->faker->sentence(),

        ];
    }
}
