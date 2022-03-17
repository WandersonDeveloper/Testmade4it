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

// Rota  dinamica
$obRouter->get('/pagina/{idPagina}/{acao}',[
    function($idPagina,$acao){

 return new Response(200, 'Página '.$idPagina.' - '.$acao);
    }
 
]);

