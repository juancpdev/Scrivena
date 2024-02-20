<?php

namespace Controllers;

use Model\Contrato;
use Model\Usuario;

class APIContratos {

    public static function index() {

        if(!is_auth()) {
            echo json_encode([]);
            return;
        }

        $cliente = Usuario::find($_SESSION['id']);
        
        $contratos = Contrato::whereArray(["inversionista_id" => $cliente->id]);

        echo json_encode($contratos);
        return;
    }

    public static function contratos() {

        if(!is_admin()) {
            header('Location: /');
        }

        $contratos = Contrato::all();
        echo json_encode($contratos);
        return;
    }
}