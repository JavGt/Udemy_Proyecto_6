<?php
require 'app.php';

function incluirTemplates(string $nombre, bool  $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function verificarSesion() : bool {
    session_start();

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }else{
        return false;
    }
}