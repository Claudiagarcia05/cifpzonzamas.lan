<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Notifications\Notifiable;

    class Tutor extends Model {
        use HasFactory, Notifiable;

        protected $table = 'personas';
        
        protected $fillable = [
            'nombre',
            'apellidos',
            'email',
            'tipo',
            'es_tutor',
            'antiguedad',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        protected $dates = [
            'creado_en',
            'fecha_sis_alta',
            'fecha_modi'
        ];

        protected static function boot() {
            parent::boot();
            
            static::addGlobalScope('tutor', function ($builder) {
                $builder->where('tipo', 'P');
            });
        }

        static $anios_antiguedad = [
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
            '2025' => '2025'
        ];

        public $timestamps = false;
        
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