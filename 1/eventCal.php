<?php
/*
 * Author: https://github.com/kormin
 * Date Created: April 26, 2016
 * Description: This is the answer to the programming challenge #1 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [intermediate] challenge #1
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pihtx/intermediate_challenge_1/
 * Resources: 
 * http://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059
 * http://code.tutsplus.com/tutorials/php-database-access-are-you-doing-it-correctly--net-25338
 * 
 */
require_once('../../assets/index.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>[intermediate] challenge #1</title>

		<meta name="description" content="programming challenge taken from /r/dailyprogrammer subreddit">
		<meta name="keywords" content="php,html5,forms,inputs">
		<link rel="author" href="https://github.com/kormin">
		<link href="<?=TWBS; ?>" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<form class="form-horizontal" method="get">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="options" value="add" id="add" autocomplete="off"> Add Event
						</label>
						<label class="btn btn-default">
							<input type="radio" name="options" value="view" id="view" autocomplete="off"> View Events
						</label>
						<label class="btn btn-default">
							<input type="radio" name="options" value="edit" id="edit" autocomplete="off"> Edit Event
						</label>
						<label class="btn btn-default">
							<input type="radio" name="options" value="delete" id="delete" autocomplete="off"> Delete Event
						</label>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			
		</script>
	</body>
</html>