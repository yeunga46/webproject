<?php
// Used to get the questions, count, and check solution for questions based on action
//Authors Andy Yeung and Jason Fiduk
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

$dbh = ConnectDB();

$max = numOfQuestions($dbh);
$quiz = array();
$do = $_GET["action"];
//gets the count of the questions in the database. Used for setting max and displaying.
function numOfQuestions($dbh) {
	// fetch the data
	try {
		// set up query
		$question_query = "SELECT COUNT(*) as max FROM trivia ";
		// prepare to execute (this is a security precaution)
		$stmt = $dbh -> prepare($question_query);
		// run query
		$stmt -> execute();
		// get all the results from database into array of objects
		$questiondata = $stmt -> fetchAll(PDO::FETCH_OBJ);
		// release the statement
		$stmt = null;
		$questiondata = get_object_vars($questiondata[0]);

		$result = intval($questiondata['max']);
		return $result;
	} catch(PDOException $e) {
		die('PDO error in ListAllquestions()": ' . $e -> getMessage());
	}
}
//Grabs a questiona from the database and returns it. 
function getQuestions($dbh, $id) {
	// fetch the data
	try {
		// set up query
		$question_query = "SELECT * FROM trivia WHERE id ='" . $id . "' limit 1";
		// prepare to execute (this is a security precaution)
		$stmt = $dbh -> prepare($question_query);
		// run query
		$stmt -> execute();
		// get all the results from database into array of objects
		$questiondata = $stmt -> fetchAll(PDO::FETCH_OBJ);
		// release the statement
		$stmt = null;
		$questiondata = get_object_vars($questiondata[0]);
		return $questiondata;
	} catch(PDOException $e) {
		die('PDO error in ListAllquestions()": ' . $e -> getMessage());
	}
}
//Gets all the possible questions that havent been picked yet.  Pushes the values into an array for getting later.
function getQuestionNum($max, $exc) {
	$exclude = array();
	if (isset($exc)) {
		$exclude = $exc;
	}
	$questions = array();

	for ($i = 0; $i < $max; $i++) {
		do {
			$n = rand(1, $max);

		} while(in_array($n, $exclude));
		array_push($exclude, $n);
		array_push($questions, $n);
	}
	return $questions;
}
//On this action, it will get the unused questions and store their ids, then get all the questions 1 at a time
//and seperate them depending on their question type.
if ($do == 'getQuiz') {
	$questions = getQuestionNum($max, array());

	foreach ($questions as $id) {
		$result = getQuestions($dbh, $id);
		$ques = $result['question'];
		$first = $result['fake1'];
		$second = $result['fake2'];
		$third = $result['fake3'];
		$fourth = $result['correct_answer'];
		if (is_null($first) && is_null($second) && is_null($third)) {
			array_push($quiz, array('question' => $ques, 'type' => "SA", 'qid' => $id));
		} elseif (is_null($second) && is_null($third)) {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $fourth, 'type' => "MC", 'qid' => $id));
		} elseif (is_null($third)) {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $second, 'c3' => $fourth, 'type' => "MC", 'qid' => $id));
		} else {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $second, 'c3' => $third, 'c4' => $fourth, 'type' => "MC", 'qid' => $id));
		}
	}

	echo json_encode($quiz);
}
//Checks the answer of the question, by getting the solution to the question from the database and comparing 
//with the players answer.  Returns 1 for correct 0 for not correct.
if ($do == 'check') {

	$id = $_GET["id"];
	$response = strtolower($_GET["response"]);
	if (isset($id) && isset($response)) {

		$result = getQuestions($dbh, $id);

		$check = strtolower($result['correct_answer']);

		if ($check == $response) {
			echo 1;
		} else {
			echo 0;
		}
	}

}
//Returns the count of questions in the database for displaying on the front page.
if ($do == 'count') {

	echo $max;

}
?>
