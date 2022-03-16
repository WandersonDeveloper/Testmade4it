<?php

namespace App\Utils;

class View
{
    /** Variaves padrões da VIEW */
    private static $vars = [];

    /** metodo responsavel por definir metdos iniciais da classe  */
    public static function init($vars = []){
        self::$vars = $vars;
    }

    /**
     * Método resposnsalvel por retornar o conteúdo de uma view
     * @param string
     * @return string
     */
    private static function getContentView($View)
    {

        $file = __DIR__ . '/../../resources/view/' . $View . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsalvel por retornar o conteúdo  renderizado de uma view
     * @param string 
     * @param array $vars (strings/numeric)
     * @return string
     */
    public static function render($View, $vars = [])
    {

        //conteúdo da view
        $contentView = self::getContentView($View);
        // Marge de variavel das View
        $vars = array_merge(self::$vars,$vars);
        
        //Chave do array de variáveis
        $keys = array_keys($vars);
        $keys =  array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);


        //Retorna o conteudo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}
