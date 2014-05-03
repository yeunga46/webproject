/**
 * quiz.js - diplays and runs a trivia quiz 
 * @author Andy
 */

function init(quiz) {
	var i = 0, tries = 3, correct = 0;
	nextQuestion();
	function contains(elem, arr) {
		if (arr != null) {
			for (var i in arr) {
				if (arr[i] == elem)
					return true;
			}
		}
		return false;
	}

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
				var arr = [];
				var x;
				var mc = [];
				for (var a in quiz[i]) {
					mc.push(a);
				}
				document.getElementById('answersBox').innerHTML = '';
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


	$("#skip").click(function(event) {
		i++;
		nextQuestion();
		event.preventDefault();
	});

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
					nextQuestion();
				}
			}
		});
		return false;
	});
}
