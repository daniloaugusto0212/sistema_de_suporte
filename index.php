<?php
    define('HOST', 'localhost');
    define('DATABASE','suporte_personalizado');
    define('USER','root');
    define('PASSWORD','');

    define("BASE", 'http://localhost/sistema_de_suporte/');

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    $autoload = function($class){
        include($class.'.php');
    };

    spl_autoload_register($autoload);

    $homeController = new \controllers\homeController();

    Router::get('/',function() use ($homeController){
       $homeController->index();
    });

    Router::get('/chamado', function(){
        echo '<h2>Visualizando chamado: 000000</h2>';
    })

   

?>