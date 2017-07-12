<?php
class restriction{
	
}
class restriction_type{

}
function getRestrictions(&$conn){

    $sql = "SELECT * FROM restrictions_type JOIN restrictions ON restrictions.restrictions_type_id=restrictions_type.id ORDER BY restrictions_type.position, restrictions.position";

	$result=$conn->query($sql);

    //$restrictions_type = array();
    $restrictions = array();

    if($result->num_rows > 0){
        $last_id = -1;
        //$first = true;
        $c_restriction = array();
        while($row = $result->fetch_assoc()){
            $c_id = $row["restrictions_type_id"];
            //echo count($c_restriction);
            if($last_id !== -1 && $c_id !== $last_id){
                $last_id = $c_id;
                array_push($restrictions, $c_restriction);
                $c_restriction = array();
            }
            if($last_id === -1){
                $last_id = $c_id;
            }
            array_push($c_restriction, $row);
            //echo "<td>" . $row["button_text"] . "</td>";
            #echo $c_id;
            #echo "<p>" . $row["title"] . $row["button_text"] . "</p>";
        }

        array_push($restrictions, $c_restriction);

        //echo "</tr>";

    }
    return $restrictions;
}
function setEnabledState($conn, $idSet, $value){
    $valueText = "";
    $arrlength = count($idSet);
    for($i = 0; $i < $arrlength; $i++){
        $idl = $idSet[$i];
        $valueText = $valueText . $idl;
        if(($i + 1) < $arrlength){
            $valueText = $valueText . ",";
        }
    }
    $sql = "UPDATE restrictions SET enabled=" . $value . ",datemodified=NOW() WHERE id IN (" . $valueText . ")";
    if ($conn->query($sql) === TRUE) {
    //    echo "Record updated successfully";
    } else {
    //    echo "Error updating record: " . $conn->error;
    }
}
?>