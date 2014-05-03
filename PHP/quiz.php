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
		<!-- <link rel="stylesheet" type="text/css" href="./layout700+.css" />
		<link rel="stylesheet" type="text/css" href="./layout699-.css" /> -->
		<link rel="shortcut icon" href="/~yeunga46/images/tardis.png" />
		<!-- <link rel="stylesheet" href="webline.css" /> -->
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

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
						var next = true;
						var i = 0, tries = 3, correct = 0;

						nextQuestion();

						function nextQuestion() {
							if (i < quiz.length) {
								document.getElementById("questiontext").innerHTML = quiz[i]['question'];
								document.getElementById("qnum").innerHTML = "#" + i;
								document.getElementById("clock").innerHTML = i;

								if (quiz[i]['type'] == "SA") {
									$("#fillin").show();
									$("#choice").hide();
								}
								if (quiz[i]['type'] == "MC") {
									$("#fillin").hide();
									$("#choice").show();
								}
							}
						}


						$("#skip").click(function(event) {
							i++;
							nextQuestion();
							event.preventDefault();
						});

						$('#fillin').bind('submit', function() {
							var value = $("#response").val();
							console.log(i);
							console.log(value);
							console.log(quiz[i]['qid']);
							$.ajax({
								url : "./quizquestions.php?action=check&id=" + quiz[i]['qid'] + "&response=" + value,
								type : "GET",
								error : function() {
									console.log('err');
								},
								success : function(response) {
									console.log(response);
									var val = response;
									if (response == 1) {
										correct++;
										console.log(correct);
										$("#response").val("");
										i++;
										nextQuestion();

									} else {
										tries--;
										$( "span" ).text( "You have "+ tries +" attempts left."  ).show().fadeOut( 1000 );
										if (tries <= 0) {
											tries = 3;
											i++;
											nextQuestion();
										}
									}
								}
							});
							return false;
						});

					}
				});
			});

		</script>

		<style type="text/css">
			h1 {
				text-align: center;
			}
			#content {
				width: 70%;
				height: 600px;
				margin-left: auto;
				margin-right: auto;
				padding: 0 0 0 0;
				vertical-align: middle;
				border: 2px solid #000000;
			}
			#question {
				width: 70%;
				height: 50%;
				padding-top: 25px;
				margin-left: auto;
				margin-right: auto;
				vertical-align: middle;
				border: 2px solid #000000;
			}
			#answer {
				width: 70%;
				height: 25%;
				margin-top: 10px;
				margin-left: auto;
				margin-right: auto;
				vertical-align: middle;
				border: 2px solid #000000;
			}
			#content ul li {
				list-style-type: none;
				text-align: center;
			}
			#content h1 {
				text-align: center;
			}
			table#navbar {
				width: 100%;
				height: 10%;
				padding: 0 0 0 0;
				color: #F8F8FF;
				background: #1E90FF;
				border: 1px solid #000000;
				border-collapse: collapse;
				margin-bottom: 25px;
			}

			table#navbar tr {
				text-align: center;
				margin: 0px;
				padding: 0px;
				border: 1px solid #000000;
			}

			table#navbar tr td {
				border: 1px solid #000000;
				margin: 0px;
				padding: 0px;
			}

			table#navbar tr td a {
				text-decoration: none;
				margin: 0px;
				padding: 0px;
			}

			table#navbar tr td a:hover {
				text-decoration: underline;
			}

			table#webline {
				width: 100%;
				color: #3f1a0a;
				background: #dfdbc3;
				border: 1px solid #3f1a0a;
				border-collapse: collapse;
			}

			table#webline tr {
				text-align: center;
				margin: 0px;
				padding: 0px;
				border: 1px solid #3f1a0a;
			}

			table#webline tr td {
				border: 1px solid #3f1a0a;
				margin: 0px;
				padding: 0px;
			}

			table#webline tr td a {
				text-decoration: none;
				margin: 0px;
				padding: 0px;
			}

			table#webline tr td a:hover {
				text-decoration: underline;
			}

			table#webline tr td img {
				vertical-align: middle;
				border: none;
				margin: 0px;
				padding: 0px;
			}
			span {
				color: red;
			}
		</style>
	</head>

	<body>

		<h1>High-Score</h1>

		<div id = "content" >
			<table id="navbar">
				<tr>
					<td id="qnum"></td>
					<td id"space"></td>
					<td id="clock"></td>
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
					<input type = "submit" name="answerSA" value="Submit Answer">
				</form>
				<form id="choice" style="display:none" >
					Answer:
					<br>
					<input type="radio" id="a" name="choose" value="a">
					a
					<br>
					<input type="radio" id="b" name="choose" value="b">
					b
					<br>
					<input type="radio" id="c" name="choose" value="c">
					c
					<br>
					<input type="radio" id="d" name="choose" value="d">
					d
					<br>
					<input type="submit" onclick="">
				</form>
				<span></span>
				<button id="skip">
					Skip
				</button>
				<button type="button" onclick="alert('Quit')">
					Quit
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
