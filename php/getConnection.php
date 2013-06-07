<?php
/*
	$hostname = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'reviseit';
    $connect_error = 'Sorry, We\'re experiencing connection problems.';
    
    

    //connecting to the databse using variables
	mysql_connect($hostname, $username, $password) or die ($connect_error);

	$con = mysqli_connect($hostname, $username, $password, $dbname);

	//selecting a database
	mysql_select_db($dbname) or die($connect_error);

    */


    //getConnection();
    

    // $config['db'] = array(
    //     'host'          =>'localhost',
    //     'username'      =>'root',
    //     'password'      =>'root',
    //     'dbname'        =>'reviseit'
    // );


    // $db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $config['db'] = array(
        'host'          =>'reviseithg.db.11048397.hostedresource.com',
        'username'      =>'reviseithg',
        'password'      =>'ReviseIT!2013',
        'dbname'        =>'reviseithg'
    );


    $db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>