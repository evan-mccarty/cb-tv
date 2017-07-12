<?php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://portal2.community-boating.org/pls/apex/CBI_PROD.FLAG_JS");
	$flag_color = curl_exec($ch);
	curl_close($ch);
	//$flag_color = http_get("https://portal2.community-boating.org/pls/apex/CBI_PROD.FLAG_JS");
	echo $flag_color;
?>