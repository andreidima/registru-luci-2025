<?php

namespace Database\Factories;

use App\Models\Proiect;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProiectFactory extends Factory
{
    protected $model = Proiect::class;

    public function definition()
    {
        // We can also mix in Faker calls for certain fields if needed:
        $faker = $this->faker;

        // Some curated arrays for the fields
        $contractNames = [
            'Contract proiect rezidențial',
            'Contract proiect comercial',
            'Contract de renovare',
            'Contract de consultanță',
            'Contract de extindere clădire',
        ];

        $companyList = [
            'SC Arhitecți Unici SRL',
            'SC Planuri Perfecte SRL',
            'SC Engineering Proiect SRL',
            'SC Urban Planners SRL',
        ];

        $stareList = [
            'Semnat',
            'În curs de semnare',
            'Finalizat',
            'În derulare',
        ];

        $fazeList = [
            'Studiu de fezabilitate',
            'Proiect tehnic',
            'Execuție',
            'Recepție',
            'Finalizat',
        ];

        $observatiiList = [
            'Termen prelungit cu 30 de zile',
            'Necesită aviz ISU suplimentar',
            'În așteptare pentru aprobarea finală',
            'Buget suplimentat recent',
            'Documentație incompletă',
        ];

        return [
            // denumire_contract
            'denumire_contract' => Arr::random($contractNames),

            // nr_contract (something like 'CTR-1234')
            'nr_contract' => 'CTR-' . $faker->unique()->numberBetween(1000, 9999),

            // data_contract (date between last year and now)
            'data_contract' => $faker->dateTimeBetween('-6 months', 'last day of this month')->format('Y-m-d'),

            // data_limita_predare
            'data_limita_predare' => Arr::random([
                'Solicitare prelungire 45 zile',
                '9 luni',
                '3 luni',
                '30 zile lucratoare',
                '6 luni',
                '12 luni',
                '2 luni',
                '45 zile lucratoare',
                'Solicitare prelungire 60 zile',
                'Etapa 1 (45 zile) – PT si DDE',
                'Etapa 2 (max. 12 luni) – Execuție lucrări',
                'Etapa 3 (max. 12 luni) – Asistență tehnică',
                '90 zile lucrătoare',
                'Termen nedeterminat',
                'În curs de stabilire',
            ]),

            // nr_proces_verbal_predare_primire
            'nr_proces_verbal_predare_primire' => 'PV-' . $faker->unique()->numberBetween(1000, 9999),

            // data_proces_verbal_predare_primire
            'data_proces_verbal_predare_primire' => $faker->dateTimeBetween('-1 year', 'now')
                ->format('Y-m-d'),

            // stare_contract
            'stare_contract' => Arr::random($stareList),

            // cu (company name)
            'cu' => Arr::random($companyList),

            // studii_teren
            'studii_teren' => Arr::random([
                'Studiu geotehnic finalizat',
                'Analiză topografică în curs',
                'Documentație cadastrală completă',
                'Studiu geologic suplimentar necesar'
            ]),

            // avize
            'avize' => Arr::random([
                'Aviz primărie aprobat',
                'Aviz mediu în curs',
                'Aviz pompieri obținut',
                'Aviz de mediu respins (în reevaluare)',
            ]),

            // faza
            'faza' => Arr::random($fazeList),

            // arhitectura
            'arhitectura' => Arr::random([
                'Reamenajare spațiu birouri',
                'Construcție bloc P+4',
                'Renovare casă la țară',
                'Extindere clădire industrială',
            ]),

            // rezistenta
            'rezistenta' => Arr::random([
                'Structură metalică',
                'Structură din beton armat',
                'Zidărie portantă',
                'Structură mixtă oțel-beton',
            ]),

            // instalatii
            'instalatii' => Arr::random([
                'Instalații electrice standard',
                'Rețea de apă și canalizare',
                'Sistem de încălzire centrală',
                'Instalații HVAC industriale',
            ]),

            // partea_economica
            'partea_economica' => Arr::random([
                'Buget aprobat',
                'Finanțare parțială',
                'Fonduri europene',
                'Investiție privată',
            ]),

            // autorizatie_de_construire
            'autorizatie_de_construire' => $faker->boolean ? 'Da' : 'Nu',

            // observatii
            'observatii' => Arr::random($observatiiList),
        ];
    }
}
