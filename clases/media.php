<?php
class media
{
	public $id;
 	public $color;
  	public $marca;
  	public $precio;
	public $talle;
	public $foto;


  	public function Borrarmedia()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from medias 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public static function BorrarmediaPorAnio($precio)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from medias 				
				WHERE jahr=:anio");	
				$consulta->bindValue(':anio',$precio, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	public function Modificarmedia()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update medias 
				set titel='$this->color',
				interpret='$this->marca',
				jahr='$this->precio'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElmedia()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into medias (color,marca,precio, talle, foto)values('$this->color','$this->marca','$this->precio','$this->talle','$this->foto')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarmediaParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update medias 
				set titel=:color,
				interpret=:marca,
				jahr=:anio
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':color',$this->color, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $this->precio, PDO::PARAM_STR);
			$consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElmediaParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into medias (color,marca,precio,)values(:color,:marca,:precio)");
				$consulta->bindValue(':color',$this->color, PDO::PARAM_STR);
				$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
				$consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function Guardarmedia()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarmediaParametros();
	 		}else {
	 			$this->InsertarElmediaParametros();
	 		}

	 }


  	public static function TraerTodoLosmedias()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as color, interpret as marca,jahr as precio from medias");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "media");		
	}

	public static function TraerUnmedia($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, titel as color, interpret as marca,jahr as precio from medias where id = $id");
			$consulta->execute();
			$mediaBuscado= $consulta->fetchObject('media');
			return $mediaBuscado;				

			
	}

	public static function TraerUnmediaAnio($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as color, interpret as marca,jahr as precio from medias  WHERE id=? AND jahr=?");
			$consulta->execute(array($id, $anio));
			$mediaBuscado= $consulta->fetchObject('media');
      		return $mediaBuscado;				

			
	}

	public static function TraerUnmediaAnioParamNombre($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as color, interpret as marca,jahr as precio from medias  WHERE id=:id AND jahr=:anio");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
			$consulta->execute();
			$mediaBuscado= $consulta->fetchObject('media');
      		return $mediaBuscado;				

			
	}
	
	public static function TraerUnmediaAnioParamNombreArray($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as color, interpret as marca,jahr as precio from medias  WHERE id=:id AND jahr=:anio");
			$consulta->execute(array(':id'=> $id,':anio'=> $anio));
			$consulta->execute();
			$mediaBuscado= $consulta->fetchObject('media');
      		return $mediaBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->color."  ".$this->marca."  ".$this->precio;
	}

}