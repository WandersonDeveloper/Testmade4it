<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;


class Page {

    /**Método responsavel por renderizar o topo da pagina
     * @return string
     */
    private static function getHader(){

        $obOrganization = new Organization;
    return View::render('pages/header',[
        'nome' => $obOrganization->nome
    ]);
}
/**Método responsavel por renderizar o rodapé da pagina
     * @return string
     */
    private static function getFooter(){
    
        return View::render('pages/footer');
    }
    /**
     * Método responsalvel por retornar o conteúdo (View) da pagina genérica
     * @return string
     */
    public static function getPage($title,$content)
    {
        // View da home
   return View::render('pages/page', [
       
        'title' => $title,
        'header'=> self::getHader(),
        'content'=>$content,
         'footer'=> self::getFooter()
        ]);
    
    }
}
