<?php

use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sector = new App\Sector();
        $sector->name = "Sector primario";
        $sector->description = "explotación de materias primas";
        $sector->save();



        $classifications = ["Agricultura", "Forestal", "Pesca", "Minería", "Cantería", "Servicios básicos (electricidad, gas, agua, manejo de desechos)" ];
        foreach ($classifications as $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->save();
        }


        $sector = new App\Sector();
        $sector->name = "Sector secundario";
        $sector->description = "venta de productos elaborados";
        $sector->save();

        $classifications = ["Manufactura", "Construcción", "Venta al por mayor y al detalle" ];

        foreach ($classifications as $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->save();
        }


        $sector = new App\Sector();
        $sector->name = "Sector terciario";
        $sector->description = "servicios";
        $sector->save();

        $classifications = ["Transporte", "Almacenamiento", "Hotelería y actividades de servicios de comida", "Información y comunicación", "Actividades financieras y de seguros", "Actividades inmobiliarias o de corretaje", "Actividades técnicas, científicas y profesionales", "Actividades administrativas y de soporte", "Administración pública y defensa; seguridad social obligatoria", "Educación", "Salud humana y actividades de trabajo social", "Arte, entretenimiento y recreación", "Otras actividades de servicios" ];

        foreach ($classifications as $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->save();
        }

    }
}
