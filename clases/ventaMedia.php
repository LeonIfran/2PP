<?php 
/* 1pts) (POST) venta de Medias (IdMedia, nombreCliente, fecha, importe) además de tener asociada una imagen (jpg, jpeg o png) a la venta. 
El nombre de la foto se conformará por el ID de la Media, el nombre del cliente y la fecha. 
La imagen se guardará en la carpeta /FotosVentas. (token: solos los encargados y los empleados). */
class ventaMedia
{
    private $_idMedia;
    private $_nombreCliente;
    private $_fecha;
    private $_importe;

#region getters Y setters
    //############ Getters #################
    public function getIdMedia()
    {
        return $this->_idMedia;
    }
    public function getnombreCliente()
    {
        return $this->_nombreCliente;
    }
    public function getFecha()
    {
        return $this->_fecha;
    }
    public function getimporte()
    {
        return $this->_importe;
    }
    //############# Setters #######################
    public function setIdMedia($value)
    {
        $this->_idMedia = $value;
    }
    public function setnombreCliente($value)
    {
        $this->_nombreCliente = $value;
    }
    public function setFecha($value)
    {
        $this->_fecha = $value;
    }
    public function setImporte($value)
    {
        $this->_importe = $value;
    }

#endregion

#region Funciones
    public function insertarVenta()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into ventamedia (idMedia, nombreCliente, fecha, importe)values(:id,:nombre,:fecha,:importe)");
        $consulta->bindValue(':id', $this->getIdMedia(), PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->getnombreCliente(), PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $this->getFecha(), PDO::PARAM_STR);
        $consulta->bindValue(':importe', $this->getImporte(),PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
#end region
}


?>