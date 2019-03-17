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
        $images = ["1. Agricultura", "2 forestal", "3. pesca", "2. Mineria", "5. Canteria", "3. electricidad" ];

        foreach ($classifications as $key => $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->default_image = $images[$key];
            $classification->save();
        }


        $sector = new App\Sector();
        $sector->name = "Sector secundario";
        $sector->description = "venta de productos elaborados";
        $sector->save();

        $classifications = ["Manufactura", "Construcción", "Venta al por mayor y al detalle" ];   
        $images = ["4. Manufactura", "5. construccion", "6. Retail" ];   

        foreach ($classifications as $key => $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->default_image = $images[$key];
            $classification->save();
        }


        $sector = new App\Sector();
        $sector->name = "Sector terciario";
        $sector->description = "servicios";
        $sector->save();

        $classifications = ["Transporte", "Almacenamiento", "Hotelería y actividades de servicios de comida", "Información y comunicación", "Actividades financieras y de seguros", "Actividades inmobiliarias o de corretaje", "Actividades técnicas, científicas y profesionales", "Actividades administrativas y de soporte", "Administración pública y defensa; seguridad social obligatoria", "Educación", "Salud humana y actividades de trabajo social", "Arte, entretenimiento y recreación", "Otras actividades de servicios" ];
        $images = ["10 transporte", "7. Almacenamiento", "8. restorant 1", "9. comunicacion", "10. financiera", "11. inmobiliaria", "12 ciencias", "13. administracion", "14. seguridad", "15. educacion", "16. medicina", "17. arte", "18.otros servicios" ];

        foreach ($classifications as $key => $value) {
            $classification = new App\Classification;
            $classification->sector_id = $sector->id;
            $classification->classification = $value;
            $classification->default_image = $images[$key];
            $classification->save();
        }


        $business_type = new App\BusinessType();
        $business_type->type = 'B2B';
        $business_type->name = 'business to business';
        $business_type->description = 'si sus clientes son otras empresas';
        $business_type->save();

        $business_type = new App\BusinessType();
        $business_type->type = 'B2C';
        $business_type->name = 'business to customer';
        $business_type->description = 'si sus clientes son personas';
        $business_type->save();

    }
}
