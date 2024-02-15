<?php

namespace Model;

class Contrato extends ActiveRecord {
    protected static $tabla = 'contratos';
    protected static $columnasDB = ['id', 'inversionista_id', 'inversion', 'tipo', 'fecha_inicio', 'fecha_fin', 'contrato', 'rendimiento', 'porcentaje'];

    public $id;
    public $inversionista_id;
    public $inversion;
    public $tipo;
    public $fecha_inicio;
    public $fecha_fin;
    public $contrato;
    public $rendimiento;
    public $porcentaje;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->inversionista_id = $args['inversionista_id'] ?? null;
        $this->inversion = $args['inversion'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->fecha_inicio = $args['fecha_inicio'] ?? null;
        $this->fecha_fin = $args['fecha_fin'] ?? null;
        $this->contrato = $args['contrato'] ?? null;
        $this->rendimiento = $args['rendimiento'] ?? 0;
        $this->porcentaje = $args['porcentaje'] ?? null;
    }

    public function validarContrato() {
        if(!$this->inversionista_id) {
            self::$alertas['error'][] = 'Elige un inversor';
        }
        if(!$this->inversion) {
            self::$alertas['error'][] = 'El monto de inversión es Obligatorio';
        }
        if(!$this->porcentaje) {
            self::$alertas['error'][] = 'El porcentaje es Obligatorio';
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
        if(!$this->contrato) {
            self::$alertas['error'][] = 'Suba el contrato';
        }

        return self::$alertas;
    }

}