<?php
/*
 * Author: https://github.com/kormin
 * Date Created: May 11, 2016
 * Description: This is the answer to the programming challenge #4 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [easy] challenge #4
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pm6oj/2122012_challenge_4_easy/
 * Resources:
 *
 */

require_once('../../assets/index.php');

function randPass($leng) {
	$asc = "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~"; // missing whitespace character
	$pass = '';
	$ascLen = strlen($asc);
	for($i=0;$i<$leng;$i++) {
		$rnd = rand(0, $ascLen-1);
		$pass .= $asc[$rnd];
		while(repeat($pass, $leng)) {
			$rnd = rand(0, $ascLen-1);
			$pass .= $asc[$rnd];
		}
		// echo $pass[$i].'<br>';
	}
	return $pass;
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>[easy] challenge #4</title>

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
			<form class="form-horizontal" method="get">
				<div class="row form-group">
					<label for="num" class="control-label col-xs-5 col-md-3">Number of passwords: </label>
					<div class="col-xs-7 col-md-9">
						<input type="number" class="form-control" min="1" id="num" name="num">
					</div>
				</div>
				<div class="row form-group">
					<label for="leng" class="col-xs-5 col-md-3 control-label">Length of passwords: </label>
					<div class="col-xs-7 col-md-9">
						<input type="number" class="form-control" min="1" id="leng" name="leng"></input>
					</div>
				</div>
				<div class="row form-group col-xs-2" style="float: right;">
					<button type="submit" id="submit" class="btn bnt-default btn-block" name="submit" value="submit">Submit</button>
				</div>
			</form>
			<div class="row" id="passList">
				<?php 
					if(!empty($_GET)): 
						$num = $_GET['num'];
						$leng = $_GET['leng'];
					for ($i=0; $i < $num; $i++):  
						$pass = randPass($leng);
				?>
				<h4 class="col-xs-6" id="pass-<?php echo $i; ?>"><?php echo htmlspecialchars($pass); ?></h4>
				<?php endfor; endif; ?>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?=JQRY; ?>" type="text/javascript"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- <script src="<?=TWBS_JS; ?>"></script> -->
		<script type="text/javascript">
			var num = <?php echo $_GET['num']; ?>;;
			// window.onload = function () {alert('Jquery loaded');};
			$(document).ready(main());
			function main() {
				// $('#submit').click(function(){
				// 	num = $('#num').val();
				// });
				for(var i=0;i<num;i++) {
					$('#pass-'+i).click(function(){
						$(this).selectText();
					});
				}
			}

			// http://stackoverflow.com/questions/985272/selecting-text-in-an-element-akin-to-highlighting-with-your-mouse
			jQuery.fn.selectText = function(){
				var doc = document, element = this[0], range, selection;
				if (doc.body.createTextRange) {
					range = document.body.createTextRange();
					range.moveToElementText(element);
					range.select();
				} else if (window.getSelection) {
					selection = window.getSelection();        
					range = document.createRange();
					range.selectNodeContents(element);
					selection.removeAllRanges();
					selection.addRange(range);
				}
			};
		</script>
	</body>
</html>