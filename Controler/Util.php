<?php

class Util {

    public static function IniciarSession() {

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function GuardarInformacao($cod) {
        self::IniciarSession();
        $_SESSION['cod'] = $cod;
    }

    public static function CondigoLogado() {
        self::IniciarSession();
        return $_SESSION['cod'];
    }

    public static function VerificarLogado() {

        self::IniciarSession();

        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            header('location: login.php');
        }
    }
    
    public static function Deslogar() {
        self::IniciarSession();
        unset($_SESSION['cod']);
        header('location: login.php');
    }
    
    

    public static function DataAtual() {

        return date('Y-m-d');
    }

    public static function TratarDataBanco($data) {

        return explode('/', $data)[2] . '-' . explode('/', $data)[1] . '-' . explode('/', $data)[0];
    }

}
