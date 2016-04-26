<?php
/*
 * Author: https://github.com/kormin
 * Date Created: April 26, 2016
 * Description: This is the answer to the programming challenge #1 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [easy] challenge #1
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pih8x/easy_challenge_1/
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>[easy] challenge #1</title>
		<meta charset="utf-8">
		<meta name="description" content="programming challenge taken from /r/dailyprogrammer subreddit">
		<meta name="keywords" content="php,html5,forms,inputs">
		<link rel="author" href="https://github.com/kormin">
		<!-- <link rel=canonical href=""> -->

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			Enter name: <input type="text" name="name"> <br> <br>
			Enter age: <input type="number" name="age" min="0" max="300"> <br> <br>
			Enter reddit username: <input type="text" name="usrname"> <br> <br>
			<input type="submit" value="Submit">
		</form>
		<br>
		<h2>
			<?php
				if(!empty($_POST)) {
					$name = $_POST['name'];
					$age = $_POST['age'];
					$usrname = $_POST['usrname'];
					echo "your name is ".$name.", you are ".$age." years old, and your username is ".$usrname;
				}
			?>
		</h2>
	</body>
</html>