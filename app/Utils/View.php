<?php

namespace App\Utils;

class View
{

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

        //Chave do array de variáveis
        $keys = array_keys($vars);

        $keys =  array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);


        //Retorna o conteudo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}
