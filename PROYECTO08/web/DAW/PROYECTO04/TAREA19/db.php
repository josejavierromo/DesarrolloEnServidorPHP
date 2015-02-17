<?php
/* @autor José Javier Romo Escobar 
 * @since 06/11/2014
 * 
 * Clase encargada de la conexión y gestión de la información de la base de datos indicada
*/
class db
{
	//Variables privadas
	private $cstrServer;
	private $cstrDbName;
	private $cstrUserName;
	private $cstrPassword;
	private $cobjDescriptor;
	private $cstrInfo;
	private $carrSelect;
	
	//Constructor
	function __construct($pstrServer,$pstrDb,$pstrUser,$pstrPassword)
	{
		$this->cstrServer = $pstrServer;
		$this->cstrDbName = $pstrDb;
		$this->cstrUserName = $pstrUser;
		$this->cstrPassword = $pstrPassword;
	}
	
	
	public function connect()
	{
		$this->cobjDescriptor = new MySQLi($this->cstrServer, $this->cstrUserName, $this->cstrPassword, $this->cstrDbName);
		if($this->cobjDescriptor->connect_errno)
			$this->cstrInfo = "Fallo al conectar con el servidor".$this->cobjDescriptor->connect_error;
		else
			$this->cstrInfo = "Conectado correctamente al servidor de base de datos";
	}
	
	/* @autor José Javier Romo Escobar
	 * @since 06/11/2014
	 *
	 * Ejecuta un comando de SQL del tipo SELECT contra la base de datos  
    */
	public function getInfo($pstrTable)
	{
		$table = "";
		if($this->carrSelect = $this->cobjDescriptor->query("SELECT * FROM ".$pstrTable))
		{
			$table = "<table><tr><td>IdLugar</td><td>Lugar</td><td>Descripcion</td><td>Fecha</td></tr>";
			for($i=0;$i< $this->carrSelect->num_rows; $i++)
			{
				$this->carrSelect->data_seek($i);
				$fila = $this->carrSelect->fetch_assoc();
				$table = $table."<tr>";
				$table = $table."<td>".$fila["IdLugar"]."</td>";
				$table = $table."<td>".$fila["Lugar"]."</td>";
				$table = $table."<td>".$fila["Descripcion"]."</td>";
				$table = $table."<td>".$fila["Fecha"]."</td>";
				$table = $table."</tr>";
			}
			$table = $table."</table>";
		}
		else
			printf("ERROR: %s\n".$this->carrSelect->error);
			
		return $table;
	}
	
	
}
?>