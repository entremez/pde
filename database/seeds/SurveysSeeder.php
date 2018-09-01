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
        $survey->name = 'Encuesta de prueba';
        $survey->description = 'Es la encuesta utilizada para probar';
        $survey->active = true;
        $survey->save();

        $question_type = new App\QuestionType();
        $question_type->type = "Selección múltiple";
        $question_type->description = "Es posible seleccionar varias respuestas de las opciones entregadas";
        $question_type->save();
        $question_type = new App\QuestionType();
        $question_type->type = "Selección única";
        $question_type->description = "Es posible seleccionar solo una de las opciones entregadas";
        $question_type->save();
        $question_type = new App\QuestionType();
        $question_type->type = "Rango";
        $question_type->description = "Se debe seleccionar entre un rango determinado";
        $question_type->save();

        $question = new App\Question();
        $question->question = '¿Cuál es la línea de estrategia que mejor define a la empresa?';
        $question->question_type_id = 2;
        $question->survey_id = 1;
        $question->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Nos enfocamos en mejorar el valor agregado del producto o servicio';
        $response->weight = 34;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Nos enfocamos en competir por precio / costo';
        $response->weight = 56;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Nos enfocamos en tener una buena distribución / disponibilidad';
        $response->weight = 86;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Nos enfocamos en la innovación';
        $response->weight = 22;
        $response->save();



        $question = new App\Question();
        $question->question = 'Indique el o los tipos de diseño que emplea su compañía';
        $question->question_type_id = 1;
        $question->survey_id = 1;
        $question->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño gráfico y de impresos';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño para soporte digital';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño de objetos industriales';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño de espacios y ambientes';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño textil y accesorios de moda';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño de creación/mejora de servicios';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño estrategia de la organización';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'No usa Diseño';
        $response->weight = 22;
        $response->save();




        $question = new App\Question();
        $question->question = '¿Cuántas veces usó diseño en su compañía en los últimos 3 años?';
        $question->question_type_id = 2;
        $question->survey_id = 1;
        $question->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'De manera constante';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Todos los meses';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = '6 veces al año';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = '3 veces al año';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Sólo 1 vez';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'No sabe';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño estrategia de la organización';
        $response->weight = 22;
        $response->save();




        $question = new App\Question();
        $question->question = '¿Cuál de las siguientes afirmaciones describe mejor las actividades de tu compañía respecto al diseño?';
        $question->question_type_id = 2;
        $question->survey_id = 1;
        $question->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño es un elemento central en la estrategia de la compañía';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño es un elemento integral pero no central del trabajo de desarrollo de la compañía';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Diseño se usa como terminación final, mejorando apariencia y atractivo del producto o servicio final';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'No se usa diseño en la compañía';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'No sabe';
        $response->weight = 22;
        $response->save();




        $question = new App\Question();
        $question->question = 'De las siguientes alternativas, ¿Cuál/es describe/n mejor la forma en que tu empresa desarrolló los productos o servicios que actualmente vendes?';
        $question->question_type_id = 1;
        $question->survey_id = 1;
        $question->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Por experiencia propia, recomendación de otros, porque me los encargaron';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Igualando lo que vende la competencia';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Preguntándole a los clientes y haciendo las mejoras yo mismo/a';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Preguntándole a los clientes y usando especialistas para desarrollarlo';
        $response->weight = 22;
        $response->save();

        $response = new App\ResponseChoice();
        $response->question_id= $question->id;
        $response->response = 'Preguntándole a los clientes, usando especialistas para desarrollarlo y mejorando el producto/servicio iterativamente';
        $response->weight = 22;
        $response->save();




        $surveyQuestion = new App\SurveyQuestion();
        $surveyQuestion->survey_id = 1;
        $surveyQuestion->question_id = 1;
        $surveyQuestion->order = 1;
        $surveyQuestion->save();
        $surveyQuestion = new App\SurveyQuestion();
        $surveyQuestion->survey_id = 1;
        $surveyQuestion->question_id = 2;
        $surveyQuestion->order = 2;
        $surveyQuestion->save();
        $surveyQuestion = new App\SurveyQuestion();
        $surveyQuestion->survey_id = 1;
        $surveyQuestion->question_id = 3;
        $surveyQuestion->order = 3;
        $surveyQuestion->save();
        $surveyQuestion = new App\SurveyQuestion();
        $surveyQuestion->survey_id = 1;
        $surveyQuestion->question_id = 4;
        $surveyQuestion->order = 4;
        $surveyQuestion->save();
        $surveyQuestion = new App\SurveyQuestion();
        $surveyQuestion->survey_id = 1;
        $surveyQuestion->question_id = 5;
        $surveyQuestion->order = 5;
        $surveyQuestion->save();

    }
}
