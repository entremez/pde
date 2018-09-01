<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('resources/assets/comunas-regiones.json');
        $data = json_decode($json, true);
        foreach ($data['regiones'] as $obj) {
          App\City::create([
            'region' => $obj['region']
          ]);
        }
        foreach ($data['constantes'] as $obj) {
            foreach ($obj['trabajadores'] as $emp) {
                App\Employees::create([
                'range' => $emp
                ]);
            }
            foreach ($obj['facturacion'] as $emp) {
                App\Gain::create([
                'range' => $emp
                ]);
            }
        }
    }
}
