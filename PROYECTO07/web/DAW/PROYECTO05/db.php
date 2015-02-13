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
	
	/* @autor José Javier Romo Escobar
	 * @since 06/11/2014
	 *
	 * Ejecuta un comando de SQL del tipo SELECT contra la base de datos  
    */
	protected function getInfo($pstrTable, $pstrFields)
	{
		$table = "";
		$this->createQuery($pstrTable,$pstrFields);
		if(!$this->resultado = $this->mysqli->query($this->cstrSQLQ))
			$table = "ERROR: %s\n".$this->mysqli->error;
			
		return $table;
	}
	
	protected function setInfo($pstrTable,$pstrColumns,$pstrValues)
	{
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
	}
	
	protected function updateInfo($pstrTable,$pstrColumns,$pstrValues,$pstrWhere)
	{
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
		
		if(!$this->mysqli->query($this->cstrSQLQ))
			printf("ERROR ".$this->mysqli->error."\n".$this->cstrSQLQ);
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