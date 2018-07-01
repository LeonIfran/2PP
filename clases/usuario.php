<?php
class usuario
{
	public $id;
 	public $nombre;
  	public $clave;
  	public $perfil;

	#region getters
	public function getId()
	{
		return $this->_id;
	}
	public function getNombre()
	{
		return $this->_nombre;
	}
	public function getClave()
	{
		return $this->_clave;
	}
	public function getPerfil()
	{
		return $this->_perfil;
	}
	#endregion


  	public function Borrarusuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public static function BorrarusuarioPorperfil($perfil)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE perfil=:perfil");	
				$consulta->bindValue(':perfil',$perfil, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	public function Modificarusuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre='$this->nombre',
				clave='$this->clave',
				perfil='$this->perfil'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElusuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,clave,perfil)values('$this->nombre','$this->clave','$this->perfil')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarusuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre=:nombre,
				clave=:clave,
				perfil=:perfil
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
			$consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,clave,perfil)values(:nombre,:clave,:perfil)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function Guardarusuario()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarusuarioParametros();
	 		}else {
	 			$this->InsertarElusuarioParametros();
	 		}

	 }


  	public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre as nombre, perfil as perfil from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public static function TraerUnusuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, clave as clave,perfil as perfil from usuario where id = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				

			
	}

	public static function TraerUnusuarioperfil($id,$perfil) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  nombre as nombre, clave as clave,perfil as perfil from usuario  WHERE id=? AND perfil=?");
			$consulta->execute(array($id, $perfil));
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;				

			
	}

	public static function TraerUnusuarioperfilParamNombre($id,$perfil) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  nombre as nombre, clave as clave,perfil as perfil from usuario  WHERE id=:id AND perfil=:perfil");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':perfil', $perfil, PDO::PARAM_STR);
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;				

			
	}
	
	public static function TraerUnusuarioperfilParamNombreArray($id,$perfil) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  nombre as nombre, clave as clave,perfil as perfil from usuario  WHERE id=:id AND perfil=:perfil");
			$consulta->execute(array(':id'=> $id,':perfil'=> $perfil));
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->clave."  ".$this->perfil;
	}

	public static function Logear($us,$clave)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("select id, nombre, perfil from usuario where nombre = :nombre AND clave = :clave");
		$consulta->bindValue(':nombre',$us,PDO::PARAM_STR);
		$consulta->bindValue(':clave',$clave,PDO::PARAM_STR);
		$consulta->execute();
		$EmpleadoLogeado = $consulta->fetchObject('usuario');
		//echo var_dump($consulta);
		//echo var_dump($EmpleadoLogeado);
		return $EmpleadoLogeado;
	}
}