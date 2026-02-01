<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Modulo extends Model {
        protected $table = 'modulos';
        
        protected $fillable = [
            'nombre',
            'siglas',
            'color',
            'curso_asignado',
            'usuario_alta',
            'ip_alta',
            'usuario_modi',
            'ip_modi'
        ];

        public $timestamps = false;
    }