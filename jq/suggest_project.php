<?php
include "../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT project_code, project_title FROM project_detail WHERE project_code LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR project_title LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" ORDER BY project_title ASC LIMIT 0,3');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['project_code'] .', '. $row['project_title'] ,
            'value' => $row['project_code']
        );
    }
}

echo json_encode($data);
flush();
?>