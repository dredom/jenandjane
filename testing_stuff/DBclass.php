<?php
//////////////////////////////////////////////////////////////////////////////////////
/* DBClass v1.3 written by Matthew Manela
   Script orginally written for www.Jemts.com
   Copyright (C) 2003 Matthew Manela. All rights reserved.
   See readme file for instructions on implementing and using this class.
   If you have any question about this script please email me at jemts@jemts.com.
   Updates to this class will come regularly.	 
*/
//////////////////////////////////////////////////////////////////////////////////////
//Start of class
class Database{
var $DBname, $DBuser, $DBpass, $DBhost;
var $DBlink, $Result;
var $Connection;

###########################################
# Function:    Database - constructor
# Parameters:  database name, database username, database password, database host
# Return Type: boolean
# Description: connect to database, and select database, if database doesn't exist create it and selects it
###########################################
function Database($name, $user, $pass, $host){
$this->DBname=$name;
$this->DBuser=$user;
$this->DBpass=$pass;
$this->DBhost=$host;
if(!($this->DBlink = mysql_connect($this->DBhost, $this->DBuser, $this->DBpass))){
 	echo mysql_errno() . ": " . mysql_error() . "\n";
 	trigger_error ("Cannot connect to database", E_USER_ERROR); 
	 return FALSE;
}else{
	if(!mysql_select_db($this->DBname,$this->DBlink)){
		if(!$this->Query("CREATE DATABASE $this->DBname")){
			echo mysql_errno() . ": " . mysql_error() . "\n";
			trigger_error ("Cannot create new database", E_USER_ERROR);
			return FALSE;
		}else{
			if(mysql_select_db($this->DBname,$this->DBlink)){
				return TRUE;
			}else{
				echo mysql_errno() . ": " . mysql_error() . "\n";			
				trigger_error ("Cannot connect to newly created database", E_USER_ERROR);
				return FALSE;
				}
		}
	}else{
	return TRUE;
	}
return TRUE ;
}
}#end of database constructor
//////////////////////////////////////////////////////////////////////////////////////



###########################################
# Function:    Disconnect
# Parameters:  none
# Return Type: boolean
# Description: disconnects from database
###########################################
function Disconnect(){
	if(mysql_close($this->DBlink)){  
	return TRUE;
	}else{
	echo mysql_errno() . ": " . mysql_error() . "\n";
	trigger_error ("Cannot close the database", E_USER_ERROR);
	return FALSE;
	}
}#end of disconnect
//////////////////////////////////////////////////////////////////////////////////////



###########################################
# Function:    DeleteDB
# Parameters:  Name of DB
# Return Type: boolean
# Description: Deletes specified database
###########################################
function DeleteDB($name){

if(!mysql_drop_db($name)){
	echo mysql_errno() . ": " . mysql_error() . "\n";
	trigger_error ("Cannot delete the database", E_USER_ERROR);
	return FALSE;
}else{
	return TRUE;
}
}#end of DeleteDB
//////////////////////////////////////////////////////////////////////////////////////




###########################################
# Function:    ChooseDB
# Parameters:  none
# Return Type: boolean
# Description: changes the DB you are working on, if it doens't exist creates a new one and selects it
###########################################
function ChooseDB($name){
$this->DBname=$name;
	if(!mysql_select_db($this->DBname,$this->DBlink)){
		if(!$this->Query("CREATE DATABASE $this->DBname")){
			echo mysql_errno() . ": " . mysql_error() . "\n";			
			trigger_error ("Cannot create new database", E_USER_ERROR);
			return FALSE;
		}else{
			return TRUE;
		}
	}else{
		return TRUE;
	}
}#end of ChooseDB
//////////////////////////////////////////////////////////////////////////////////////

###########################################
# Function:    Query
# Parameters:  sqlstring , type
# Return Type: Either boolean or array depending on type of query
#			   If it is a delete query returns number of rows affected
# Description: executes any SQL Query statement
###########################################

function Query($Query){
	$Query = trim($Query);
	if(eregi("^((SELECT)|(SHOW)|(EXPLAIN)|(DESCRIBE))",$Query)){
		if($this->Result = mysql_query($Query,$this->DBlink)) {
			 $i = 0;
			 $data = array();
			while ($row = mysql_fetch_array($this->Result)) {
						$data[$i] = $row;
						$i++;
			}
			mysql_free_result($this->Result);//probably not needed
			return $data;
		}else{
			//no entry exists in databse
			return FALSE;
		}
	}else{
		$result = mysql_query($Query,$this->DBlink);
		if(!isset($result) || is_null($result)){
			echo mysql_errno() . ": " . mysql_error() . "\n";
			trigger_error ("Query did not succeed", E_USER_ERROR);
			return FALSE;
		}
		elseif(eregi("^DELETE",$Query)){
			return @mysql_affected_rows();
		}
		else return true;

	}
}#end of query function

}#End of class

?>