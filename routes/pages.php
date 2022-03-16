<?php

use \App\Http\Response;
use App\Controller\Pages;



// Rota home
$obRouter->get('/',[
    function(){

 return new Response(200,Pages\Home::getHome());
    }
]);

// Rota sobre
$obRouter->get('/sobre',[
    function(){

 return new Response(200,Pages\About::getsobre());
    }
]);

