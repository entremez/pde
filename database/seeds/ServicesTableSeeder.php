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
        $service->description="Área del diseño que se hace cargo de los elementos de la imagen externa e interna de la compañía de manera estratégica, para generar
imágenes deseadas en la mente del consumidor.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de empaques/ packaging";
        $service->description="Área del diseño que se hace cargo de los empaques de un producto, teniendo como fundamento la comunicación visual, materiales y tecnologías de producción.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de impresión en papel";
        $service->description="Área del diseño que se hace cargo de transmitir información, a través de la comunicación visual impresa en papel.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de etiquetas";
        $service->description="Área del diseño que se hace cargo de la etiqueta de un producto, transmitiendo información sobre éste. (puede ser parte de una empaque o estar adherida al producto).";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de señalética";
        $service->description="Área del diseño que estudia el empleo de signos gráficos para orientar a las personas en un espacio determinado e informar de los servicios que se encuentran a su disposición.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de información/ infografía";
        $service->description="Área del diseño que se hace cargo de traducir data compleja, desorganizada y sin estructurada, transformándola en información accesible, útil y comprensible.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de lettering";
        $service->description="Área del diseño que se hace cargo de la creación de letras dibujadas a mano.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de tipografía";
        $service->description="Área del diseño que se hace cargo de la creación de tipos (agrupación de letras) y familias tipográficas, con una unidad estilística compartida, teniendo en consideración elementos de arte y ciencia.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Direccion de arte";
        $service->description="Área del diseño que se hace cargo de la articulación de manera sistémica para un resultado creativo, pensados sobre la base de comunicar un mensaje específico.";
        $service->category_id=$category->id;
        $service->save();



        $category = new Category();
        $category->name = "Diseño para soportes digitales";
        $category->description = "Diseño para soportes digitales";
        $category->save();

        $service = new Service();
        $service->name="Diseño web";
        $service->description="Área del diseño que se hace cargo de la concepción, diseño y estructura de sitios web, además, de la navegación y el diseño de interfaz de servicios de información y aplicaciones 
del world wide web (www).";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="UX (experiencia usuario)";
        $service->description="Área del diseño que se hace cargo de la investigación de la experiencia del usuario en relación al producto digital.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="UI (interfaz de usuario)";
        $service->description="Área del diseño que se hace cargo de la interacción entre seres humanos y máquinas. El objetivo de esta interacción es permitir el funcionamiento y control más efectivo de la máquina considerando aspectos como la cognición, la ergonomía y la customización.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de aplicaciones moviles";
        $service->description="Área del diseño que se hace cargo del desarrollo de aplicaciones móviles, es similar al desarrollo de aplicaciones web, y tiene sus raíces en el desarrollo de software más tradicional.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño para redes sociales";
        $service->description="Área del diseño que se hace cargo de la combinación entre las redes sociales con las redes computacionales, para generar un nuevo medio de interacción social.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño audiovisual";
        $service->description="Área del diseño que se hace cargo de integrar el sonido con imágenes en movimiento. También, es conocido como “time-based design” o “motion design”.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño motion graphics";
        $service->description="Área del diseño que se hace cargo de la creación de animaciones digitales, haciendo ilusión de movimiento y comúnmente combinado con audio para uso en proyectos multimedia.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de animación 2D y 3D";
        $service->description="Área del diseño que se hace cargo de crear imágenes y efectos para la televisión, películas, sitios webs y juegos de video con las últimas tecnologías.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de juegos";
        $service->description="Área del diseño que se hace cargo de crear juegos, donde el sistema de significados es entregado por de un set de reglas, que indirectamente determina la experiencia del jugador. ";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño interactivo";
        $service->description="Área del diseño que se hace cargo del diseño de espacios interactivos para apoyar la forma en que la gente se comunica e interactúa con su vida y quehacer diario. Es el diseño de la interacción entre el usuario y el producto. ";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de softwares";
        $service->description="Área del diseño que se hace cargo de crear especificaciones para el programa, el cual está intencionado para cumplir objetivos determinados, usando componentes y requisitos. 
Actividades en torno a la conceptualización, marco, implementación y modificación de
sistemas.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de presentaciones digitales";
        $service->description="Área del diseño que se hace cargo de realizar presentaciones visuales que tiene componentes y contenidos que son accesibles a través de la tecnología, con el fin de mostrar el mensaje e ilustrar su material.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño de objetos industriales";
        $category->description = "Diseño de objetos industriales";
        $category->save();

        $service = new Service();
        $service->name="Diseño de producto";
        $service->description="Área del diseño que se hace cargo de la creación de objetos que son a la vez funcionales y estéticos. Estos productos no son específicos a un estatus limitado sino que se extienden desde lo mundano, objetos cotidianos, hasta items de lujo o exóticos.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de moldes y matrices";
        $service->description="Área del diseño que se hace cargo de crear un soporte (marco rígido) para dar forma a materiales brutos en el proceso de manufactura.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de piezas";
        $service->description="Área del diseño que se hace cargo de la creación de las partes y elementos de un todo y están conectados de acuerdo a un grupo de reglas y leyes.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Ergonomía aplicada";
        $service->description="Área del diseño que se hace cargo de la comprensión de las interacciones entre los seres humanos y los elementos de un sistema, con el fin de aplicar teoría, principios, datos y métodos de diseño para optimizar el bienestar humano y todo el desempeño del sistema.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Prototipo de productos";
        $service->description="Herramienta del diseño que se hace cargo de crear pruebas con la intención de testear las funciones y el desempeño de un nuevo diseño antes de ir a producción.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño de espacios y ambiente";
        $category->description = "Diseño de espacios y ambiente";
        $category->save();

        $service = new Service();
        $service->name="Diseño de interiores";
        $service->description="Área del diseño que se hace cargo de la planificación del espacio, iluminación y comunicación de temas pragmáticos referentes al comportamiento del usuario, accesibilidad, actividades llevadas a cabo en dicho espacio, como también la decoración y mobiliario.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de paisajes";
        $service->description="Área del diseño que se hace cargo de plasmar una idea de paisaje en un proyecto material. Transformando el área y determinando la distribución de las actividades en el tiempo y el espacio.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de tiendas";
        $service->description="Área del diseño que se hace cargo de las decisiones de construcción y habilitación de un espacio de retail.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de vitrinas";
        $service->description="Área del diseño que se hace cargo de la comunicación comercial, mediante la utilización de diferentes estímulos sensoriales, influyendo sobre las decisiones de compra de los clientes
desde el exterior de los establecimientos.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de exhibiciones y stands";
        $service->description="Área del diseño que se hace cargo de la creación de mobiliario y complementos para exposiciones, temáticas de museos, colecciones, ferias y tiendas por departamentos.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño museográfico";
        $service->description="Área del diseño que se hace cargo del conjunto de técnicas desarrolladas para llevar a cabo las funciones museales, y particularmente las que conciernen al acondicionamiento del museo, la conservación, la restauración, la seguridad y la exposición.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de mobiliario";
        $service->description="Área del diseño que se hace cargo de la micro-arquitectura de sentarse, reclinar, reposar, guardar y mostrar. Sus productos incluyen sillas, bancas, sofás, taburetes, camas , gabinetes, repisas, escritorios y mesas, entre otros.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de Iluminación";
        $service->description="Área del diseño que se hace cargo del proceso de diseño de iluminación de espacios, tomando en cuenta factores humanos, evaluación técnica, estética e impacto ambiental. 
Es un término relacionado a múltiples áreas profesionales: iluminación arquitectónica, iluminación teatral, iluminación con luz día y diseñadores de productos de iluminación.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño textil y accesorios de moda";
        $category->description = "Diseño textil y accesorios de moda";
        $category->save();

        $service = new Service();
        $service->name="Diseño de productos textiles";
        $service->description="Área del diseño que se hace cargo de telas hecha de una red de fibras naturales o artificiales. Puede satisfacer un enorme rango de requerimientos desde lo estrictamente utilitario hasta lo puramente decorativo.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de vestuario";
        $service->description="Área del diseño que se hace cargo del diseño de ropa, creados dentro de las influencias culturales y sociales de un período de tiempo específico.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de accesorios";
        $service->description="Área del diseño que se hace cargo de aquello que es de complemento, que depende de lo principal o qué se le une por accidente. Son creación de elementos usables, desde utensilios hasta accesorios de vestir.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño para la creación/mejora de servicios";
        $category->description = "Diseño para la creación/mejora de servicios";
        $category->save();

        $service = new Service();
        $service->name="Diseño de servicios";
        $service->description="Área del diseño que se hace cargo de crear servicios desde la perspectiva del cliente.
Apunta que las interfaces del servicio sean útiles, usables y deseables desde el punto de vista del cliente como a la vez efectiva, eficiente y distintiva desde el punto de vista del proveedor.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Neurodiseño";
        $service->description="Área del diseño que se hace cargo de entender los detonantes detrás de una buena experiencia del usuario y usarlas para ayudar a tomar mejores decisiones de diseño basadas en su comportamiento.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Prototipo de servicios";
        $service->description="Herramienta del diseño que se hace cargo de crear pruebas con la intención de testear el servicio puesto en el lugar, situación y condiciones donde se desarrollaría.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Diseño en la estrategia de la organización";
        $category->description = "Diseño en la estrategia de la organización";
        $category->save();

        $service = new Service();
        $service->name="Innovación por diseño";
        $service->description="Área del diseño que plantea el diseño como fuente para la definición de proyectos de innovación, el pensamiento de diseño se puede aplicar en un entorno de negocios identificando verdaderas necesidades y capturando insights que permitan a las empresas entregar soluciones que los clientes aun no se imaginan.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño estratégico";
        $service->description="Área del diseño que se hace cargo de promover el desempeño y eficacia de la compañía desde la mirada de sus diseñadores, consumidores y competidores.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de procesos";
        $service->description="Área del diseño que se hace cargo de las prácticas a nivel micro y macro para planificar e implementar procesos relativos al diseño en el contexto del desempeño del modelo de negocio.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Investigación";
        $service->description="Área del diseño que se hace cargo del levantamiento y análisis de información de variadas fuentes con el fin de nutrir el proceso de diseño.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño de marca y estrategia de marca";
        $service->description="Área del diseño que se hace cargo de definir lo que se quiere representar, la promesa que se hace
y la personalidad que se traduce.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Diseño territorial";
        $service->description="Área del diseño que se hace cargo de diferentes niveles disciplinarios (diseño estratégico, diseño de servicios, diseño de comunicación, diseño de producto) con diferentes enfoques (de gestión, estratégicos, sociales, económicos, etc.) para promover procesos de innovación sistémica (social, económico, tecnológico) a partir de los recursos territoriales.";
        $service->category_id=$category->id;
        $service->save();



        $category = new Category();
        $category->name = "Formación en diseño";
        $category->description = "Formación en diseño";
        $category->save();

        $service = new Service();
        $service->name="Diseño instruccional";
        $service->description="Área del diseño que coordina acciones estratégicas que orientan la labor docente desde el diseño, producción, implementación y evaluación de una situación de aprendizaje, obedeciendo a uno o varios modelos pedagógicos y aprovechando las posibilidades que ofrecen los recursos educativos y medios didácticos (mediación) y los ambientes virtuales de aprendizaje.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Formación de diseño";
        $service->description="Área pedagógica que prepara intelectual, moral o profesionalmente a una persona o a un grupo de personas en el ámbito del diseño.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Workshop de diseño";
        $service->description="Taller en torno al diseño; curso, generalmente breve, en el que se enseña una determinada actividad práctica o artística.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Charlas de diseño";
        $service->description="Disertación de temas de diseño ante un público, sin solemnidad ni excesivas preocupaciones formales.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Clases de programas de diseño";
        $service->description="Cursos de diseño que que se insertan en un programa lectivo de la disciplina.";
        $service->category_id=$category->id;
        $service->save();


        $category = new Category();
        $category->name = "Proveedores relacionados con diseño";
        $category->description = "Proveedores relacionados con diseño";
        $category->save();

        $service = new Service();
        $service->name="Fabricación digital";
        $service->description="Área afín al diseño que describe la relación directa entre el desarrollo de archivos digitales y la fabricación de elementos materiales, sin la intervención de dibujos en papel u otro tipo de mediaciones manuales.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Desarrollo de render";
        $service->description="Área afín al diseño referida al uso de conversiones de gráficos individuales en simulaciones 3d y/o animaciones a través de la ayuda de computadores.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Metodologías";
        $service->description="Sistema de métodos y herramientas, su análisis teórico y aplicación al campo de estudio del diseño.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Historia del diseño";
        $service->description="Área del diseño que estudia la distintas acepciones de la disciplina y los efectos que han tenido en el devenir de la humanidad.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Teoría del diseño";
        $service->description="Es el conocimiento teórico analizado, organizado y estructurado de la disciplina del diseño con sus bases científicas.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Patentamiento";
        $service->description="Efecto de patentar como derecho de exclusividad concedido por el Estado para proteger y explotar una invención o diseño.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Propiedad intelectual";
        $service->description="Efecto de proteger ciertos productos intangibles de la mente humana mediante alguno de los varios derechos o títulos de exclusividad legal anexado a ellos.";
        $service->category_id=$category->id;
        $service->save();

        $service = new Service();
        $service->name="Fotografía";
        $service->description="Arte, aplicación y práctica de crear imágenes durables mediante el registro de la luz u otra radiación electromagnética.";
        $service->category_id=$category->id;
        $service->save();

    }
}
