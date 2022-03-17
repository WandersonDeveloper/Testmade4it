<?php

namespace App\Http;


use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
{
    /** Raiz do projeto  
     * @var String
     */
    private $url = '';

    /** Prefixo das rotas 
     * @var String
     */
    private $Prefix;

    /** indice de rots */
    private $router = [];


    /**Instancia de requeste
     * @car Request
     */
    private $request;

    /** Método responsalvel por iniciar a class */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    /** Método responsalvel por definir o prefix das rotas */
    private function setPrefix()
    {
        //Url atual
        $parUrl = parse_url($this->url);

        //Define o prefixo 
        $this->Prefix = $parUrl['path'] ?? '';
    }

    /** Método responsalvel por adicionarr uma rota na class */
    private function addRoutes($method, $router, $params = [])
    {

        //Validação dos parametros 

        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        //Variaveis da rota 
        $params['variables'] = [];

        // padrão de validação das  variáveis das rotas 
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $router,$matches)) {
            $router = preg_replace($patternVariable,'(.*?)',$router);
            $params['variables'] = $matches[1];
        }

        // padrao de validação da url
        $patterRoute = '/^' . str_replace('/', '\/', $router) . '$/';
        // Adiciona a rota dentro da class 
        $this->router[$patterRoute][$method] = $params;
    }


    /** Método responsalvel por definir a rota de get */
    public function get($router, $params = [])
    {
        return $this->addRoutes('GET', $router, $params);
    }

    /** Método responsalvel por definir a rota de post */
    public function post($router, $params = [])
    {
        return $this->addRoutes('POST', $router, $params);
    }

    /** Método responsalvel por definir a rota de PUT */
    public function put($router, $params = [])
    {
        return $this->addRoutes('PUT', $router, $params);
    }

    /** Método responsalvel por definir a rota de delete */
    public function delete($router, $params = [])
    {
        return $this->addRoutes('DELETE', $router, $params);
    }

    //Método responsavel por retornar a Uri desconsiderando o prefixo
    private function getUri()
    {
        // URI da Request 
        $uri = $this->request->getUri();

        // fatia a URI com Prefixo
        $xUri = strlen($this->Prefix) ? explode($this->Prefix, $uri) : [$uri];
        // retoruna a URI sem o Prefixo
        return end($xUri);
    }


    /**Método responsavel por retornar os dados da rota atual */
    private function getRoute()
    {

        // retorna URI
        $uri = $this->getUri();

        //methodo da requisição 
        $httpMethod = $this->request->getHttpMethod();

        // valida as rotas 
        foreach ($this->router as $patternRouter => $method) {
            //Se a URI bate com padrão
            if (preg_match($patternRouter, $uri, $matches)) {


                // Verifica o metodo
                if (isset($method[$httpMethod])) {
                    // removo a primeira posição 
                   
                    unset($matches['0']); 
               
                    // Variaveis processadas
                    $keys = $method[$httpMethod]['variables'];
                    $method[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $method[$httpMethod]['variables']['request'] = $this->request;
 
                    // Retorna os parametros da rota
                    return $method[$httpMethod];
                }
                throw new Exception("Metodo não  permitido", 405);
            }
        }
        // URL não encontrada 
        throw new Exception("URL não encontrada", 404);
    }

    /** Metodo reponsavel por execultar a rota atual 
     * @return Response
     * 
     */
    public function run()
    {
        try {
            //obtem a rota atual    
            $router = $this->getRoute();

            // verifica o controlador 
            if (!isset($router['controller'])) {
                throw new Exception("A URL não pode ser processada", 500);
            }

            //Argumentos da função 
            $args = [];
           
            //reflection
            $refletion = new ReflectionFunction($router['controller']);
            foreach ($refletion->getParameters() as $parameter) {
              
                $name = $parameter->getName();
          
                 $args[$name] = $router['variables'][$name] ?? '*------*';
               
             
            }
     
            // Retorna a execulção da função 
            return call_user_func_array($router['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
