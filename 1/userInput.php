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
require_once('../../assets/index.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>[easy] challenge #1</title>
		<meta charset="utf-8">
		<meta name="description" content="programming challenge taken from /r/dailyprogrammer subreddit">
		<meta name="keywords" content="php,html5,forms,inputs">
		<link rel="author" href="https://github.com/kormin">
		<link href="<?=TWBS; ?>" rel="stylesheet" type="text/css">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<div class="row form-group">
						<label for="name" class="control-label col-sm-4">Enter name: </label>
						<div class="col-sm-8">
							<input type="text" id="name" class="form-control" name="name">
						</div>
					</div>
					<div class="row form-group">
						<label for="age" class="control-label col-sm-4">Enter age: </label>
						<div class="col-sm-8">
							<input type="number" id="age" class="form-control" name="age" min="0" max="300">
						</div>
					</div>
					<div class="row form-group">
						<label for="usrname" class="control-label col-sm-4">Enter reddit username: </label>
						<div class="col-sm-8">
							<input type="text" id="usrname" class="form-control" name="usrname">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<input type="submit" id="submit" class="btn btn-default" name="submit" value="Submit">
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<h2 class="text-center">
					<?php
						if(!empty($_POST)) {
							$name = $_POST['name'];
							$age = $_POST['age'];
							$usrname = $_POST['usrname'];
							echo "Your name is ".$name.". You are ".$age." years old. Your username is ".$usrname.".";
						}
					?>
				</h2>
			</div>
		</div>
	</body>
</html>