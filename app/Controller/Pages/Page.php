<?php

namespace App\Controller\Pages;

use \App\Utils\View;



class Page {

    /**Método responsavel por renderizar o topo da pagina
     * @return string
     */
    private static function getHader(){
    
    return View::render('pages/hader');
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
        'hader'=> self::getHader(),
        'content'=>$content,
         'footer'=> self::getFooter()
        ]);
        //Retorna a view da pagina
    //    return parent::getPage('Test-made4it',$content);
    }
}
