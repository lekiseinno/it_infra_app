<?php
class Sqlsrv_LeKise_Group
{
	private $con;
	public function getConnect()
	{
		$serverName			=	"10.10.2.31";
		$connectionInfo		=	array(
										"Database"		            =>	"LeKise_Group",
										"UID"						=>	"innovation",
										"PWD"						=>	"Inno12345",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"			 	=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);

		$this->con	=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$this->con) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$this->con;
		}
	}
	public function getQuery($sql){
		// var_dump($sql);
		$query= sqlsrv_query($this->getConnect(), $sql) or die( "die SetQuery = " . print_r( sqlsrv_errors(), true));
		return $query;
	}
	public function getResult($query){
		return sqlsrv_fetch_array($query , SQLSRV_FETCH_ASSOC);
	}
	public function getnumrow($query){
		return sqlsrv_num_rows($query);
	}
	public function destroy(){
		return sqlsrv_close($this->getConnect());
	}
}
class Sqlsrv_quotation_approve
{
	private $con;
	public function getConnect()
	{
		$serverName			=	"10.10.2.31";
		$connectionInfo		=	array(
										"Database"		            =>	"quotation_approve",
										"UID"						=>	"innovation",
										"PWD"						=>	"Inno12345",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"			 	=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);

		$this->con	=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$this->con) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$this->con;
		}
	}
	public function getQuery($sql){
		// var_dump($sql);
		$query= sqlsrv_query($this->getConnect(), $sql) or die( "die SetQuery = " . print_r( sqlsrv_errors(), true));
		return $query;
	}
	public function getResult($query){
		return sqlsrv_fetch_array($query , SQLSRV_FETCH_ASSOC);
	}
	public function getnumrow($query){
		return sqlsrv_num_rows($query);
	}
	public function destroy(){
		return sqlsrv_close($this->getConnect());
	}
}
?>