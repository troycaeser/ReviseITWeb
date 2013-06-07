<?php
//Password must contain Upper case, Lower Case, Numerals and at least 8 Characters
function verifyPassword($password){
	 $int_options = array('options'=>array('regexp'=>'/[a-z]+/'));
	if (!filter_var($password,FILTER_VALIDATE_REGEXP,$int_options)) return false;
	 $int_options = array('options'=>array('regexp'=>'/[A-Z]+/'));
	if (!filter_var($password,FILTER_VALIDATE_REGEXP,$int_options)) return false;
	 $int_options = array('options'=>array('regexp'=>'/[0-9]+/'));
	if (!filter_var($password,FILTER_VALIDATE_REGEXP,$int_options)) return false;
	 $int_options = array('options'=>array('regexp'=>'/[^a-zA-Z0-9]+/'));
	if (filter_var($password,FILTER_VALIDATE_REGEXP,$int_options)) return false;
	if (strlen($password) < 8) return false;
	return true;
}

function isString($field){
		$int_options = array('options'=>array('regexp'=>'/[a-zA-Z0-9_-\s]+/'));
        return filter_var($field, FILTER_VALIDATE_REGEXP, $int_options);
}

function isAlphaNumeric($field){
		$int_options = array('options'=>array('regexp'=>'/[a-zA-Z0-9]+/'));
        return filter_var($field, FILTER_VALIDATE_REGEXP, $int_options);
}

function isAlpha($field){
		$int_options = array('options'=>array('regexp'=>'/[a-zA-Z]'));
        return filter_var($field, FILTER_VALIDATE_REGEXP, $int_options);
}

function _clean($field){
	return htmlspecialchars(stripslashes(strip_tags(trim($field))));
}

function checklength($field, $length){
	if (strlen($field) < $length) return false;
	return true;
}

?>