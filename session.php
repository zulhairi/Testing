<?php

ini_set("session.cookie_httponly", 1);
session_start();
$sid = session_id();

$result = mysqli_query($mysqli, "SELECT ses_name,ses_cat,ses_staffno,ses_time FROM intra_session WHERE ses_code='" . $sid . "'");
if (!$result || mysqli_num_rows($result) < 1) {
    $ses_name = "";
    $ses_stat = 0;
    $ses_cat = 0;
    $ses_time = 0;
} else {
    $row = mysqli_fetch_array($result);
    $ses_stat = 1;
    $ses_name = $row["ses_name"];
    $ses_cat = $row["ses_cat"];
    $ses_staffno = $row["ses_staffno"];
    $ses_time = $row["ses_time"];
}
if ($ses_time != 0) {
    $time_a = time();
    $time_b = $ses_time;
    $time_c = $time_a - $time_b;
    if ($time_c >= 82800) {
        session_destroy();
        mysqli_query($mysqli, "DELETE FROM intra_session WHERE ses_code='" . $sid . "'");
        $goto = "?";
        $msg = "";
        print "<script>alert('Session Expired!');</script>";
        $func->info($msg, $goto);
    }
}
if ($ses_staffno == "") {
    $goto = "/?";
    $msg = "";
    $func->info($msg, $goto);
}
mysqli_free_result($result);

// register new session
if ($ses_stat != 1) { 
  $query = "INSERT INTO intra_session (ses_name,  ses_cat, ses_code, ses_ip) VALUES ('guest', '0', '$sid', '" . $_SERVER['REMOTE_ADDR'] . "')";
  mysqli_query($mysqli, $query) or die(mysqli_error());
}
$query = "UPDATE intra_session SET ses_time='" . time() . "' WHERE ses_code='" . $sid . "'";
mysqli_query($mysqli, $query);  

?>


