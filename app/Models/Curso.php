<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Curso extends Model {
        protected $table = 'cursos';
        
        protected $fillable = [
            'nombre_grado',
            'curso_numero',
            'letra',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        public $timestamps = false;
        
        public function getNombreCompletoAttribute() {
            
            return "{$this->nombre_grado} {$this->curso_numero}{$this->letra}";
        }
        
        public function alumnos() {

            return $this->belongsToMany(
                Persona::class,
                'matricula',
                'id_curso',
                'id_alumno'
            )->where('tipo', 'A')
            ->withPivot('anio_escolar');
        }
    }