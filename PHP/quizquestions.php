<?php
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

$dbh = ConnectDB();

$max = numOfQuestions($dbh);
$quiz = array();
$do = $_GET["action"];

function numOfQuestions($dbh) {
	// fetch the data
	try {
		// set up query
		$phone_query = "SELECT COUNT(*) as max FROM trivia ";
		// prepare to execute (this is a security precaution)
		$stmt = $dbh -> prepare($phone_query);
		// run query
		$stmt -> execute();
		// get all the results from database into array of objects
		$phonedata = $stmt -> fetchAll(PDO::FETCH_OBJ);
		// release the statement
		$stmt = null;
		$phonedata = get_object_vars($phonedata[0]);

		$result = intval($phonedata['max']);
		return $result;
	} catch(PDOException $e) {
		die('PDO error in ListAllPhones()": ' . $e -> getMessage());
	}
}

function getQuestions($dbh, $id) {
	// fetch the data
	try {
		// set up query
		$phone_query = "SELECT * FROM trivia WHERE id ='" . $id . "' limit 1";
		// prepare to execute (this is a security precaution)
		$stmt = $dbh -> prepare($phone_query);
		// run query
		$stmt -> execute();
		// get all the results from database into array of objects
		$phonedata = $stmt -> fetchAll(PDO::FETCH_OBJ);
		// release the statement
		$stmt = null;
		$phonedata = get_object_vars($phonedata[0]);
		return $phonedata;
	} catch(PDOException $e) {
		die('PDO error in ListAllPhones()": ' . $e -> getMessage());
	}
}

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

if ($do == 'getQuiz') {
	$questions = getQuestionNum($max, array());

	foreach ($questions as $id) {
		$result = getQuestions($dbh, $id);
		$ques = $result['question'];
		$first = $result['fake1'];
		$second = $result['fake2'];
		$third = $result['fake3'];
		$fourth = $result['correct_answer'];
		if (isset($first) && isset($second) && isset($third)) {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $second, 'c3' => $third, 'c4' => $fourth, 'type' => "MC", 'qid' => $id));
		} elseif (isset($first) && isset($second)) {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $second, 'c3' => $third, 'type' => "MC", 'qid' => $id));
		} elseif (isset($first)) {
			array_push($quiz, array('question' => $ques, 'c1' => $first, 'c2' => $second, 'type' => "MC", 'qid' => $id));
		} else {
			array_push($quiz, array('question' => $ques, 'type' => "SA", 'qid' => $id));
		}
	}

	echo json_encode($quiz);
}
if ($do == 'check') {

	$id = $_GET["id"];
	$response = strtolower($_GET["response"]);
	if (isset($id) && isset($response)) {

		$result = getQuestions($dbh, $id);

		$check = strtolower($result['correct_answer']);

		if ($check == $response) {
			echo "true";
		} else {
			echo "false";
		}
	}

}
?>
