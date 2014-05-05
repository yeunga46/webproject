/**
 * quiz.js - displays and runs a trivia quiz
 * @author Andy Yeung and Jason Fiduk
 */
/**
 * Init runs initially on link. Starts the clock,grabs questions, and sets 
 * all global variables up that will be needed
 * later for the high score entry
 */
function init(quiz) {
	var i = 0, tries = 3, correct = 0, currentTime, name;
	nextQuestion();
	runScript();
	
	/**
	 * clickQuit runs only when the quit button is hit.  It clears the screen,
	 * displays the name setter, and then sends the data to the highscore table.
	 */
	function clickQuit() {
		$('#content').hide();
		$('#trans').show();
		$('#outer').show();
		var charcounter = 65;
		var spot = 1;
		var p = $('#name' + spot);

		var blink;
		blink = setInterval(function() {
			p.animate({
				opacity : 0.2
			}, 250, 'linear').animate({
				opacity : 1
			}, 250, 'linear')
		}, 500);
		$(document).keydown(function(e) {
			if (e.keyCode == 38) { //up arrow
				if (charcounter == 122) {
					charcounter = 48
				} else if (charcounter == 90) {
					charcounter = 97;
				} else {
					charcounter++;
				}
				$('#name' + spot).text(String.fromCharCode(charcounter));
			}
			if (e.keyCode == 40) { //down arrow
				if (charcounter == 48) {
					charcounter = 122;
				} else if (charcounter == 97) {
					charcounter = 90;
				} else {
					charcounter--;
				}
				$('#name' + spot).text(String.fromCharCode(charcounter));
			}
			if (e.keyCode == 13) { //enter button
				window.clearInterval(blink);
				charcounter = 65;
				spot++;
				p = $("#name" + spot);
				blink = setInterval(function() {
					p.animate({
						opacity : 0.2
					}, 250, 'linear').animate({
						opacity : 1
					}, 250, 'linear')
				}, 500);
				if (spot > 3) {
					
					name = $('#name1').text() + $('#name2').text() + $('#name3').text();
					storeScore();
				}

				console.log("enter pressed");
			}
		});
		/**
		 * Takes the global variables and sends them to quit.php where it is stored in the highscore
		 * table.  The page is then redirected to the high score page.
		 */
		function storeScore() {
			$.ajax({
				type : "GET",
				dataType : "json",
				url : "quit.php",
				data : {
					name : name,
					time : ((new Date().getTime())-currentTime)/1000,
					correct : correct,
					total : i

				},
				async : false,
				success : function(data) {
					alert(data);
					return true;
				}
			});
			window.location.assign("./highscore.php");

			return $('#name1').text() + $('#name2').text() + $('#name3').text();
		}

	}
	/**
	 * Runs the clock that is displayed in the corner of quiz.  Gets the time the function started
	 * , and then subtracts it from the now current time.  Only up to minutes is displayed. 
	 */
	function runScript() {
		currentTime = new Date().getTime();
		var blink;
		var seconds;
		var minutes;
		blink = setInterval(function() {
			seconds = parseInt(((new Date().getTime() - currentTime) / 1000));
			if (seconds > 59) {
				minutes = seconds / 60;
				$('#clock').text(pad(parseInt(minutes), 2) + ":" + pad(parseInt(seconds % 60), 2));
			} else {
				$('#clock').text(":" + pad(parseInt(((new Date().getTime() - currentTime) / 1000)), 2));
			}

		}, 1000);
		//ends the blink state
	}

	function pad(str, max) {
		str = str.toString();
		return str.length < max ? pad("0" + str, max) : str;
	}

	function contains(elem, arr) {
		if (arr != null) {
			for (var i in arr) {
				if (arr[i] == elem)
					return true;
			}
		}
		return false;
	}

        /**
         * Gets the next question in the quiz array, and then displays the forms and questions for answering them.
         * 
         */
	function nextQuestion() {
		if (i < quiz.length) {
			document.getElementById("questiontext").innerHTML = quiz[i]['question'];
			document.getElementById("qnum").innerHTML = "#" + i;

			//For type in question
			if (quiz[i]['type'] == "SA") {
				$("#fillin").show();
				$("#choice").hide();
			}//For multiple choice question
			if (quiz[i]['type'] == "MC") {
				$("#fillin").hide();
				$("#choice").show();
				var arr = [];
				var x;
				var mc = [];
				for (var a in quiz[i]) {
					mc.push(a);
				}
				document.getElementById('answersBox').innerHTML = '';
				//randomly places the answer choices in the radio buttons.
				for (var j = 0; j < mc.length - 3; j++) {

					do {

						x = Math.floor((Math.random() * (mc.length - 3)) + 1);
					} while(contains(x,arr));
					arr.push(x);

					var c = "c" + x;
					var choiceSelection = document.createElement('input');
					var choiceLabel = document.createElement('label');

					choiceSelection.setAttribute('type', 'radio');
					choiceSelection.setAttribute('name', 'choice');
					choiceSelection.setAttribute('value', quiz[i][c]);

					choiceLabel.innerHTML = quiz[i][c];
					choiceLabel.setAttribute('for', quiz[i][c]);

					document.getElementById('answersBox').appendChild(choiceSelection);
					document.getElementById('answersBox').appendChild(choiceLabel);

				}
			}
		}
	}


	$('#Quit').click(clickQuit);

	$("#skip").click(function(event) {
		i++;
		nextQuestion();
		event.preventDefault();
	});
	//Sends the answer to be checked by quizquestions.php when the submit button is clicked on a fillin question
	//Three chances are given for these.
	$('#fillin').bind('submit', function() {
		var value = $("#response").val();

		$.ajax({
			url : "./quizquestions.php?action=check&id=" + quiz[i]['qid'] + "&response=" + value,
			type : "GET",
			error : function() {
				console.log('err');
			},
			success : function(response) {

				if (response == 1) {
					correct++;
					$("#response").val("");
					i++;
					nextQuestion();

				} else {
					tries--;
					$("span").text("You have " + tries + " attempts left.").show().fadeOut(1000);
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
	//Sends the answer to be checked by quizquestions.php when the submit 
	//button is clicked on a multiple choice question. Only 1 chance for these.
	$('#choice').bind('submit', function() {
		var value = $('input[name="choice"]:checked').val();
		$.ajax({
			url : "./quizquestions.php?action=check&id=" + quiz[i]['qid'] + "&response=" + value,
			type : "GET",
			error : function() {
				console.log('err');
			},
			success : function(response) {

				if (response == 1) {
					correct++;
					$("#response").val("");
					i++;
					nextQuestion();

				} else {
					i++;
					nextQuestion();
				}
			}
		});
		return false;
	});

}
