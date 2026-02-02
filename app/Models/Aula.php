<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Notifications\Notifiable;

    class Aula extends Model {
        use HasFactory, Notifiable;

        protected $fillable = [
            'nombre',
            'letra', 
            'numero',
            'planta',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        protected $dates = [
            'fecha_sis_alta',
            'fecha_modi'
        ];

        static $letras = [
            'A' => 'Lomo Derecho A',
            'B' => 'Lomo Derecho B',
            'C' => 'Lomo Izquierdo C',
            'D' => 'Lomo Izquierdo D'
        ];

        static $plantas = [
            'P' => 'Primera',
            'S' => 'Segunda', 
            'T' => 'Tercera'
        ];

        public $timestamps = false;
    }