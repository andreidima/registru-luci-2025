<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Subcontractant;

class SubcontractantFactory extends Factory
{
    protected $model = Subcontractant::class;

    public function definition()
    {
        // Possible company types
        $tipuri = ['SRL', 'SA', 'PFA', 'II', 'ONG'];

        // Possible contract statuses
        $statusuri = ['Activ', 'Suspendat', 'Încheiat', 'În așteptare'];

        // Possible currencies
        $monede = ['RON', 'EUR', 'USD'];

        // Possible payment terms
        $conditiiPlata = ['30 zile', '60 zile', '90 zile', 'În avans', 'La finalizare'];

        return [
            'nume' => $this->faker->company,
            'tip' => $this->faker->randomElement($tipuri),
            'numar_inregistrare' => strtoupper(Str::random(10)),
            'cod_fiscal' => strtoupper(Str::random(12)),
            'status' => $this->faker->randomElement($statusuri),
            'email' => $this->faker->unique()->safeEmail,
            'telefon' => $this->faker->phoneNumber,
            'adresa' => $this->faker->address,
            'oras' => $this->faker->city,
            'cod_postal' => $this->faker->postcode,
            'tara' => $this->faker->country,
            'data_inceput_contract' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'data_sfarsit_contract' => $this->faker->optional()->dateTimeBetween('now', '+3 years')?->format('Y-m-d'),
            'tarif_orar' => $this->faker->randomFloat(2, 50, 500), // Hourly rate between 50 and 500
            'pret_fix' => $this->faker->randomFloat(2, 5000, 100000), // Fixed price between 5000 and 100000
            'moneda' => $this->faker->randomElement($monede),
            'conditii_plata' => $this->faker->randomElement($conditiiPlata),
            'specializare' => $this->faker->sentence(3), // Example: "Inginerie Civilă"
            'observatii' => $this->faker->optional()->text(500), // Optional long text
        ];
    }
}
