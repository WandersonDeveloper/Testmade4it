<?php

require __DIR__.'/vendor/autoload.php';


use \App\Http\Router;
use \App\Utils\View;
use \WandersonFelipe\DotEnv\Environment;


Environment::load(__DIR__);


//Define a constante a URL do projeto
define('URL',getenv('URL'));

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