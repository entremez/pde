<?php

use Illuminate\Database\Seeder;

class SurveysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey = new App\Survey();
        $survey->name = 'Encuesta';
        $survey->description = 'Test';
        $survey->active = true;
        $survey->save();

        $question_type = new App\StatementType();
        $question_type->type = "multiple";
        $question_type->description = "Es posible seleccionar varias respuestas de las opciones entregadas";
        $question_type->save();

        $question_type = new App\StatementType();
        $question_type->type = "unique";
        $question_type->description = "Es posible seleccionar solo una de las opciones entregadas";
        $question_type->save();
        $question_type = new App\StatementType();
        $question_type->type = "affirmation";
        $question_type->description = "Dadas afirmaciones se responde en un rango";
        $question_type->save();

        $question_type = new App\StatementType();
        $question_type->type = "enum";
        $question_type->description = "Dadas afirmaciones enumerar por urgencia";
        $question_type->save();

        $question = new App\Statement();
        $question->statement = 'En las siguientes afirmaciones relacionadas con INNOVACIÓN. Marca la opción que corresponda a la realidad de tu empresa.';
        $question->statement_type_id = 3;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestra empresa lanzó nuevos productos/servicios en el último año.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Tenemos mecanismos definidos para el desarrollo de nuevos productos o servicios.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Realizamos actividades para escuchar/observar/conversar con nuestros consumidores e incorporamos lo levantado en nuestros productos/servicios.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Testeamos los nuevos productos/servicios con clientes antes de lanzarlos.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Dejamos de innovar en productos o servicios porque es muy caro y toma demasiado tiempo.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Tenemos identificados y definidos nuestros arquetipos de usuarios (donde arquetipo es una persona ficticia descrita en detalle que resume las características de un grupo de usuarios similares)';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Tenemos claridad de cómo va a estar el mercado en que se inserta nuestro negocio de aquí a 3 años.';
        $response->save();


        $question = new App\Statement();
        $question->statement = 'En las siguientes afirmaciones relacionadas con PRODUCCIÓN. Marca la opción que corresponda a la realidad de tu empresa.';
        $question->statement_type_id = 3;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'La disposición de espacio, el mobiliario y las herramientas utilizadas en mi empresa permiten a los funcionarios generar un alto nivel de satisfacción de los clientes.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Las interfaces de nuestros sistemas digitales permite rápidos tiempos de respuesta del personal, son fáciles de entender, facilitan la producción y minimizan el error.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los documentos que apoyan la producción y el aseguramiento de la calidad de nuestros productos o servicios son efectivamente utilizados en la práctica por nuestros trabajadores.';
        $response->save();


        $question = new App\Statement();
        $question->statement = 'En las siguientes afirmaciones relacionadas con tus PRODUCTOS o SERVICIOS. Marca la opción que corresponda a la realidad de tu empresa.';
        $question->statement_type_id = 3;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios fueron realizados primero con foco en las necesidades del usuario y a partir de eso, con lo que podemos hacer como empresa.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios tienen un significado especial para nuestros usuarios a través de una experiencia que los sorprende.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'La estética de nuestros productos/servicios es significativamente mejor que la de los productos/servicios de la competencia.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestra identidad de marca es significativamente mejor que la de nuestros competidores.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios "cumplen" con lo que necesita el usuario.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios "cumplen" con lo que necesita el usuario y les entregan un plus que no se esperaban.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios son significativamente más deseados por nuestros clientes que los de la competencia.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios son significativamente más fáciles de usar que los de la competencia.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos/servicios tienen un desempeño técnico significativamente mejor que el de la competencia.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros productos tienen un sistema de despacho significativamente mejor que el de nuestros competidores.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Nuestros servicios se prestan a través de canales significativamente mejores que los de nuestros competidores.';
        $response->save();





        $question = new App\Statement();
        $question->statement = 'En las siguientes afirmaciones relacionadas con la VENTA y POST-VENTA. Marca la opción que corresponda a la realidad de tu empresa.';
        $question->statement_type_id = 3;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Permanentemente alineamos la estrategia comercial y de marketing, con los cambios que está experimentando el cliente.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los canales digitales de mi empresa facilitan la compra de mis productos o servicios.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'La forma en que distribuimos los productos o servicios a nuestros clientes les genera una alta satisfacción.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'En nuestra marca (logotipo, slogan, gráfica, entre otros), los clientes logran reconocer de manera clara lo que hacemos y nuestros atributos como empresa (estilo de servicio, calidad u otros).';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Tenemos una buena comunicación con nuestros clientes, ellos saben muy bien lo que les queremos transmitir.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los sistemas de post-venta de mi empresa generan una alta satisfacción de mis clientes.';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los sistemas de post-venta de mi empresa logran mantener la fidelidad del cliente a pesar de los errores que hayan sufrido.';
        $response->save();

        


        $question = new App\Statement();
        $question->statement = 'De las áreas anteriores ENUMERE según prioridad la que considera necesita mejorar con mayor urgencia (donde 1 es mayor urgencia y 4 menor urgencia).';
        $question->statement_type_id = 4;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'INNOVACIÓN';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'PRODUCCIÓN';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'PRODUCTOS/SERVICIOS';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'VENTA Y POST-VENTA';
        $response->save();

        


        $question = new App\Statement();
        $question->statement = 'Indica el o los tipos de diseño que emplea tu compañía';
        $question->statement_type_id = 1;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO GRÁFICO Y DE IMPRESOS';
        $response->info = 'diseño de identidad corporativa y branding, diseño de empaques y packaging, diseño para impresión en papel, diseño de etiquetas, diseño de señalética, diseño de información/infografía, Diseño de lettering, diseño de tipografía';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO PARA SOPORTE DIGITAL';
        $response->info = 'diseño web, experiencia de usuario, interfaz de usuario, diseño de aplicaciones móviles, diseño para redes sociales, diseño audiovisual, diseño motion graphics, diseño de animación 2D y 3D';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO DE OBJETOS INDUSTRIALES';
        $response->info = 'diseño de productos, diseño de moldes y matrices, diseño de piezas, ergonomía aplicada, prototipo de productos';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO DE ESPACIOS Y AMBIENTES';
        $response->info = 'diseño de interiores, diseño de paisajes, diseño de tiendas, diseño de vitrinas, diseño de exhibiciones y stands, diseño museográfico, diseño inmobiliario, diseño de iluminación';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO TEXTIL Y ACCESORIOS DE MODA';
        $response->info = 'diseño de productos textiles, diseño de vestuario, diseño de accesorios';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO DE CREACIÓN O MEJORA DE SERVICIOS';
        $response->info = 'diseño de servicios, neurodiseño, prototipo de servicios';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'DISEÑO EN LA ESTRATEGIA DE LA ORGANIZACIÓN';
        $response->info = 'innovación a través del diseño, diseño estratégico, diseño de procesos, investigación de diseño, diseño de marca y estrategias de marca, diseño territorial';
        $response->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'NO USA DISEÑO';
        $response->save();



        $question = new App\Statement();
        $question->statement = '¿Cuál de las siguientes afirmaciones describe mejor el uso de diseño en tu compañía?';
        $question->statement_type_id = 2;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño es un elemento central en la estrategia de la compañía (los procesos de diseño están alineados con la visión de su compañía)';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño es un elemento integral del desarrollo de productos/servicios en la compañía (el diseño se usa en etapas tempranas del desarrollo de productos/servicios)';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño se usa como terminación, mejorando apariencia y atractivo del producto o servicio final (o de la gráfica de la empresa)';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'No se usa diseño en la compañía';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'No sabe';
        $response->save();

    }
}
