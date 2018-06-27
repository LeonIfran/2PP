<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/mediaApi.php';
require_once '/clases/usuarioApi.php';
require_once '/clases/ventaMediaApi.php';
require_once '/clases/AutentificadorJWT.php';
require_once '/clases/MWparaCORS.php';
require_once '/clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/media',function(){
    $this->post('/alta',\mediaApi::class . ':CargarUno');
    $this->get('/listado',\mediaApi::class . ':TraerTodos');
    $this->post('/hola', \personalApi::class . ':HolaMundo');
    $this->delete('/borrar/{id}',\mediaApi::class . ':BorrarUno')->add(\MWparaAutentificar::class . ':VerificarUsuario');
    //$this->post('/',\personalApi::class . ':InsertarUno');
});

$app->group('/usuario',function(){
    $this->post('/alta',\usuarioApi::class . ':CargarUno');
    $this->get('/listado',\usuarioApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario');
});

$app->group('/ventas',function(){
    $this->post('/alta',\ventaMediaApi::class . ':CargarUno');
});

$app->group('/entrada',function(){
    $this->post('/login',\usuarioApi::class . ':LogearApi');
});
$app->run();
?>