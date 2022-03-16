<?php

require __DIR__.'/vendor/autoload.php';


use \App\Http\Router;
use \App\Utils\View;


define('URL','http://127.0.0.1/Testmade4it');

// define  ovalor padrão das variaveis 
View::init([
   'URL' => URL
]);
// inicia o roteador do router
$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

//Imprime a response da rota
$obRouter ->run()   
        ->sendResponse();