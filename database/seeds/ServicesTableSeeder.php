<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Diseño gráfico y de impresos";
        $category->description = "Diseño gráfico y de impresos";
        $category->save();

        $service = new Service();
        $service->name="Diseño de identidad corporativa y branding";
        $service->description="Diseño de identidad corporativa y branding";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de empaques/ packaging";
        $service->description="Diseño de empaques/ packaging";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de impresión en papel";
        $service->description="Diseño de impresión en papel";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de etiquetas";
        $service->description="Diseño de etiquetas";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de señalética";
        $service->description="Diseño de señalética";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de información/ infografía";
        $service->description="Diseño de información/ infografía";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de lettering";
        $service->description="Diseño de lettering";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de tipografía";
        $service->description="Diseño de tipografía";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Direccion de arte";
        $service->description="Direccion de arte";
        $service->category_id=$category->id;
        $service->save();



        $category = new Category();
        $category->name = "Diseño para soportes digitales";
        $category->description = "Diseño para soportes digitales";
        $category->save();

        $service = new Service();
        $service->name="Diseño web";
        $service->description="Diseño web";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="UX (experiencia usuario)";
        $service->description="UX (experiencia usuario)";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="UI (interfaz de usuario)";
        $service->description="UI (interfaz de usuario)";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de aplicaciones moviles";
        $service->description="Diseño de aplicaciones moviles";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño para redes sociales";
        $service->description="Diseño para redes sociales";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño audiovisual";
        $service->description="Diseño audiovisual";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño motion graphics";
        $service->description="Diseño motion graphics";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de animación 2d y 3d";
        $service->description="Diseño de animación 2d y 3d";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de juegos";
        $service->description="Diseño de juegos";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño interactivo";
        $service->description="Diseño interactivo";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de softwares";
        $service->description="Diseño de softwares";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de presentaciones digitales";
        $service->description="Diseño de presentaciones digitales";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño de objetos industriales";
        $category->description = "Diseño de objetos industriales";
        $category->save();

        $service = new Service();
        $service->name="Diseño de producto";
        $service->description="Diseño de producto";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de moldes y matrices";
        $service->description="Diseño de moldes y matrices";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de piezas";
        $service->description="Diseño de piezas";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Ergonomía aplicada";
        $service->description="Ergonomía aplicada";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Prototipo de productos";
        $service->description="Prototipo de productos";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño de espacios y ambiente";
        $category->description = "Diseño de espacios y ambiente";
        $category->save();

        $service = new Service();
        $service->name="Diseño de interiores";
        $service->description="Diseño de interiores";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de paisajes";
        $service->description="Diseño de paisajes";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de tiendas";
        $service->description="Diseño de tiendas";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de vitrinas";
        $service->description="Diseño de vitrinas";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de exhibiciones y stands";
        $service->description="Diseño de exhibiciones y stands";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño museográfico";
        $service->description="Diseño museográfico";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de mobiliario";
        $service->description="Diseño de mobiliario";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de Iluminación";
        $service->description="Diseño de Iluminación";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño textil y accesorios de moda";
        $category->description = "Diseño textil y accesorios de moda";
        $category->save();

        $service = new Service();
        $service->name="Diseño de productos textiles";
        $service->description="Diseño de productos textiles";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de vestuario";
        $service->description="Diseño de vestuario";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de accesorios";
        $service->description="Diseño de accesorios";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño para la creación/mejora de servicios";
        $category->description = "Diseño para la creación/mejora de servicios";
        $category->save();

        $service = new Service();
        $service->name="Diseño de servicio";
        $service->description="Diseño de servicio";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Neurodiseño";
        $service->description="Neurodiseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Prototipo de servicios";
        $service->description="Prototipo de servicios";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño en la estrategia de la organización";
        $category->description = "Diseño en la estrategia de la organización";
        $category->save();

        $service = new Service();
        $service->name="Innovación por diseño";
        $service->description="Innovación por diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño estratégico";
        $service->description="Diseño estratégico";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de procesos";
        $service->description="Diseño de procesos";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Investigación";
        $service->description="Investigación";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de marca y estrategia de marca";
        $service->description="Diseño de marca y estrategia de marca";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño territorial";
        $service->description="Diseño territorial";
        $service->category_id=$category->id;
        $service->save();



        $category = new Category();
        $category->name = "Formación en diseño";
        $category->description = "Formación en diseño";
        $category->save();

        $service = new Service();
        $service->name="Diseño de instrucciones";
        $service->description="Diseño de instrucciones";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Formación de diseño";
        $service->description="Formación de diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Workshop de diseño";
        $service->description="Workshop de diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Charlas de diseño";
        $service->description="Charlas de diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Clases de programas de diseño";
        $service->description="Clases de programas de diseño";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Proveedores relacionados con diseño";
        $category->description = "Proveedores relacionados con diseño";
        $category->save();

        $service = new Service();
        $service->name="Fabricación digital";
        $service->description="Fabricación digital";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Desarrollo de render";
        $service->description="Desarrollo de render";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Metodología";
        $service->description="Metodología";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Historia del diseño";
        $service->description="Historia del diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Teoría del diseño";
        $service->description="Teoría del diseño";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Patentamiento";
        $service->description="Patentamiento";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Propiedad intelectual";
        $service->description="Propiedad intelectual";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Fotografía";
        $service->description="Fotografía";
        $service->category_id=$category->id;
        $service->save();

    }
}
