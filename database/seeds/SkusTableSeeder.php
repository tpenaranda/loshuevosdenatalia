<?php

use App\Sku;
use Illuminate\Database\Seeder;

class SkusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skus = [
            [
                'name' => 'Pequeño [8 cm]',
                'price' => 80,
            ],
            [
                'name' => 'Grande [12 cm]',
                'price' => 120,
            ],
            [
                'name' => 'Gigante [30 cm]',
                'price' => 1050,
            ],
        ];

        foreach ($skus as $sku) {
            Sku::updateOrCreate(['slug' => str_slug($sku['name'])], [
                'name' => $sku['name'],
                'price' => $sku['price'],
            ]);
        }
    }
}
