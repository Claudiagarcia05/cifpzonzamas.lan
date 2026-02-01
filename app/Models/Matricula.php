<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Matricula extends Model {
        protected $table = 'matricula';
        
        protected $fillable = [
            'id_alumno',
            'id_curso',
            'anio_escolar'
        ];

        public $timestamps = false;
        
        public function alumno() {

            return $this->belongsTo(Persona::class, 'id_alumno');
        }
        
        public function curso() {
            
            return $this->belongsTo(Curso::class, 'id_curso');
        }
    }