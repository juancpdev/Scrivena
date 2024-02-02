<?php

namespace Model;

class Contrato extends ActiveRecord {
    protected static $tabla = 'contratos';
    protected static $columnasDB = ['id', 'inversionista_id', 'inversion', 'tipo', 'fecha_inicio', 'fecha_fin'];

    public $id;
    public $inversionista_id;
    public $inversion;
    public $tipo;
    public $fecha_inicio;
    public $fecha_fin;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->inversionista_id = $args['inversionista_id'] ?? 1;
        $this->inversion = $args['inversion'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->fecha_inicio = date("Y/m/d");
        $this->fecha_fin = date("Y/m/d");
    }

    public function validarContrato() {
        if(!$this->inversionista_id) {
            self::$alertas['error'][] = 'Elige un inversor';
        }
        if(!$this->inversion) {
            self::$alertas['error'][] = 'El monto de inversión es Obligatorio';
        }
        if(!$this->tipo) {
            self::$alertas['error'][] = 'El tipo de inversión es Obligatorio';
        }
        if(!$this->fecha_inicio) {
            self::$alertas['error'][] = 'La fecha de inicio es Obligatoria';
        }
        if(!$this->fecha_fin) {
            self::$alertas['error'][] = 'La fecha de finalización es Obligatoria';
        }

        return self::$alertas;
    }

}