<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>K+ Quiz</title>
		<meta charset="utf-8" />
		<meta name="Author" content="Andy Yeung" />
		<meta name="generator" content="pico" />

		<!-- Be sure mobile devices don't try to scale up. -->
		<meta name="viewport" content="width=device-width" />
		<meta name="viewport" content="initial-scale=1.0" />

		<!-- NOTE: Do not put "title" attribute unless there are
		alternate stylesheets! -->
		<link rel="stylesheet" type="text/css" href="./quiz.css" />
		<link rel="shortcut icon" href="/~yeunga46/images/tardis.png"/>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="./quiz.js"></script>

		<script type='text/javascript'>
	$(document).ready(function() {
		$.ajax({
			url : "./quizquestions.php?action=getQuiz",
			type : "GET",
			error : function() {
				console.log('err');
			},
			success : function(response) {

				var quiz = JSON.parse(response);

				init(quiz);
			}
		});
	});

</script>

	</head>

	<body>

		 <div  id="trans">
                        <div id="info">
                            Scroll through letters with the up and down arrow. Press enter to go to next letter.
                         </div>
                        <div  id="outer">
                             <div class="letters" id="name1">A</div>
                             <div class="letters" id="name2">A</div>
                             <div class="letters" id="name3">A</div>
                        </div>
                 </div>


		<div id = "content" >
			<table id="navbar">
				<tr>
					<td id="qnum"></td>
					<td id="space">Endurance Quiz</td>
					<td id="clock">:00</td>
				</tr>
			</table>

			<div id ="question">
				<p id="questiontext">
					Turn on Javascript
				</p>
			</div>
			<div id ="answer">
				<form id="fillin" style="display:none" >
					Answer:
					<input type="text" id="response">
					<br>
					<span></span>
					<br>
					<input type = "submit" value="Submit Answer">
				</form>
				<form id="choice" style="display:none" >
					Select:
					<div id="answersBox"></div>
					<input type="submit" value="Submit Choice">
				</form>

				<button id="Quit">
					Quit
				</button>

				<button id="skip">
					Skip
				</button>
			</div>
		</div>

	</body>
	<footer>
		<div id = "validation">
			<table id="webline">
				<tr>
					<td><a href="http://elvis.rowan.edu/~yeunga46/web/"
					title="Link to web directory"> <img src="/~yeunga46/images/tardis.png" alt="" /> A. Yeung </a></td>
					<td style="word-spacing:1em;">Valid: <a href="http://validator.w3.org/check/referer">HTML5</a><a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"> CSS3</a></td>
				</tr>
			</table>
		</div>
	</footer>
</html>
