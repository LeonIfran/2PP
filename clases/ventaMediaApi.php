<?php 
require_once 'IApiUsable.php';
require_once 'ventaMedia.php';

class ventaMediaApi extends ventaMedia implements IApiUsable
{
    #region funciones
    public function CargarUno($request, $response, $args)
    {
        $miRespuesta = new stdclass();

        $arrayDeParametros = $request->getParsedBody();
        $archivos = $request->getUploadedFiles();
        $destino = "clases/FotosVentas/";
        //guardo los parametros en variables locales
        $idMed = $arrayDeParametros['idMedia'];
        $cliente = $arrayDeParametros['nombreCliente'];
        //$fecha = $arrayDeParametros['fecha'];
        $importe = $arrayDeParametros['importe'];
        $fecha = date("Y-m-d");
        $nombreFoto = $idMed."_".$cliente."_".$fecha;
        
        $miVenta = new ventaMedia();
        $miVenta->setidMedia($idMed);
        $miVenta->setnombreCliente($cliente);
        $miVenta->setFecha($fecha);
        $miVenta->setImporte($importe);

        //#### Guardar la foto si esta seteada #####
        if (isset($archivos['fotoV'])) 
        {//El nombre de la foto se conformará por el ID de la Media, el nombre del cliente y la fecha
            //echo var_dump($archivos['fotoV']).'<br>';
            
            //obtengo la extension del archivo, uso la funcion getClientFilename porque este es un objeto de slim
            $extension = pathinfo($archivos['fotoV']->getClientFilename(), PATHINFO_EXTENSION);
            //echo $extension.'<br>';
            $nombreFoto = $nombreFoto.".".$extension;
            $archivos['fotoV']->moveTo($destino.$nombreFoto);
        }
        //##### Ejecuto la consulta #####
        $miVenta->insertarVenta();

        $miRespuesta->respuesta = "Se guardo la venta con ID $idMed y el archivo en $destino".$nombreFoto;
        return $response->withJson($miRespuesta,200);
    }

    public function TraerUno($request, $response, $args)
    {} 
    public function TraerTodos($request, $response, $args)
    {}
    public function BorrarUno($request, $response, $args)
    {}
    public function ModificarUno($request, $response, $args)
    {}

    #endregion
}

?>