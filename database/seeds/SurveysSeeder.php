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

        $question = new App\Statement();
        $question->statement = 'En las siguientes afirmaciones relacionadas con PRODUCTIVIDAD. Marca la opción que corresponda a la realidad de tu empresa.';
        $question->statement_type_id = 3;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'La disposición de espacio, el mobiliario y las herramientas utilizadas en mi empresa permiten a los funcionarios generar un nivel alto de satisfacción de los clientes.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Las interfaces de nuestros sistemas digitales permite rápidos tiempos de respuesta del personal, son fáciles de entender, facilitan la producción y minimizan el error.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los trabajadores en mi empresa cuentan con un sistema formal de coordinación de tareas.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los documentos que apoyan la producción y el aseguramiento de la calidad de nuestros productos o servicios son realmente utilizados en la práctica por nuestros trabajadores.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Los procesos y procedimientos de mi empresa permiten generan una alta satisfacción de los clientes.';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'La forma en que distribuimos los productos o servicios a nuestros clientes les genera una alta satisfacción.';
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



        $question = new App\Statement();
        $question->statement = '¿Cuál de las siguientes afirmaciones describe mejor el uso de diseño en tu compañía?';
        $question->statement_type_id = 2;
        $question->survey_id = 1;
        $question->save();

        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño es un elemento central en la estrategia de la compañía';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño es un elemento integral pero no central del trabajo de desarrollo de la compañía';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'No se usa diseño en la compañía';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'Diseño se usa como terminación final, mejorando apariencia y atractivo del producto o servicio final';
        $response->save();


        $response = new App\Option();
        $response->statement_id= $question->id;
        $response->option = 'No sabe';
        $response->save();

    }
}
