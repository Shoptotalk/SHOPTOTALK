<?php

function fact($num) {
	if($num < 2) return 1;
	else {
		return ($num * fact($num - 1)); 
	}
}

echo fact(4);

?>