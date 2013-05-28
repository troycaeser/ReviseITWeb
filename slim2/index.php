<?php
//This document requires slim
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

//Method Pointers
$app->get('/getNewSub/:idSub','getSubNew');
$app->get('/getAll/', 'getAll');
$app->post('/token/', "verifyToken"); 
$app->get('/date/subject/:id/', "getSubjectDate"); 
$app->get('/date/topic/:id/', "getTopicDate"); 
$app->get('/date/subtopic/:id/', "getSubtopicDate"); 
$app->post('/testsummary/:userid/:testid/', "uploadTestSummary");



function getAll()
{ //Gets all subjects(to create list of them)
	try
	{
		$dbh = getConnection();		
		$request = \Slim\Slim::getInstance()->request();
		$q = json_decode($request->getBody());
		$sql = "SELECT * FROM subject";
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_OBJ);
		$db=NULL;
		
		echo json_encode($rows);
	}
	catch (PDOException $e)
	{
		if($dbh != NULL) $dbh = NULL;
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

//Phone calls this function and gives it an ID. everything below the subject(topic sub topic test 
//etc etc is put into a JSON string and sent to the caller)
function getSubNew($idSub)
{
	$sql = "SELECT * from subject where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		$jsonSubjects = json_encode($stmt->fetch(PDO::FETCH_ASSOC));
		$dbh=null;
		
		
		echo '{"subject": ';
		echo $jsonSubjects;
		echo ',"topic": ';
		echo getTopNew($idSub);
		echo goTest($idSub);
		echo '}';
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function goTest($idSub)
{
	$sql = "SELECT * from topic where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		$rows = $stmt->fetchAll();		

		foreach ($rows as $r)
		{
		getTest($r['TopicID']);
		}
		
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getTest($idTop)
{
	$sql = "SELECT * from subtopic where TopicID=:idTop";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTop",$idTop);
		$stmt->execute();
		$rows = $stmt->fetchAll();		

		foreach ($rows as $r)
		{
		getRelTest($r['SubtopicID']);
		}
		
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getRelTest($idSubid)
{
	$sql = "SELECT * from test where SubtopicID=:idSubid";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSubid",$idSubid);
		$stmt->execute();
		$rows = $stmt->fetchAll();		

		foreach ($rows as $r)
		{
		getRelMulti($r['TestID']);
		}
		
		foreach ($rows as $r)
		{
		getRelTrueFalse($r['TestID']);
		}
			
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getRelTrueFalse($idTest)
{
	$sql = "SELECT * from truefalse where TestID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->execute();
		$jsonTF = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));		
		if($jsonTF == '[]')
		{
			
		}
		else
		{
		echo ',"truefalse": ';
		echo $jsonTF;
		}
		
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getRelMulti($idTest)
{
	$sql = "SELECT * from multichoice where TestID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->execute();
		$jsonMultis = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));		
		
		echo ',"multichoice": ';
		echo $jsonMultis;
			
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}



function getTopNew($idSub)
{
	$sql = "SELECT * from topic where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		$jsonTopics = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
		
		$dbh=null;
		
		echo $jsonTopics;
		echo ',"subtopic": [';	
		getTop($idSub);
		echo ']';
		
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getTop($idSub)
{
	$sql = "SELECT * from topic where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		
		$rows = $stmt->fetchAll();		
		
		$dbh=null;
		$counts = 0;
		foreach ($rows as $r)
		{
		$counts++;
		$nume = 0;
		$nume =	$r['TopicID'];
		getSubTopNew($nume, $counts);
		}
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getSubTopNew($idTop, $counts)
{
	$sql = "SELECT * from subtopic where TopicID=:idTop";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTop",$idTop);
		$stmt->execute();
		
		while($re = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$jsonSubTop = json_encode($re);
			if($counts==1)
			{
			
			}
			else
			{
			echo ',';
			}
			echo $jsonSubTop;
			$counts = 2;
			}				
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

//Create connention to the database

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

$app->run();

// //Create connection to the database
// //
// function getConnection() 
// {
// 	try
// 	{
// 		$hostname="reviseithg.db.11048397.hostedresource.com"; 
// 		$username="reviseithg";
// 		$password="ReviseIT!2013";
// 		$dbname="reviseithg";
// 		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
// 		return $dbh;	
// 	}
// 	catch(PDOException $e)
// 	{
// 		if($dbh != null) $dbh = null;
// 		echo $e->getMessage();
// 	}
// }

// //runs the app
// $app->run();

//Anything below here isnt in use, but is kept as reference

/*//Gets content(not used currently)
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
}*/
