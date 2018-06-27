<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
        $elCd=cd::TraerUnCd($id);
        if(!$elCd)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta El CD";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($elCd, 200); 
        }     
        return $NuevaRespuesta;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosUsuarios=usuario::TraerTodosLosUsuarios();
     	$newresponse = $response->withJson($todosLosUsuarios, 200);  
    	return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $clave= $ArrayDeParametros['clave'];
        $perfil= $ArrayDeParametros['perfil'];
        
        $miusuario = new usuario();
        $miusuario->nombre=$nombre;
        $miusuario->clave=$clave;
        $miusuario->perfil=$perfil;
        $miusuario->InsertarElusuarioParametros();
        //$archivos = $request->getUploadedFiles();
        //$destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);
/*         if(isset($archivos['foto']))
        {
            $nombreAnterior=$archivos['foto']->getClientFilename();
            $extension= explode(".", $nombreAnterior)  ;
            //var_dump($nombreAnterior);
            $extension=array_reverse($extension);
            $archivos['foto']->moveTo($destino.$nombre.".".$extension[0]);
        }        */
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Usuario: $miusuario->nombre.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$cd= new cd();
     	$cd->id=$id;
     	$cantidadDeBorrados=$cd->BorrarCd();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $micd = new cd();
	    $micd->id=$ArrayDeParametros['id'];
	    $micd->titulo=$ArrayDeParametros['titulo'];
	    $micd->cantante=$ArrayDeParametros['cantante'];
	    $micd->año=$ArrayDeParametros['anio'];

	   	$resultado =$micd->ModificarCdParametros();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);		
    }
    public function LogearApi($request, $response,$args)
    {
        $respuesta= new stdclass();
        $eltoken = NULL;
        $elLogeo = NULL;
 
        $ArrayDeParametros = $request->getParsedBody();
        $usuario=$ArrayDeParametros['usuario'];
        $clave=$ArrayDeParametros['clave'];
        $datosUsuario=usuario::Logear($usuario,$clave);
        
        if ($datosUsuario != NULL) 
        {
            $eltoken = AutentificadorJWT::CrearToken($datosUsuario);
        }
 
        //$respuesta = array('datos'=>$datosUsuario,'token'=>$eltoken);  
        return $response->withJson($eltoken,200);
   
        
    }

}