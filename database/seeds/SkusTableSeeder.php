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
        collect([
            [
                'name' => 'Pequeño',
                'price' => 80,
            ],
            [
                'name' => 'Grande',
                'price' => 120,
            ],
            [
                'name' => 'Gigante',
                'price' => 1050,
            ],
        ])->mapInto(Sku::class)->each->save();
    }
}
