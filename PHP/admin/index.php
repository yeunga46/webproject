<?php
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');

$dbh = ConnectDB();

function getQuestions($dbh) {
	// fetch the data
	try {
		// set up query
		$question_query = "SELECT * FROM sub_trivia LIMIT 50";
		// prepare to execute (this is a security precaution)
		$stmt = $dbh -> prepare($question_query);
		// run query
		$stmt -> execute();
		// get all the results from database into array of objects
		$questiondata = $stmt -> fetchAll(PDO::FETCH_OBJ);
		// release the statement
		$stmt = null;
		return $questiondata;
	} catch(PDOException $e) {
		die('PDO error in ListAllquestions()": ' . $e -> getMessage());
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>HW2 Page</title>
		<meta charset="utf-8" />
		<meta name="Author" content="Andy Yeung" />
		<meta name="generator" content="pico" />

		<!-- Be sure mobile devices don't try to scale up. -->
		<meta name="viewport" content="width=device-width" />
		<meta name="viewport" content="initial-scale=1.0" />

		<!-- NOTE: Do not put "title" attribute unless there are
		alternate stylesheets! -->
		<link rel="shortcut icon" href="/~yeunga46/images/tardis.png" />
		<script type="text/javascript"
		src="http://code.jquery.com/jquery-1.9.0.min.js"></script>

		<!-- <link rel="stylesheet" type="text/css" href="highscore.css"> -->

		<style>
			table#review {
				width: 90%;
				margin-left: auto;
				margin-right: auto;
				margin-top: 50px;
				margin-bottom: 30px;
				border: 1px solid #000000;
				border-collapse: collapse;
			}

			table#review tr {
				text-align: center;
				margin: 0px;
				padding: 0px;
				border: 1px solid #000000;
			}

			table#review tr td {
				border: 1px solid #000000;
				margin: 0px;
				padding: 0px;
			}
			table#review tr th {
				border: 1px solid #000000;
				margin: 0px;
				padding: 0px;
			}
			th#question {
				width: 45%
			}
			th#answer {
				width: 15%
			}
			th#c1, th#c2, th#c3, th#update {
				width: 10%
			}

		</style>

	</head>

	<body>
		<div id = "container" >
			<form name="update" action="update.php" method="post">
				<table id="review">
					<tbody>
						<tr>
							<th id="question">Question</th><th id="answer">Answer</th><th id ="c1">C1</th><th id = "c2">C2</th><th id = "c3">C3</th><th id="update">Update</th>
						</tr>
						<?php

						$recordlist = getQuestions($dbh);

						$counter = 0;

						foreach ($recordlist as $question) {
							$ques = $question -> question;
							$first = $question -> fake1;
							$second = $question -> fake2;
							$third = $question -> fake3;
							$answer = $question -> correct_answer;
							$qid = $question -> id;
							$counter++;
							echo "<tr>";
							echo "<td>";
							echo $ques;
							echo "</td>";
							echo "<td>";
							echo $answer;
							echo "</td>";
							echo "<td>";
							echo $first;
							echo "</td>";
							echo "<td>";
							echo $second;
							echo "</td>";
							echo "</td>";
							echo "<td>";
							echo $third;
							echo "</td>";
							echo "<td>";
							echo "<input type='radio' name='q" . $counter . "' value='1-" . $qid . "'>Accept<br>";
							echo "<input type='radio' name='q" . $counter . "' value='0-" . $qid . "'>Reject";
							echo "</td>";
							echo "</tr>\n";
						}
						?>
					</tbody>
				</table>
				<input type="hidden" name="count" value="<?php echo $counter ?>" >
				<input type="submit"  value="Update">
			</form>
		</div>
		<footer>
			<div id = "validation">
				<table id="webline">
					<tr>
						<td><a href="../index.html"
						title="Link to Main index page"> <img src="/~yeunga46/images/tardis.png" alt="" /> Main Page </a></td>

						<td style="word-spacing:1em;">Valid: <a href="http://validator.w3.org/check/referer">HTML5</a><a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"> CSS3</a></td>
					</tr>
				</table>
			</div>
		</footer>
	</body>
</html>
