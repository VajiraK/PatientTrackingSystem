<?php
	function OpenConnection(){ 
		//$con = mysql_connect('localhost','suwayahealthcare','nokia6300') or die("couldn't connect to the server");
		$con = mysql_connect('localhost','root','') or die("couldn't connect to the server");
		mysql_select_db('pts',$con) or die("Couldn't open DB");
		return $con;
	}  
	/* -------------------------------------------------------------------------------------- */
	function SQLErrorPage($sql){
		header("Location: " . $_SESSION['pre_fix'] . "lib/sql_exploit_warning.php");
	}
	/* -------------------------------------------------------------------------------------- */
	function ExecuteMultipleSQL($sql){
		$queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $sql); 
		foreach ($queries as $query){ 
			if (strlen(trim($query))>0) 
				mysql_query($query); 
		} 
	}
	/* -------------------------------------------------------------------------------------- */
	function ExecuteSQL($sql){
		//********** ValidateSQL ***************************
		//throw new Exception('SQL Error');
		//********** ValidateSQL ***************************
		/*$resultado = mysql_query($sql);
		if (!$resultado) {
    			die('Error: ' . mysql_error());
		}*/
		return mysql_query($sql);
	}
	/* -------------------------------------------------------------------------------------- */
	function GetOneRowEx($sql){
	try{	
		$con = OpenConnection();
		$result = ExecuteSQL($sql);
		mysql_close($con);
		
		if(mysql_num_rows($result)!=0)
		{
			return mysql_fetch_array($result);
		}else{
			return 0;
		}
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	}  
	/* -------------------------------------------------------------------------------------- */
	function Delete($sql){
	try{
		$con = OpenConnection();
		ExecuteSQL($sql);
		mysql_close($con);
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	}  
	/* -------------------------------------------------------------------------------------- */
	function Update($sql){
	try{
		$con = OpenConnection();
		ExecuteSQL($sql);
		mysql_close($con);
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	} 
	/* -------------------------------------------------------------------------------------- */
	function UpdateWithCon($sql){
	try{
		ExecuteSQL($sql);
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	} 
	/* -------------------------------------------------------------------------------------- */
	function InsertWithCon($sql){
	try{
		ExecuteSQL($sql);
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	}  
	/* -------------------------------------------------------------------------------------- */
	function Insert($sql){
	try{
		$con = OpenConnection();
		ExecuteSQL($sql);
		mysql_close($con);
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	}  
	/* -------------------------------------------------------------------------------------- */
	function GetOneRowWithCon($con,$sql){
	try{	
		$result = ExecuteSQL($sql);
		if(mysql_num_rows($result)!=0)
			return mysql_fetch_array($result);
		else
			return 0;
	}catch(Exception $e){mysql_close($con);SQLErrorPage();}
	}   
?>