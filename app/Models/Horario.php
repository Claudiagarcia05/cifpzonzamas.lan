<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Horario extends Model {
        protected $table = 'horarios';
        
        protected $fillable = [
            'dia',
            'hora_inicio',
            'hora_fin',
            'id_modulo',
            'id_profesor',
            'id_aula',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        public $timestamps = false;
        
        public function modulo() {

            return $this->belongsTo(Modulo::class, 'id_modulo');
        }
        
        public function profesor() {

            return $this->belongsTo(Tutor::class, 'id_profesor');
        }
        
        public function aula() {

            return $this->belongsTo(Aula::class, 'id_aula');
        }
    }