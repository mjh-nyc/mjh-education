<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Quiz : New York's Holocaust Curriculum</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script>
  	var $legacyURL = "/legacy/geography/quiz_page.php";
  </script>
  <script src="quiz.js"></script>
  <link rel="stylesheet" href="quiz.css">
</head>

<body style="background-color: #FFFFFF">

	<div id="content" style="margin: 0 auto; width: 650px">
		<?php
			if (!empty($_GET['name']) && !empty($_GET['question'])) {
				if ($_GET['question'] == 'done') {
					//quiz is done
					$theQuizFile = "quizzes/".$_GET['name']."_complete.php";
				} else {
					$theQuizFile = "quizzes/".$_GET['name']."_".$_GET['question'].".php";
				}	
				echo "<header>";
				echo "<h2>Geography</h2>";
				//echo "<div class='close'><a href='closeWin();'>Close</a></div>";
				echo "</header>";
				include($theQuizFile);
			} else {
				echo "Sorry, this is a wrong query.";
			}		
		?>

	</div>

</body>
</html>