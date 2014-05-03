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

		<div style="display:none; zindex:-1; background:rgba(0,0,0,0.6); height:850px;width:100%;filter:alpha(opacity=60);" id="trans">
			<div style="position: absolute; z-index:-10000; left:44%; top:45%; background-color:#333; width:300;">
				<div style="color:white">
					Scroll through letters with the up and down arrow. Press enter to go to next letter.
				</div>
			</div>
			<div style="display:none;
			z-index:10000;
			position:absolute;
			left:50%;
			top:50%;
			background-color:#333;
			width:300px;
			min-height:100px;
			border:1px solid #666;" id="outer" value= "">
				<div style="position:absolute; border-bottom:3px solid; width:25px; color:white; left:25%; top:25%; font-size:250%;"id="name1">

				</div>
				<div style="position:absolute; border-bottom:3px solid; color:white;
				width:25px; left:50%;font-size:250%;top:25%; "id="name2">

				</div>
				<div style="position:absolute; border-bottom:3px solid; color:white;
				width:25px; left:75%; font-size:250%;top:25%; "id="name3"></div>
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
