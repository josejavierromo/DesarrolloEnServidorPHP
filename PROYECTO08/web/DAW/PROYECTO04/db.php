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
	
	//Constructor
	function __construct($pstrServer,$pstrUser,$pstrPassword,$pstrDb)
	{
		$this->cstrServer = $pstrServer;
		$this->cstrDbName = $pstrDb;
		$this->cstrUserName = $pstrUser;
		$this->cstrPassword = $pstrPassword;
	}
	
	
	public function connect()
	{
		$this->cobjDescriptor = mysqli_connect($this->cstrServer, $this->cstrUserName, $this->cstrPassword, $this->cstrDbName);
		if($this->cobjDescriptor->connect_errno)
			$this->cstrInfo = "Fallo al conectar con el servidor".$this->cobjDescriptor->connect_error;
		else
		{
			$this->cstrInfo = "Conectado correctamente al servidor de base de datos";
			mysqli_query($this->cobjDescriptor, "SET NAMES UTF8;");
		}
	}
	
	/* @autor José Javier Romo Escobar
	 * @since 06/11/2014
	 *
	 * Ejecuta un comando de SQL del tipo SELECT contra la base de datos  
    */
	public function getInfo($pstrTable)
	{
		$table = "";
		if($resultado =	mysqli_query($this->cobjDescriptor, "SELECT IdLugar, Lugar, Descripcion, Fecha FROM Lugares"))
		{
			$table = "<table><tr><td>IdLugar</td><td>Lugar</td><td>Descripcion</td><td>Fecha</td></tr>";
			for($i=0;$i< $resultado->num_rows; $i++)
			{
				$resultado->data_seek($i);
				$fila = $resultado->fetch_row();
				$table = $table."<tr>";
				$table = $table."<td>".$fila[0]."</td>";
				$table = $table."<td>".$fila[1]."</td>";
				$table = $table."<td>".$fila[2]."</td>";
				$table = $table."<td>".$fila[3]."</td>";
				$table = $table."</tr>";
			}
			$table = $table."</table>";
			
		    mysqli_free_result($resultado);
		}
		else
			printf("ERROR: %s\n".$resultado->error);
			
		return $table;
	}
	
	
}
?>