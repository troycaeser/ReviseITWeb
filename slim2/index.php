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

ini_set('max_execution_time', 600);

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

$counter = 0;
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
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbh=null;
				
		global $counter;
		
		foreach ($rows as $r)
		{		
			if($r == null)
			{
				
			}
			else
			{
				if($counter == 0)
				{
					echo '{"MultiChoiceID": "' . $r['MultiChoiceID'] . '",';
					echo '"Question": "' . $r['Question'] . '",';
					echo '"Answer1": "' . $r['Answer1'] . '",';
					echo '"Answer2": "' . $r['Answer2'] . '",';
					echo '"Answer3": "' . $r['Answer3'] . '",';
					echo '"Answer4": "' . $r['Answer4'] . '",';
					echo '"TestID": "' . $r['TestID'] . '",';
					echo '"correctAns": "' . $r['correctAns'] . '"}';
				}
				else
				{
					echo ', {"MultiChoiceID": "' . $r['MultiChoiceID'] . '",';
					echo '"Question": "' . $r['Question'] . '",';
					echo '"Answer1": "' . $r['Answer1'] . '",';
					echo '"Answer2": "' . $r['Answer2'] . '",';
					echo '"Answer3": "' . $r['Answer3'] . '",';
					echo '"Answer4": "' . $r['Answer4'] . '",';
					echo '"TestID": "' . $r['TestID'] . '",';
					echo '"correctAns": "' . $r['correctAns'] . '"}';
				}
				$counter++;
			}
		}
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}


$counter1 = 0;
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
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbh=null;
		
		global $counter1;
		
		foreach ($rows as $r)
		{		
			if($r == null)
			{
				
			}
			else
			{
				if($counter1 == 0)
				{
					echo '{"TrueFalseID": "' . $r['TrueFalseID'] . '",';
					echo '"Question": "' . $r['Question'] . '",';
					echo '"correctAns": "' . $r['correctAns'] . '",';
					echo '"TestID": "' . $r['TestID'] . '"}';
				}
				else
				{
					echo ', {"TrueFalseID": "' . $r['TrueFalseID'] . '",';
					echo '"Question": "' . $r['Question'] . '",';
					echo '"correctAns": "' . $r['correctAns'] . '",';
					echo '"TestID": "' . $r['TestID'] . '"}';
				}
				$counter1++;
			}
		}
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
		echo ', "multichoice": [';
		echo getTopIds($idSub);
		echo '], "test": [';
		echo getTopIds1($idSub);
		echo ']}';
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getTopIds1($idSub)
{
	$sql = "SELECT * from topic where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		$jsonTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
		foreach ($jsonTopics as $r)
		{
		getSubIds1($r['TopicID']);	
		}
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getSubIds1($idTop)
{
	$sql = "SELECT * from subtopic where TopicID=:idTop";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTop",$idTop);
		$stmt->execute();
		$jsonSubtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbh=null;
		
		foreach ($jsonSubtopics as $r)
		{
		getTf($r['SubtopicID']);
		}
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getTopIds($idSub)
{
	$sql = "SELECT * from topic where SubjectID=:idSub";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idSub",$idSub);
		$stmt->execute();
		$jsonTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
		foreach ($jsonTopics as $r)
		{
		getSubIds($r['TopicID']);	
		}
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function getSubIds($idTop)
{
	$sql = "SELECT * from subtopic where TopicID=:idTop";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTop",$idTop);
		$stmt->execute();
		$jsonSubtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbh=null;
	
		foreach ($jsonSubtopics as $r)
		{
		getMulti($r['SubtopicID']);
		}
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
			incDown($re['SubtopicID']);
			}				
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function incDown($id)
{
	$sql = "UPDATE subtopic SET Downloads = Downloads + 1 WHERE SubtopicID=:id";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("id",$id);
		$stmt->execute();
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

		// $hostname="reviseithg.db.11048397.hostedresource.com"; 
		// $username="reviseithg";
		// $password="ReviseIT!2013";
		// $dbname="reviseithg";
		// $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		// return $dbh;
			
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

$app->run();


/*
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
		echo ', "truefalse":';
		
		$flag = 0;
		
		foreach ($rows as $r)
		{
		if($flag > 0)
		{
			echo ", ";
		}
		gett($r['TopicID']);
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
		
		$dbh=null;
		
		foreach ($rows as $r)
		{
		getRelMulti($r['SubtopicID']);
		}
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
		
		if($jsonMultis == '[]')
		{
			
		}
		else
		{
		echo ',"multichoice": ';
		echo $jsonMultis;
		}

		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

function gett($idTest)
{
	$sql = "SELECT * from truefalse where TestID=:idTest";
	try
	{
		$dbh = getConnection();
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam("idTest",$idTest);
		$stmt->execute();
		$jsonTf = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		foreach($jsonTf as $r)
		{
		if(json_encode($jsonTf) == '[]')
		{
			
		}
		else
		{
			echo '{"TrueFalseID":"' . $r['TrueFalseID'] . '","Question":"' . $r['Question'] . '","correctAns":"' . $r['correctAns']. '","TestID":"' . $r['TestID'] . '"}';
			global $flag;
		}
		}
		$dbh=null;
	}
	catch(PDOException $e)
	{
		if($dbh != null) $dbh = null;
		echo $e->getMessage();
	}
}

*/