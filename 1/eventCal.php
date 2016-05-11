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

require_once('editCal.php');


$db = dbConf();

function toStr($arr) {
	foreach ($arr as $i => $v) {
		
	}
}

if(!empty($_GET)) {
	$opt = $_GET['submit'];
	$id = 0;
	$val = '';
	$cols = '';
	$colVal = '';
	$cond = '';
	$len = count($_GET) - 3; // submit button must be last in array
	// echo "$cols<br>$val";
	if($opt == 'submit'){
		echo "You cannot submit without choosing an option.";
	}else if($opt == 'add') {
		foreach ($_GET as $i => $v) { // get column names and values and store in string
			if ($i != 'submit' && $i != 'post_id') {
				if ($i == 'event') {
					$val .= '"'.$v.'"';
				}else{
					$val .= $v;
				}
				$cols .= "`$i`";
				if ($id < $len) {
					$cols .= ",";
					$val .= ",";
				}
				$id++;
			}
		}
		add($db, $cols, $val);
	}else if($opt == 'edit') {
		foreach ($_GET as $i => $v) {
			if ($i != 'submit' && $i != 'post_id') {
				if ($i == 'event') {
					$colVal .= "`$i` = '$v'";
				}else{
					$colVal .= "`$i` = $v";
				}
				if ($id < $len) {
					$colVal .= ",";
				}
				$id++;
			}
		}
		$cond = 'id = '.$_GET['post_id'];
		try {
			$db->update($colVal, $cond);
		} catch (PDOException $e) {
			echo $e->getMessage();
			echo "<br>Database error occurred. Cannot update the entry. Please try again.";
		}
	}else if($opt == 'delete') {
		$cond = 'id = '.$_GET['post_id'];
		try {
			$db->delete($cond);
		} catch (PDOException $e) {
			echo $e->getMessage();
			echo "<br>Database error occurred. Cannot delete the entry. Please try again.";
		}
	}else {
		echo "Invalid action";
	}
}
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

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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
			<div id="view-event" class="hide row">
				<h2>Events Calendar</h2>
				<?php 
					$srchArr = srch($db);
					$i = 0;
					$xd = array(); // array of id from db
					// print_r($srchArr);
					
				?>
				<table class="table table-responsive table-striped table-hover" id="dbTable">
					<thead class="thead-inverse">
						<tr>
							<th>#</th>
							<th>Month</th>
							<th>Day</th>
							<th>Year</th>
							<th>Event</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($srchArr as $i1 => $v1): ++$i; $fl=0;
						foreach ($v1 as $i2 => $v2): 
							if($i2 == 'id'): $xd[$i-1] = $v2; 

						?>
						<tr id="trow-<?php echo $v2; ?>" style="cursor: pointer;">
							<?php endif; if ($fl==0): ?>
							<th scope="row" class="cntr"><?php echo $i; ?></th>
							<?php $fl=1; endif; if($i2 == 'month'): ?>
							<td class="month"><?php echo monthConv($v2); ?></td>
							<?php endif; if($i2 == 'day'): ?>
							<td class="day"><?php echo $v2; ?></td>
							<?php endif; if($i2 == 'year'): ?>
							<td class="year"><?php echo $v2; ?></td>
							<?php endif; if ($i2 == 'event'): ?>
							<td class="event"><?php echo $v2; ?></a></td>
							<?php endif; endforeach; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<!-- 
				<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1">
						<?php echo ++$i; ?>
					</div>
					<?php foreach ($v1 as $i2 => $v2): if($i2 == 'month'): ?>
					<div class="col-xs-2">
						<?php echo monthConv($v2); ?>
					</div>
					<?php endif; if($i2 == 'day'): ?>
					<div class="col-xs-1">
						<?php echo $v2; ?>
					</div>
					<?php endif; if($i2 == 'year'): ?>
					<div class="col-xs-2">
						<?php echo $v2; ?>
					</div>
					<?php endif; if ($i2 == 'event'): ?>
					<div class="col-xs-6">
						<?php echo $v2; ?>
					</div>
					<?php endif; endforeach; ?>
				</div>	
				</div> -->
			</div>
		</div>
		<?php 
			print_r($_GET);
		?>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?=JQRY; ?>" type="text/javascript"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- <script src="<?=TWBS_JS; ?>"></script> -->
		<script type="text/javascript">
			// variables
			var btnTxt = ['add','view','edit','delete'];
			var inpTxt = ['month','day','year','event'];
			var evnTxt = ['#edit-event','#view-event'];
			var len = btnTxt.length;
			var btnJq = [], inpJq = [], trow = [];
			var edit = $('#edit-event');
			var view = $('#view-event');
			var submt = $('#submit');
			var post_id = $('#post_id');
			var xd = <?php echo json_encode($xd) ?>; // get php array and store here
			// window.onload = function () {alert('Jquery loaded');};
			$(document).ready(main());
			function main() {
				for(var i=0;i<len;i++) {
					btnJq[i] = $('#'+btnTxt[i]);
					inpJq[i] = $('#'+inpTxt[i]);
					btnJq[i].click( { p1: btnJq[i] }, disPrp );
				}
				for(var i=0; i < xd.length ; i++) {
					var txt = 'trow-'+xd[i];
					trow[i] = $('#'+txt);
					trow[i].click( { p1: xd[i] }, getTbCell);
					// trow[i].each(function(){
					// 	alert($(this).html());
					// });
				}
			}
			function getTbCell(e) { // gets data by id for display
				var row = document.getElementById(this.id);
				var arr = [];
				for (var i = 1, l = row.cells.length; i < l; i++) { // i is 1 to drop the # column
					arr[i-1] = row.cells[i].innerHTML;
					if(i-1 == 0) {
						arr[i-1] = monthConv(arr[i-1]);
					}
					inpJq[i-1].val(arr[i-1]);
				}
				post_id.val(e.data.p1);
				pckEvnt();
			}
			function pckEvnt() {
				var prmp;
				while(prmp!='e' && prmp!='d') {
					prmp = prompt("Enter [e] for edit or [d] for delete: ");
					prmp = prmp.toLowerCase();
				}
				if(prmp == 'e') {
					btnJq[2].click();  // edit button is clicked
				}else{
					btnJq[3].click();  // delete button is clicked
				}
			}
			function disPrp(e) { // displays prop
				e.data.p1.prop('disabled', true);
				submt.prop('value', this.id);
				if(e.data.p1!=btnJq[1]) { // checks if button != view button
					// edit.css('cssText', 'display: block !important;');
					edit.removeClass('hide');
					edit.addClass('show');
					view.removeClass('show');
					view.addClass('hide');
				}else{ // displays #view-event if button click == #view
					edit.removeClass('show');
					edit.addClass('hide');
					view.removeClass('hide');
					view.addClass('show');
				}
				for(var i=0;i<len;i++) {
					if (e.data.p1!=btnJq[i]) {
						btnJq[i].prop('disabled', false);
						btnJq[i].removeClass('btn-primary');
					}else{
						btnJq[i].addClass('btn-primary');
					}
					if(e.data.p1==btnJq[3]) { // checks if button == delete button
						inpJq[i].prop('disabled', true);
					}else{
						inpJq[i].prop('disabled', false);
					}
				}
			}
			function monthConv(val) {
				var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
				for(var i=0,len=month.length; i<len; i++) {
					var res = month[i].localeCompare(val);
					if(res == 0) {
						return i+1;
					}
				}
			}
			function sendPHP (val) {
				$.ajax({
					// type: "GET",
					data: { val : val },
					success: function( result ) {
						// alert(val);
					}
				});
			}
			// function callPHP(phpFileLoc, fx, args) {
			// 	jQuery.ajax(
			// 		type: "POST",
			// 		url: phpFileLoc,
			// 		dataType: 'json',
			// 		data: { action: fx, arguments: }
			// 	);
			// }
		</script>
	</body>
</html>