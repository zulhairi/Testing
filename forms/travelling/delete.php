<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
    // $sql = "DELETE FROM travel_approval WHERE approval_id = " . $id;
    // mysqli_query($mysqli, $sql);
    // header("Location: ?page=travelsummary");
    $goto = "?page=travelsummary";
    $msg = "<img src='images/loading.gif' />";
    $func	-> info($msg,$goto);
} else {

}



?>