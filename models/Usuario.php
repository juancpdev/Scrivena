<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'pais', 'documento', 'token', 'cambiopass', 'admin'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $telefono;
    public $pais;
    public $documento;
    public $token;
    public $cambiopass;
    public $admin;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->documento = $args['documento'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->cambiopass = $args['cambiopass'] ?? 0;
        $this->admin = $args['admin'] ?? 0;
    }

    // Validar el Login de Usuarios
    public function validarLogin($lang) {
        $alertas = [];

        if(!$this->email) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
            } else {
                self::$alertas['error'][] = 'User email is required';
            }
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'Email no válido';
            } else {
                self::$alertas['error'][] = 'Invalid email';
            }
        }

        if(!$this->password) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'La contraseña no puede ir vacio';
            } else {
                self::$alertas['error'][] = 'Password cannot be empty';
            }
        }

        return self::$alertas;
    }

    // Creacion de clientes
    public function validarCliente() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Cliente es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido del Cliente es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }
        if(!$this->pais) {
            self::$alertas['error'][] = 'El País es Obligatorio';
        }
        if(!$this->documento) {
            self::$alertas['error'][] = 'El documento es Obligatorio';
        }

        return self::$alertas;
    }

    // Actualizar Perfil Cliente
    public function actualizarPerfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Cliente es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido del Cliente es Obligatorio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }
        if(!$this->pais) {
            self::$alertas['error'][] = 'El País es Obligatorio';
        }
        if(!$this->documento) {
            self::$alertas['error'][] = 'El documento es Obligatorio';
        }

        return self::$alertas;
    }

    // Valida un email
    public function validarEmail($lang) {

        if(!$this->email) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'El Email es Obligatorio';
            } else {
                self::$alertas['error'][] = 'User email is required';
            }
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'Email no válido';
            } else {
                self::$alertas['error'][] = 'Invalid email';
            }
        }

        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword($lang) {
        
        if((!($this->password) || !($this->password2))) {
            if ($lang === 'es') {
                self::$alertas['error'][] = 'La contraseña es Obligatoria';
            } else {
                self::$alertas['error'][] = 'Password is Required';
            }
        }

        if(strlen($this->password) < 6 || strlen($this->password2) < 6 ) {
            if ($lang === 'es') {
                self::$alertas['error'][] = "La contraseña debe contener al menos 6 caracteres";
            } else {
                self::$alertas['error'][] = 'Password must contain at least 6 characters';
            }
        }
        
        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}