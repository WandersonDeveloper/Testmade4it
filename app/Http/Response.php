<?php

namespace App\Http;

class Response
{
    /**Codigo do statius do http */
    private $httpCode    = 200;
    /** cabeçalho do response */
    private $headers      = [];
    /** tipo de conteúdo que está sendo retornado*/
    private $contentType  = 'text/html';
    /**Conteudo do response */
    private $content;
    /**Método por iniciar  a classe e definir os valores  */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }
    /**metodo responsavel por alterar o contente type do responce */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
    /**metodo responsavel por add um registro no response */
    public function addHeader($keys, $value)
    {
        $this->headers[$keys] = $value;
    }
    /**Método responsavel por enviar os haders para navegador  */
    private function sendHaders(){
        // Status
        http_response_code($this->httpCode);
        //ENVIA HADERS
        foreach($this->headers as $key =>$value){
            header($key.':'.$value);

        }
    }

    /**Metodo responsavel por enviar a resposta para usuario */
    public function sendResponse()
    {
        //ENVIA OS HADERS
        $this->sendHaders();   
        //IMPRIME O CONTEUDO    
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
    
}
