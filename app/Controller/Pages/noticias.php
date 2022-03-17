<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Noticias  extends Page
{
    /**
     * Método responsalvel por retornar o conteúdo (View) da home
     * @return string
     */
    public static function getNoticia()
    {
        // organização 
        $obOrganization = new Organization;


        // View da Noticias
        $content = View::render('pages/noticias', [

            

        ]);
        //Retorna a view da  Noticias
        return parent::getPage('Noticias - Made4it', $content);
    }
}
