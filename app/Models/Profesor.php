<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Profesor extends Model {
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

        protected static function boot() {
            parent::boot();
            
            static::addGlobalScope('profesor', function ($builder) {
                $builder->where('tipo', 'P');
            });
        }

        static $anios_antiguedad = [
            '2018', '2019', '2020', '2021', 
            '2022', '2023', '2024', '2025'
        ];

        public $timestamps = false;
        
        public function cursoTutor() {

            return $this->belongsTo(Curso::class, 'curso_tutor_id');
        }
        
        public function horarios() {

            return $this->hasMany(Horario::class, 'id_profesor', 'id');
        }
        
        public function modulos() {
            
            return $this->hasManyThrough(
                Modulo::class,
                Horario::class,
                'id_profesor',
                'id',
                'id',
                'id_modulo'
            )->distinct();
        }
    }