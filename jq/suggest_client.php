<?php
include "../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT project_client FROM project_detail WHERE project_client LIKE "%'.mysqli_real_escape_string($mysqli, $_REQUEST['term']).'%" GROUP BY project_client ORDER BY project_client ASC LIMIT 0,5');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['project_client'] ,
            'value' => $row['project_client']
        );
    }
}

echo json_encode($data);
flush();
?>