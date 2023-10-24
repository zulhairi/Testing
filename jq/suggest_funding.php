<?php
include "../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT project_funding FROM project_detail WHERE project_funding LIKE "%'.mysqli_real_escape_string($mysqli, $_REQUEST['term']).'%" GROUP BY project_funding ORDER BY project_funding ASC LIMIT 0,5');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['project_funding'] ,
            'value' => $row['project_funding']
        );
    }
}

echo json_encode($data);
flush();
?>