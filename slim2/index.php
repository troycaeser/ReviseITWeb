<?php
//This document requires slim
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

//Method Pointers
$app->get('/getAll/', 'getAll');
$app->get('/getContent/:subid', 'getContent');
$app->get('/getSubjects/', 'getSubjects');
$app->get('/getTopic/:sub', 'getTopic');
$app->get('/getSubtopic/:top', 'getSubtopic');
$app->get('/getTest/:subid', 'getTest');
$app->post('/token/', "verifyToken"); 
$app->get('/date/subject/:id/', "getSubjectDate"); 
$app->get('/date/topic/:id/', "getTopicDate"); 
$app->get('/date/subtopic/:id/', "getSubtopicDate"); 
$app->post('/testsummary/:userid/:testid/', "uploadTestSummary");
$app->post('/login/', "login");
$app->post('/signup/', "signup");

//Gets entire table - subject
function getAll()
{
	$sql = "SELECT * from subject";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '["subject"' . json_encode($rows) . ']' . getTopics();
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets entire table - topic
function getTopics()
{
	$sql = "SELECT * from topic";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '["topic"' . json_encode($rows) . ']' . getSubTopics();
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets entire table - subtopic
function getSubTopics()
{
	$sql = "SELECT * from subtopic";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '["subtopic"' . json_encode($rows) . ']' . getTests();
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets entire table - test
function getTests()
{
	$sql = "SELECT * from test";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '["test"' . json_encode($rows) . ']' . getMultichoice();
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets entire table - multichoice
function getMultichoice()
{
	$sql = "SELECT * from multichoice";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '["multichoice"' . json_encode($rows) . ']';
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}


// Verify Token With Server
//
function verifyToken() 
{
	try
	{
		$dbh = getConnection();		
		$request = \Slim\Slim::getInstance()->request();
		$q = json_decode($request->getBody());
		$sql = "SELECT tokenCode from token ORDER BY tokenDate DESC LIMIT 1;";
		
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db=NULL;
		
		if($row->tokenCode == $q->token)
			echo('{"AKEY":"true"}');
		else
			echo('{"AKEY":"false"}');
	}
	catch (PDOException $e)
	{
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Get Subject Date
//
function getSubjectDate($id) 
{
	try
	{
		$dbh = getConnection();		
		$sql = "SELECT Dateupdated FROM subject WHERE SubjectID = :id;";
		
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db = NULL;
		echo json_encode($row);
	}
	catch (PDOException $e)
	{
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Get Topic Date
//
function getTopicDate($id) 
{
	try
	{
		$dbh = getConnection();		
		$sql = "SELECT Dateupdated FROM topic WHERE TopicID = :id;";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db = NULL;
		echo json_encode($row);
	}
	catch (PDOException $e)
	{
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Get Subtopic Date
//
function getSubtopicDate($id) 
{
	try
	{
		$dbh = getConnection();		
		$sql = "SELECT DateUpdated FROM subtopic WHERE SubtopicID = :id;";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db = NULL;
		echo json_encode($row);
	}
	catch (PDOException $e)
	{
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Upload test summary to the database
//
function uploadTestSummary($testid, $userid) 
{
	try
	{
		$dbh = getConnection();		
		$request = \Slim\Slim::getInstance()->request();
		$q = json_decode($request->getBody());
		$sql = "INSERT INTO result (result, testid, userid) VALUES (:result, :testid, :userid);";
		
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("result", $q->result);
		$stmt->bindParam("testid", $testid);
		$stmt->bindParam("userid", $userid);
		$stmt->execute();
		$db = NULL;
	}
	catch (PDOException $e){
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Get testIDs, questions and answers
//
function getTest($subid)
{
	$sql = "SELECT * from test where SubtopicID=:subid";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("subid",$subid);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$dbh=null;
		if($row!=null)
		{
			$idTest = $row->TestID; 
			getMulti($idTest);
			$dl = $row->Downloads;
			downloads($idTest, $dl);
		}
		else
		{
			echo 'false';
		}
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Increment the download count per test
//
function downloads($idTest, $dl)
{
	$sql = "UPDATE test SET downloads=:dl+1 WHERE testID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->bindParam("dl",$dl);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		return json_encode($rows);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Get multichoice questions and answers(calls other methods and peice's them together within this one
//
function getMulti($idTest)
{
	$sql = "SELECT * from multichoice where TestID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo '{"Multi":' . json_encode($rows) . ', "Truefalse":' . getTf($idTest) . '}';
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Get true or false questions and answers(returns them into another method as a JSON String)
//
function getTf($idTest)
{
	$sql = "SELECT * from truefalse where TestID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		return json_encode($rows);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets content(not used currently)
//
function getContent($subid)
{
	$sql = "SELECT Content from subtopic where SubtopicID=:subid";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("subid",$subid);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$dbh=null;
		echo json_encode($row);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//gets subject info
//
function getSubjects()
{
	$sql = "SELECT * from subject";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh=null;
		echo json_encode($rows);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets topic info in relativity to the selected subject
//
function getTopic($sub)
{
	$sql = "SELECT * from topic where subjectID=:sub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("sub",$sub);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$dbh=null;
		echo json_encode($row);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Gets subtopic info in relativity to the selected topic
//
function getSubtopic($top)
{
	$sql = "SELECT * from Subtopic where topicID=:top";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("top",$top);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$dbh=null;
		echo json_encode($row);
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Logs in with user and pass (MOBILE)
//
function login() 
{
	try{
		$dbh = getConnection();		
		$request = \Slim\Slim::getInstance()->request();
		$q = json_decode($request->getBody());
		$sql = "SELECT UserID, fName, lName FROM users WHERE username = :username and password = :password;";
		
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("username", $q->username);
		$stmt->bindParam("password", $q->password);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db=NULL;
		
		if($row != NULL)
			echo '{"AKEY":"true", "UserID":"'.$row['UserID'].'"}';
		else
			echo '{"AKEY":"false, "UserID":"0"}';

	}
	catch (PDOException $e){
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Allows for sign up on mobile
//
function signup() {
	try{
		$dbh = getConnection();		
		$request = \Slim\Slim::getInstance()->request();
		$q = json_decode($request->getBody());
		
		$sql = "INSERT INTO users (username, fName, lName, password, role) VALUES (:username, :fName, :lName, :password, '4');";		
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("username", $q->username);
		$stmt->bindParam("fName", $q->fName);
		$stmt->bindParam("lName", $q->lName);
		$stmt->bindParam("password", $q->password);
		$stmt->execute();
				
		$sql = "SELECT UserID FROM users WHERE username = :username AND password = :password;";		
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("username", $q->username);
		$stmt->bindParam("password", $q->password);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_OBJ);
		$db=NULL;
		
		if($row != NULL)
			echo '{"AKEY":"true", "UserID":"'.$row->UserID.'"}';
		else
			echo '{"AKEY":"false", "UserID":"0"}';

	}
	catch (PDOException $e){
		if($dbh != NULL) $dbh = NULL;
		echo $e->getMessage();
	}
}

//Create connention to the database
//
function getConnection() 
{
	try
	{
		$hostname="localhost"; 
		$username="root";
		$password="root";
		$dbname="reviseit";
		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		return $dbh;	
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//runs the app
$app->run();

