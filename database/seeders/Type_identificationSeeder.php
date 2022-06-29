<?php

namespace Database\Seeders;

use App\Models\Type_identification;
use Illuminate\Database\Seeder;

class Type_identificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'CC',
            'TI',
            'RC',
            'CE'
        ];

        foreach ($types as $value){
            Type_identification::create([
                'name' => $value
            ]);
        }
    }
}
