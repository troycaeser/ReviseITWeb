<?php
//Password must contain Upper case, Lower Case, Numerals and at least 8 Characters
function verifyPassword($password){
	if (!(preg_match('/[a-z]/', $password))) return false;
	if (!(preg_match('/[A-Z]/', $password))) return false;
	if (!(preg_match('/[0-9]/', $password))) return false;
	if (preg_match('/[^a-zA-Z0-9]/', $password)) return false;
	if (strlen($password) < 8) return false;
	return true;
}

function isString($field){
	if (preg_match("/^[A-Za-z0-9_- \!\@\#\$\%\^\&\a*\(\)\+\=\{\}\[\]\:\;\"\'\<\>\,\.\?\/\|\\]+$/", $field)) return false;
	else return true;
}

function isAlphaNumeric($field){
	if (preg_match('/[^a-zA-Z0-9 _]/', $field)) return false;
	else return true;
}

function checklength($field, $length){
	if (strlen($field) < $length) return false;
	return true;
}

?>