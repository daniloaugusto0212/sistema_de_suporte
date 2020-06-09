<?php
    define('HOST', 'localhost');
    define('DATABASE','suporte_personalizado');
    define('USER','root');
    define('PASSWORD','681015');

    $autoload = function($class){
        include($class.'.php');
    };

    spl_autoload_register($autoload);

    $pdo = \MySql::conectar();

?>