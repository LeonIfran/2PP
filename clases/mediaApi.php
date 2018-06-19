<?php
require_once 'media.php';
require_once 'IApiUsable.php';

class mediaApi extends media implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
        $elmedia=media::TraerUnmedia($id);
        if(!$elmedia)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta El media";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($elmedia, 200); 
        }     
        return $NuevaRespuesta;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosmedias=media::TraerTodoLosmedias();
     	$newresponse = $response->withJson($todosLosmedias, 200);  
    	return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new media();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $color= $ArrayDeParametros['color'];
        $marca= $ArrayDeParametros['marca'];
        $precio= $ArrayDeParametros['precio'];
        $talle =$ArrayDeParametros['talle'];
        

        $mimedia = new media();
        $mimedia->color=$color;
        $mimedia->marca=$marca;
        $mimedia->precio=$precio;
        $mimedia->talle=$talle;
        $mimedia->foto="vacio";

        //$mimedia->InsertarElmediaParametros();
        
        $archivos = $request->getUploadedFiles();
        $destino="clases/fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);
        if(isset($archivos['foto']))
        {
            $nombreAnterior=$archivos['foto']->getClientFilename();
            $extension= explode(".", $nombreAnterior)  ;
            //var_dump($nombreAnterior);
            $extension=array_reverse($extension);
            echo $destino.$color.".".$extension[0];
            $archivos['foto']->moveTo($destino.$marca."_".$color.".".$extension[0]);
            //$archivos['foto']->moveTo($destino.$color.".".$extension[0]);
            $mimedia->foto=$destino.$marca."_".$color.".".$extension[0];
        }

        $mimedia->InsertarElmedia();       
        //$response->getBody()->write("se guardo el media");
        $objDelaRespuesta->respuesta="Se guardo la media.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$media= new media();
     	$media->id=$id;
     	$cantidadDeBorrados=$media->Borrarmedia();

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
	    $mimedia = new media();
	    $mimedia->id=$ArrayDeParametros['id'];
	    $mimedia->titulo=$ArrayDeParametros['titulo'];
	    $mimedia->marca=$ArrayDeParametros['cantante'];
	    $mimedia->año=$ArrayDeParametros['anio'];

	   	$resultado =$mimedia->ModificarmediaParametros();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);		
    }


}