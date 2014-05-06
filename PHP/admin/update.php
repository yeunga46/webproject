<?php

/*
 * Updates trivia table with questions from sub_trivia if accepted
 */ 
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

$dbh = ConnectDB();
$entered = FALSE;
if (isset($_POST["count"])) {
	if ($_POST["count"] != 0) {
		$c = $_POST["count"] + 1;
		for ($i = 1; $i < $c; $i++) {

			if (isset($_POST["q" . $i])) {
				$entered = TRUE;
				$temp = explode('-', $_POST["q" . $i]);
				if ($temp[0] == 1) {
					echo "accepted " . $temp[1]."<br>";
					acceptQuestion($dbh, $temp[1]);
					deleteQuestion($dbh, $temp[1]);
				} else {
					echo "rejected " . $temp[1]."<br>";
					deleteQuestion($dbh, $temp[1]);
				}
			}
		}
		if (!$entered) {
			echo "There are no questions submited.";
		}
		header('Refresh: 3; URL=./index.php');
	} else {
		echo "There are no questions in sub_trivia.";
		header('Refresh: 3; URL=./index.php');
	}
} else {
	echo "Count is not set";
	header('Refresh: 3; URL=./index.php');
}
/**
 * Deletes rejected question from sub trivia
 *
 * @return void
 * @author  andy
 */
function deleteQuestion($dbh, $id) {
	try {
		$query = 'DELETE FROM sub_trivia WHERE id=:id';
		$stmt = $dbh -> prepare($query);

		$stmt -> bindParam('id', $id);

		$stmt -> execute();
		$removed = $stmt -> rowCount();

		$stmt = null;

	} catch(PDOException $e) {
		die('PDO error deleting(): ' . $e -> getMessage());
	}

}
/**
 * Get the accepted question from sub_trivia
 *
 * @return $questiondata
 * @author  andy
 */
function getQuestions($dbh, $id) {
	// fetch the data
	try {
		// set up query
		$question_query = "SELECT * FROM sub_trivia WHERE id ='" . $id . "' limit 1";
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
/**
 * Inserts accepted question to trivia
 *
 * @return void
 * @author  andy
 */
function acceptQuestion($dbh, $id) {
	$result = getQuestions($dbh, $id);
	try {
		$query = 'INSERT INTO trivia (question, correct_answer, fake1,fake2,fake3) ' . 'VALUES (:question, :correct_answer,:fake1,:fake2,:fake3)';
		$stmt = $dbh -> prepare($query);

		$stmt -> bindParam(':question', $result['question']);
		$stmt -> bindParam(':correct_answer', $result['correct_answer']);
		$stmt -> bindParam(':fake1', $result['fake1']);
		$stmt -> bindParam(':fake2', $result['fake2']);
		$stmt -> bindParam(':fake3', $result['fake3']);

		$stmt -> execute();
		$inserted = $stmt -> rowCount();

		$stmt = null;
	} catch(PDOException $e) {
		die('PDO error deleting(): ' . $e -> getMessage());
	}

}
?>
