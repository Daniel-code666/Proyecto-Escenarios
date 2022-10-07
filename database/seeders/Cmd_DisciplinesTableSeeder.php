<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Cmd_DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            insert into cmd_disciplines (`discipline_name`, `discipline_description`) values ('Fútbol', 'Deporte que se practica entre dos equipos de once jugadores que tratan de introducir un balón en la portería del contrario impulsándolo con los pies, la cabeza o cualquier parte del cuerpo excepto las manos y los brazos; en cada equipo hay un portero, que puede tocar el balón con las manos, aunque solamente dentro del área; vence el equipo que logra más goles durante los 90 minutos que dura el encuentro.');
            insert into cmd_disciplines (`discipline_name`, `discipline_description`) values ('Tenis', 'Deporte que se practica entre dos jugadores o dos parejas en una pista rectangular dividida transversalmente por una red; consiste en impulsar una pelota con una raqueta por encima de la red intentando que bote en el campo contrario y que el adversario no la pueda devolver; los partidos se disputan a tres o cinco sets siguiendo un complejo sistema de puntuación.');
            insert into cmd_disciplines (`discipline_name`, `discipline_description`) values ('DUNT', 'Definición que reune todas los deportes urbanos y no tradicionales como el skate, bmx, rollerblade y demás');
            insert into cmd_disciplines (`discipline_name`, `discipline_description`) values ('BMX', 'El BMX es una disciplina del ciclismo que se practica con bicicletas cross con ruedas de 20 pulgadas de diámetro.');
            insert into cmd_disciplines (`discipline_name`, `discipline_description`) values ('Fútbol 8', 'El fútbol 8,También conocido como balompié, es un deporte en equipo, jugado entre dos conjuntos de ocho jugadores cada uno y uno árbitro que se ocupan de que las reglas de juego se cumplan. Es ampliamente considerado el deporte más popular del mundo, pues lo practican unos 270 millones de personas.');
        ");
    }
}
