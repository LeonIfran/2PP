<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/mediaApi.php';
require_once '/clases/AutentificadorJWT.php';
require_once '/clases/MWparaCORS.php';
require_once '/clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/media',function(){
    $this->post('/alta',\mediaApi::class . ':CargarUno');
    $this->post('/hola', \personalApi::class . ':HolaMundo');

    //$this->post('/',\personalApi::class . ':InsertarUno');
});

$app->run();
?>