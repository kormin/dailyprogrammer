<?php
/*
 * Author: https://github.com/kormin
 * Date Created: May 10, 2016
 * Description: This is the answer to the programming challenge #2 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [difficult] challenge #2
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pjsdx/difficult_challenge_2/
 * Resources: 
 * https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Date
 * https://developer.mozilla.org/en-US/Add-ons/Code_snippets/Timers
 * http://stackoverflow.com/questions/20318822/how-to-create-a-stopwatch-using-javascript
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
		<title>[difficult] challenge #2</title>

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
				<button type="button" class="btn btn-default" id="timer" >Start</button>
				<button type="button" class="btn btn-default" id="split">Split</button>
				<button type="button" class="btn btn-default" id="reset">Reset</button>
			</div>
			<div id="" class="row" style="font-size: 100px;">
				<p id="time">00:00</p>
			</div>
			<div id="laps" class="row"></div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?=JQRY; ?>" type="text/javascript"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- <script src="<?=TWBS_JS; ?>"></script> -->
		<script type="text/javascript">
			// variables
			var btnId = ['timer','split','reset'];
			var btn = [];
			var btnLen = btnId.length;
			var disp = $('#time');

			var start, curr, diff, time=0, res, intr, id=0, x=0;
			var laps = [];
			// window.onload = function () {alert('Jquery loaded');};
			$(document).ready(main());
			function main() {
				for(var i=0;i<btnLen;i++) {
					btn[i] = $('#'+btnId[i]);
					btn[i].click({p1:btnId[i]},setBtn);
				}
			}
			function setBtn(e) {
				switch(e.data.p1) {
					case btnId[0]: timer($(this));
						break;
					case btnId[1]: lap();
						break;
					case btnId[2]: clr();
						break;
					default: break;
				}
			}
			function timer(e) {
				if(e.text() == 'Start') { // start state is true
					e.text('Stop');
					start = Date.now(); // Returns the numeric value corresponding to the current time - the number of milliseconds elapsed since 1 January 1970 00:00:00 UTC.
					intr = setInterval(runTime, 1); // Calls a function repeatedly, with a fixed time delay between each call to that function.
				}else{
					e.text('Start');
					clearInterval(intr); // clears delay set by timeout
				}
			}
			function runTime() {
				curr = Date.now();
				diff = curr - start;
				start = curr;
				time += diff;
				res = time / 1000;
				disp.text(res.toString()+' sec');
			}
			function clr() {
				// start = curr = diff = 0; // will require stop
				time = res = x = 0; // does not require stop
				disp.text('00:00');
			}
			function lap() {
				laps[id] = res.toString();
				$('<h4></h4>', {
				text: 'Lap #'+(++x)+': '+laps[id]+' sec'}).appendTo('#laps');
				++id;
			}
		</script>
	</body>
</html>