<?php
	if(headers_sent()){
	//	echo "HUGE PROBLEM";
	}
	//echo "flognorp";
	//if(headers_sent()){
	//	echo "flerpaderpderp";
	//}
	//header("Last-Modified: " . gmdate('D, d M Y H:i:s T', 1000));

	//echo"Last-Modified: " . gmdate('D, d M Y H:i:s T', 1000);
	//echo "well derp D:::D:DD:DD:D";
	//echo "well derp D:::D:DD:DD:";

	//exit;
	
	include 'login/dbconf.php';
	include 'restrictions_obj.php';

	$conn = new mysqli($host, $username, $password, $db_name);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $currentDate = NULL;
        $headers = getallheaders();
        if(isset($headers["If-Modified-Since"])){
        	$currentDate = strtotime($headers["If-Modified-Since"]);
        }else{

        }

        //header("Last-Modified: " . gmdate('D, d M Y H:i:s T', 1000));

        $restrictions = getRestrictions($conn);

        $arrlength = count($restrictions);
        $updatetime = NULL;
        for($i = 0; $i < $arrlength; $i++){
        	$restriction = $restrictions[$i];
        	$arrlength_2 = count($restriction);
        	for($i2 = 0; $i2 < $arrlength_2; $i2++){
        		$restricderp = $restriction[$i2];
        		$curtime = strtotime($restricderp["datemodified"]);
        		if(is_null($updatetime) || $curtime > $updatetime)
        			$updatetime = $curtime;
        	}
        }

        $send = true;

        if(is_null($currentDate)){
        	$send = true;
        }else{
        	$send = ($currentDate < $updatetime);
        }

        if($send){
        	header("HTTP/1.1 200");
    	}else{
    		header("HTTP/1.1 304");
    	}
		header('Content-Type: application/json');
		header("Cache-Control:public, max-age=31536000");
		header('Last-Modified: ' . date("r",$updatetime));
		header("Expires: -1");

        //$status_object = array("largestdatemodified"=>$updatetime, "send"=>$send);
        //if(!$send){
        //	$restrictions = array();
    	//}
    	//array_push($restrictions, $status_object);
        $restrictions_json = json_encode($restrictions);

        if($send){
        	echo $restrictions_json;
    	}

?>