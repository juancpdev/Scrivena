<?php

namespace Controllers;

use Model\Usuario;

class APIClientes {

    public static function index() {
        if(!is_admin()) {
            header('Location: /');
        }

        $clientes = Usuario::whereArray(['admin' => 0]);
        echo json_encode($clientes);
    }

    public static function cliente() {
        if(!is_admin()) {
            header('Location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $clientes = Usuario::find($id);
        echo json_encode($clientes, JSON_UNESCAPED_SLASHES);

    }
}