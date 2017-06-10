<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    table{
        padding-top: 0px;
    }
    td{
        vertical-align: top;
        background-color: #d3dded;
    }
    .restrictions table{
        width: 100%;
        margin: auto;
    }
    .button-enabled{
        color: white;
    }
    .button-disabled{
        color: red;
    }
    .restrictions-custom{
        display: block;
    }
    .unmarked{

    }
    .marked{
    	color: orange;
    }
    </style>
    <meta charset="utf-8">
    <title>Restrictions Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" media="screen">
     <script src="flags.js" type="text/javascript"></script>
</head>
<body>
    <div id="header">
        <h1>Restrictions Control Panel</h1>
        <div id="logout">
            <a href="login/logout.php"><button style="width: 5vw;">Logout</button></a>
        </div>
    </div>
    <div id="program">
        <h3>Change Program</h3>
        <p>
            <input type="radio" name="program" value="ap" /> Adult Program
            <input type="radio" name="program" value="jp" /> Junior Program
        </p>
    </div>
    <div id="flag">
        <h3>Flag</h3>
        <img class="flag_img img_normalval"></img>
    <script>
        const CLASS_CUSTOM = "CUSTOM";
        const CLASS_STANDARD = "STANDARD";
        var restrictions = [];
        var customrestrictions = [];
        var initiateRestrictions = function(){
            var buttons = document.getElementsByClassName("restriction");
            for(var i = 0; i < buttons.length; i++){
                var button = buttons[i];
                var id = parseInt(button.dataset.restrictionId, 10);
                var clazz = button.dataset.restrictionClass;
                var enabled = (button.dataset.restrictionEnabled == "1");
                var restriction = {id:id, class:clazz, enabled:enabled, button:button};
                if(isCustom(restriction)){
                    var textarea = document.getElementById('textarea_restriction_' + restriction.id);
                    restriction.textarea = textarea;
                }
                (function(res){
                    button.addEventListener("click", function(){
                        handleButtonClick(res);
                    });
                })(restriction);
                updateButton(restriction);
                if(isCustom(restriction)){
                    customrestrictions[customrestrictions.length] = restriction;
                }
                restrictions[restrictions.length] = restriction;
            }
        }
        var submitRestrictions = function(){
            var restrictionstext = "";
            var customrestrictionstext = "";
            for(var i = 0; i < restrictions.length; i++){
                var restriction = restrictions[i];
                restrictionstext += restriction.id;
                restrictionstext += ":";
                restrictionstext += restriction.enabled;
                if(i + 1 < restrictions.length)
                    restrictionstext += ",";
                if(isCustom(restriction)){
                    restriction.custom_text = restriction.textarea.value;
                    //alert(restriction.textarea.value);
                }
            }
            customrestrictionstext = JSON.stringify(customrestrictions);
            var restrictionsdata = document.getElementById('restrictionsdata');
            var restrictioninput = document.getElementById('restrictionstext');
            var restrictioncustom = document.getElementById('restrictionscustom');
            restrictioninput.value = restrictionstext;
            restrictionscustom.value = customrestrictionstext;
            restrictionsdata.submit();
        }
        var clearRestrictions = function(){
        	for(var i = 0; i < restrictions.length; i++){
        		var restriction = restrictions[i];
        		restriction.enabled = false;
        		updateButton(restriction);
        	}
        	markChange();
        }
;        window.addEventListener("load", function(){
            initiateRestrictions();
        });
        var isCustom = function(restriction){
            return restriction.class == CLASS_CUSTOM;
        }
        var isStandard = function(restriction){
            return restriction.class == CLASS_STANDARD;
        }
        var markChange = function(){
        	var submitThings = document.getElementsByClassName("submit_button");
        	for(var i = 0; i < submitThings.length; i++){
        		var submitThing = submitThings[i];
        		submitThing.className = "submit marked";
        	}
        }
        var handleButtonClick = function(restriction){
            restriction.enabled = !restriction.enabled;
            updateButton(restriction);
            markChange();
        }
        var updateButton = function(restriction){
            if(restriction.enabled){
                restriction.button.className = "restriction button-enabled";
            }else{
                restriction.button.className = "restriction button-disabled";
            }
        }
    </script>
    </div>
    <div class="container">
        <form id="restrictionsdata" method="POST">
            <input id="restrictionstext" name="restrictionsdata" type="hidden" value="">
            <input id="restrictionscustom" name="restrictionscustom" type="hidden" value="">
        </form>
        <div class="restrictions">
            <?php

            include 'login/dbconf.php';
            include 'restrictions_obj.php';
             
            #$servername="localhost";
            #$username="id1301312_cbi";
            #$password="cbistaff";
            #$dbname="

            $conn = new mysqli($host, $username, $password, $db_name);

            if($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $restrictions_custom = json_decode($_POST['restrictionscustom']);
                //echo $restrictions_custom[0]->custom_text;
                $restrictions_data = $_POST['restrictionsdata'];
                $restriction_values = explode(',', $restrictions_data);
                $arrlength = count($restriction_values);
                $toEnable = array();
                $toDisable = array();
                for($i = 0; $i < $arrlength; $i++){
                    $restriction_value = $restriction_values[$i];
                    $vals = explode(':', $restriction_value);
                    $id = $vals[0];
                    $enabled = $vals[1];
                    if($enabled === "true"){
                        array_push($toEnable, $id);
                    }else{
                        array_push($toDisable, $id);
                    }
                }
                setEnabledState($conn, $toEnable, "1");
                setEnabledState($conn, $toDisable, "0");

                $arrlength = count($restrictions_custom);

                for($i = 0; $i < $arrlength; $i++){
                    $custom = $restrictions_custom[$i];
                    $newtext = htmlspecialchars($custom->custom_text);
                    echo $newtext . ":" . $custom->id;
                    $id = $custom->id;
                    $sql = "UPDATE restrictions SET display_text=\"" .
                    $newtext . "\" WHERE id=" .
                    $id . ";";
                    $conn->query($sql);
                }
            }

            $restrictions = getRestrictions($conn);

            $conn->close();

            echo "good connection" . count($restrictions[3]);

            $arrlength = count($restrictions);

            echo "<table><tr>";

            $cols = 3;

            $button_cols = 2;

            for($i = 0; $i < $arrlength; $i++){
                if(isStartLine($i, $cols)){
                    echo "<tr>";
                }
                $sub_restrictions = $restrictions[$i];
                $arrlength_2 = count($sub_restrictions);
                #echo "<td>" . $sub_restrictions[0]["title"] . "</td>";
                echo "<td>";
                echo "<h3>" . $sub_restrictions[0]["title"] . "</h3>";
                echo "<table>";
                //echo "<tr>";
                for($i2 = 0; $i2 < $arrlength_2; $i2++){
                    if(isStartLine($i2, $button_cols)){
                        echo "<tr>";
                    }
                    $current_restriction = $sub_restrictions[$i2];
                    echo "<td>";
                    echo "<button class=\"restriction\" " . 
                        "data-restriction-enabled=\"" . $current_restriction["enabled"] . "\" " .
                            "data-restriction-id=\"" . $current_restriction["id"] . "\" " . 
                            "data-restriction-class=\"" . $current_restriction["class"] . "\">";
                    echo $current_restriction["button_text"];
                    echo "</button>";
                    if($current_restriction["class"] === "CUSTOM"){
                        echo "<textarea id=\"textarea_restriction_" . $current_restriction["id"] .
                         "\" class=\"restrictions-custom\" rows=\"4\" cols=\"50\">" .
                         $current_restriction["display_text"] . "</textarea>";
                    }
                    echo "</td>";
                    if(isEndLine($i2, $button_cols, $arrlength_2)){
                        echo "</tr>";
                    }
                }
                echo "</tr></table></td>";
                if(isEndLine($i, $cols, $arrlength)){
                    echo "</tr>";
                }
            }
            echo "</tr></table>";
            echo "good connection";

            function isStartLine(&$value, &$cols){
                return ($value) % $cols === 0 && ($value) !== 0;
            }
            function isEndLine(&$value, &$cols, &$size){
                return ($value + 1) % $cols === 0 && ($value + 1) !== $size;
            }

            ?>
        </div>
  
        <div id="controls">
            <button class = "submit_button unmarked" type="submit" onclick="submitRestrictions()" style="width: 7vw;">Submit</button>
            <button type="clear" onclick="clearRestrictions()" style="width: 7vw;">Clear</button>
        </div>
    </div>
</div> <!-- /container -->
</body>
</html>