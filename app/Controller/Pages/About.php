<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About  extends Page
{
    /**
     * Método responsalvel por retornar o conteúdo (View) da home
     * @return string
     */
    public static function getsobre()
    {
        // organização 
        $obOrganization = new Organization;


        // View da home
        $content = View::render('pages/about', [

            'name' => $obOrganization->name,
            'description'=> $obOrganization->description,
         

        ]);
        //Retorna a view da pagina
        return parent::getPage('Sobre', $content);
    }
}
