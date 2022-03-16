<?php

namespace App\Http;

class Request
{
    /**metodo Http da requisição */
    private $httpMethod;
    /**URI da Pagina */
    private $uri;
    /**parametros da URL $_GET */
    private $queryParams = [];
    /** variaveis recebidas da pagina  */
    private  $postVars = [];
    /**cabelçalho da requisição  */
    private $headers = [];
    /**construtor da classe  */
    public function __construct()
    {
        $this->queryParams      = $_GET ?? '';
        $this->postVars         = $_POST ?? '';
        $this->headers          = getallheaders();
        $this->httpMethod       = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri              = $_SERVER['REQUEST_URI'] ?? '';
    }
    /**Metodo responsalvel por retornar o http da requisição  */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }
    /**metodo responsavel por retornar da URI da requisição */
    public function geturi()
    {
        return $this->uri;
    }
    /**retorna os parametros da requisição */
    public function getqueryParams()
    {
        return $this->queryParams;
    }
    /** retorna as variaveis post da requisição  */
    public function getpostVars()
    {
        return $this->postVars;
    }
    /** retorna os headers da requisição */
    public function getheaders()
    {
        return $this->headers;
    }
}
