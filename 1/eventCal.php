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
					<div class="form-group">
						<button type="button" class="btn btn-default" id="add" name="options" value="add" >Add Event</button>
						<button type="button" class="btn btn-default" id="view" name="options" value="view">View Events</button>
						<button type="button" class="btn btn-default" id="edit" name="options" value="edit" >Edit Event</button>
						<button type="button" class="btn btn-default" id="delete" name="options" value="delete" >Delete Event</button>
					<!-- 
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
						</label> -->
					</div>
					<div id="edit-event" class="">
						<div class="form-group">
							<input type="number" min="0" id="post_id" name="post_id" hidden></input>
							<label for="month" class="col-sm-2 control-label" >Enter date: </label>
							<div class="col-sm-4">
								<select class="form-control" id="month" name="month">
									<option selected disabled hidden>Month</option>
									<?php
										$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
										foreach ($month as $i => $val) :
											$tp = $i + 1;
									?>
									<option value='<?php echo $tp; ?>'><?php echo $val; ?></option>;
										<?php endforeach; ?>
								</select>
							</div>
							<div class="col-sm-2 col-md-2">
								<input type="number" min="1" max="31" class="form-control" placeholder="Date" id="day" name="day">
							</div>
							<div class="col-sm-4 col-md-4">
								<input type="number" min="0" class="form-control" placeholder="Year" id="year" name="year">
							</div>
						</div>
						<div class="form-group">
							<label for="event" class="col-sm-2 control-label">Enter event: </label>
							<div class="col-sm-10">
								<textarea type="text" class="form-control" id="event" rows="3" name="event"></textarea>
							</div>
						</div>
						<div class="form-group col-sm-2" style="float: right;">
							<button type="submit" id="submit" class="btn bnt-default btn-block" name="submit" value="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			
		</script>
	</body>
</html>