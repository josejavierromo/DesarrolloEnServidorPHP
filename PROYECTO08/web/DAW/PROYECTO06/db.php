<?php
/* @autor José Javier Romo Escobar 
 * @since 06/11/2014
 * 
 * Clase encargada de la conexión y gestión de la información de la base de datos indicada
*/
class db
{
	//Variables privadas
	protected $mysqli;
	private $cstrInfo;
	protected $resultado;
	protected $cstrSQLQ;
	
	//Constructor
	function __construct()
	{
	}
	
	protected function connect()
	{
		$this->mysqli = new MySQLi('localhost', 'root', 'win1201.F', 'Lugares');
		
		if($this->mysqli->connect_error)
			$this->cstrInfo = "Fallo al conectar con el servidor".$this->mysqli->connect_error;
		else
		{
			$this->cstrInfo = "Conectado correctamente al servidor de base de datos";
			$this->mysqli->query("SET NAMES UTF8;");
		}
	}
	
	protected function disconnect()
	{
			$this->mysqli->close();	
	}
	/*	@autor: José Javier Romo Escobar
	 *	@since 10/12/2014
	 *
	 *	Comprueba si el usuario y contraseña indicadosson correctos
	 */
	public function login()
	{
		if(isset($_POST["inputUser"]))
		{
			$this->connect();			
			if($this->resultado = $this->mysqli->query("SELECT IdUsuario, Nombre, Imagen FROM Usuarios WHERE Usuario='".$_POST["inputUser"]."' AND Password='".md5($_POST["inputPassword"])."'"))
			{
				if($this->resultado->num_rows > 0)
				{
					session_start();
					$fields = $this->resultado->fetch_fields();
					$this->resultado->data_seek(0);
					$fila = $this->resultado->fetch_row();
					$_SESSION["login"] = "true";
					$_SESSION["IdUsuario"] = $fila[0];
					$_SESSION["UserName"] = $fila[1];
					$_SESSION["UserPicture"] = $fila[2];
					$_SESSION["LastAccess"] = date();
					$this->resultado->free();
					$this->disconnect();
					
					$this->updateInfo("Usuarios","UltimoAcceso",$this->LastAccess,"WHERE IDUsuario=".$this->IdUsuario);
					header("Location:Index.php?id=1");
					return true;
				}
				else
				{
					$this->disconnect();
					header("Location:Index.php?id=-1&amp;errorlogin");
					if(!isset($_COOKIE["loginError"]))
						setcookie("loginError",1,time()+60);
					else
						setcookie("loginError",$_COOKIE["loginError"] + 1,time()+60);
					return false;
				}
			}
			else
			{
				echo("ERROR: %s\n".$this->mysqli->error);
			}
		}
	}
	
	public function exitLogin()
	{
		session_unset();
		session_destroy();
		header("Location:Index.php?id=1");
	}
	
	
	/* @autor José Javier Romo Escobar
	 * @since 06/11/2014
	 *
	 * Ejecuta un comando de SQL del tipo SELECT contra la base de datos  
    */
	protected function getInfo($pstrTable, $pstrFields)
	{
		$this->connect();
		$table = "";
		$this->createQuery($pstrTable,$pstrFields);
		if(!$this->resultado = $this->mysqli->query($this->cstrSQLQ))
			$table = "ERROR: %s\n".$this->mysqli->error;
			
		$this->disconnect();
		return $table;
	}
	
	protected function setInfo($pstrTable,$pstrColumns,$pstrValues)
	{
		$this->connect();
		$fintIndex = 0;
		
		$this->cstrSQLQ = "INSERT INTO ".$pstrTable;
		$this->cstrSQLQ = $this->cstrSQLQ."(";
		foreach($pstrColumns as $column)
		{
			if($fintIndex == count($pstrColumns) - 1)
				$this->cstrSQLQ = $this->cstrSQLQ.$column;
			else
				$this->cstrSQLQ = $this->cstrSQLQ.$column.", ";
			$fintIndex += 1;
		}
		$this->cstrSQLQ = $this->cstrSQLQ.") ";
		$this->cstrSQLQ = $this->cstrSQLQ."VALUES(";
		$fintIndex = 0;
		foreach($pstrValues as $value)
		{
			if($fintIndex == count($pstrColumns) - 1)
				$this->cstrSQLQ = $this->cstrSQLQ."'".$value."'";
			else
				$this->cstrSQLQ = $this->cstrSQLQ."'".$value."', ";
				
			$fintIndex++;			
		}
		$this->cstrSQLQ = $this->cstrSQLQ.") ";
		
		if(!$this->mysqli->query($this->cstrSQLQ))
			printf("ERROR ".$this->mysqli->error."\n".$this->cstrSQLQ);
			
		$this->disconnect();
	}
	
	protected function updateInfo($pstrTable,$pstrColumns,$pstrValues,$pstrWhere)
	{
		$this->connect();
		$fintIndex = 0;
		
		$this->cstrSQLQ = "UPDATE ".$pstrTable." SET ";
		for($i=0;$i<count($pstrColumns);$i++)
		{
			if($fintIndex == count($pstrColumns) - 1)
				$this->cstrSQLQ = $this->cstrSQLQ.$pstrColumns[$i]." = '".$pstrValues[$i]."'";
			else
				$this->cstrSQLQ = $this->cstrSQLQ.$pstrColumns[$i]." = '".$pstrValues[$i]."', ";
		
			$fintIndex++;
		}
		$this->cstrSQLQ = $this->cstrSQLQ.$pstrWhere;
		echo($this->cstrSQLQ);
		if(!$this->mysqli->query($this->cstrSQLQ))
			printf("ERROR ".$this->mysqli->error."\n".$this->cstrSQLQ);
			
		$this->disconnect();
	}
	
	/*	@autor José Javier Romo Escobar
	 *	@since 25/11/2014
	 *	
	 *	Monta una consulta SELECT básica
	 */
	protected function createQuery($pstrTable, $pstrFields)
	{
		$fintIndex = 0;
		$this->cstrSQLQ = "SELECT ";
		foreach($pstrFields as $field)
		{
			if($fintIndex == count($pstrFields)-1)
				$this->cstrSQLQ = $this->cstrSQLQ.$field;			
			else
				$this->cstrSQLQ = $this->cstrSQLQ.$field.", ";
			
			$fintIndex++;
		}
		$this->cstrSQLQ = $this->cstrSQLQ." FROM ".$pstrTable;
	}
	

	
	
}
?>