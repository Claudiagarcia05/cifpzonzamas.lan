<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Persona extends Model {
        protected $table = 'personas';
        
        protected $fillable = [
            'nombre',
            'apellidos',
            'email',
            'tipo',
            'es_tutor',
            'curso_tutor_id',
            'antiguedad',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        public $timestamps = false;
        
        public function matriculas() {
            
            return $this->hasMany(Matricula::class, 'id_alumno');
        }
    }