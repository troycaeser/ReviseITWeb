<?php
//Password must contain Upper case, Lower Case, Numerals and at least 8 Characters
function verifyPassword($password){
	if (!(ereg('[a-z]', $password))) return false;
	if (!(ereg('[A-Z]', $password))) return false;
	if (!(ereg('[0-9]', $password))) return false;
	if (ereg('[^a-zA-Z0-9]', $password)) return false;
	if (strlen($password) < 8) return false;
	return true;
}

function isString($field){
	if (!(ereg('[a-zA-Z _]', $field))) return false;
	return true;
}

function checklength($field, $length){
	if (strlen($field) < $length) return false;
	return true;
}

function checkEmail($email){
	if (eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email)) return false;
 	list($Username, $Domain) = split("@",$email);
	if(getmxrr($Domain, $MXHost)) 
	{
	   return TRUE;
	}
	else 
	{
	   if(fsockopen($Domain, 25, $errno, $errstr, 30)) 
	   {
		  return TRUE; 
	   }
	   else 
	   {
		  return FALSE; 
	   }
	}
}
?>