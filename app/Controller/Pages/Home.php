<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home  extends Page
{
    /**
     * Método responsalvel por retornar o conteúdo (View) da home
     * @return string
     */
    public static function getHome()
    {
        // organização 
        $obOrganization = new Organization;


        // View da home
        $content = View::render('pages/home', [

            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'site' => $obOrganization->site,

        ]);
        //Retorna a view da pagina
        return parent::getPage('TEST - Made4it', $content);
    }
}
