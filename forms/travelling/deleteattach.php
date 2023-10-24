<?php
if (isset($_GET['traveldetails_id']) && isset($_GET['tclaims_id'])) {

    $traveldetails_id = $_GET['traveldetails_id'];
    $tclaims_id = $_GET['tclaims_id'];

    $auq = mysqli_query($mysqli,"SELECT * FROM travel_details WHERE tclaims_id=".$tclaims_id." AND traveldetails_id=".$traveldetails_id);
    $aur = mysqli_fetch_array($auq);

    $attachment = $aur["attachment"];

    if (file_exists($attachment) && is_writable($attachment)) {
        if (unlink($attachment)) {
            // echo "File deleted successfully!";
        } 
        else {
            // echo "Error deleting the file.";
        }
    } else {
        // echo "File not found or not deletable.";
    }

    $sql = "UPDATE travel_details SET attachment = '' WHERE tclaims_id = '" . $_GET['tclaims_id'] . "' AND traveldetails_id = '" . $_GET['traveldetails_id'] . "'";
    mysqli_query($mysqli, $sql);

    $goto = "?page=editTravelling&tclaims_id=".$tclaims_id."&traveldetails_id=".$traveldetails_id."";
    $msg = "";
    $func	-> info($msg,$goto);
}

?>