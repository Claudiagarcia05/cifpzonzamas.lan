<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\FamiliaProfesional;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;

    class FamiliaProfesionalSeeder extends Seeder {
        public function run(): void {
            $familias = [
                [
                    'nombre' => 'Informática y Comunicaciones',
                    'descripcion' => 'Familia profesional relacionada con sistemas informáticos, redes y comunicaciones.',
                    'imagen' => 'https://ejemplo.com/informatica.jpg'
                ],
                [
                    'nombre' => 'Administración y Gestión',
                    'descripcion' => 'Familia profesional enfocada en la gestión empresarial y administrativa.',
                    'imagen' => 'https://ejemplo.com/administracion.jpg'
                ],
                [
                    'nombre' => 'Electricidad y Electrónica',
                    'descripcion' => 'Familia profesional especializada en instalaciones eléctricas y electrónicas.',
                    'imagen' => null
                ],
                [
                    'nombre' => 'Sanidad',
                    'descripcion' => 'Familia profesional dedicada a la salud y cuidados sanitarios.',
                    'imagen' => 'https://ejemplo.com/sanidad.jpg'
                ],
                [
                    'nombre' => 'Hostelería y Turismo',
                    'descripcion' => 'Familia profesional relacionada con servicios de restauración y turismo.',
                    'imagen' => null
                ]
            ];

            foreach ($familias as $familia) {
                FamiliaProfesional::create($familia);
            }
        }
    }