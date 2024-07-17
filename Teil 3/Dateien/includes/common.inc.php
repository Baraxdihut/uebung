<?php
function te($in) {
	if(TESTMODE>0) {
		echo('<div class="te">');
		if(is_object($in) || is_array($in)) {
			print_r($in);
		}
		else {
			echo($in);
		}
		echo('</div>');
	}
}

function tdie($in) {
	te($in);
	die();
}
?>