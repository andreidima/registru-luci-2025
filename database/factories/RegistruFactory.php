<?php

namespace Database\Factories;

use App\Models\Registru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registru>
 */
class RegistruFactory extends Factory
{
    protected $registru = Registru::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'A' => '2025', // Fixed value for the year
            'B' => '61',   // Fixed district/code
            'C' => (string) $this->faker->numberBetween(1, 10000),
            'D' => 'UAT CIORASTI',  // Fixed locality (or you could choose from an array if you have alternatives)
            'E' => '67',   // Fixed value
            'F' => '715',  // Fixed value
            'G' => (string) $this->faker->numberBetween(5000, 20000),
            'H' => strtoupper($this->faker->name), // Full name in uppercase
            'I' => strtoupper($this->faker->lastName), // Last name in uppercase
            'J' => null,   // Always null
            'K' => strtoupper($this->faker->firstName), // First name in uppercase
            // A long numeric string (about 13 digits); sometimes this field is missing
            'L' => $this->faker->optional(0.7)->numerify(str_repeat('#', 13)),
            // A document number and date in the format "number / dd-mm-yyyy"
            'M' => $this->faker->numberBetween(1, 2000) . ' / ' . $this->faker->dateTimeBetween('-30 years', 'now')->format('d-m-Y'),
            // A description, sometimes provided
            'N' => $this->faker->optional(0.7)->sentence(3),
            // A code like "600N" that is only sometimes present
            'O' => $this->faker->optional(0.3)->bothify('###?'),
            // A 5-digit code (postal or another code)
            'P' => $this->faker->numerify('#####'),
            'Q' => 'E',   // Fixed letter
            'R' => 'A',   // Fixed letter
            'S' => 'UAT CIORASTI',  // Same locality as column D
            // Legal act type chosen from a few options
            'T' => $this->faker->randomElement(['CONVENTIE', 'RECONSTITUIRE', 'SUCCESIUNE']),
            // Process type, either "NOTARIAL" or "ADMINISTRATIV"
            'U' => $this->faker->randomElement(['NOTARIAL', 'ADMINISTRATIV']),
            // A notary or official name chosen from a set of options
            'V' => $this->faker->randomElement([
                'BNP TANASE LUMINITA',
                'BNP NEAMTU ECATERINA',
                'BNP MANOLESCU LUCIANA',
                'BNP OSOIANU LACRAMIOARA',
                'CJSDPAT VRANCEA',
                'BNP POPESCU MIRELA'
            ]),
            // A date in the format "dd-mm-yyyy" (e.g. birth date)
            'W' => $this->faker->dateTimeBetween('1920-01-01', '2000-12-31')->format('d-m-Y'),
        ];
    }
}
