<?php
include "../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT * FROM project_senior WHERE senior_desig LIKE "%'.mysqli_real_escape_string($mysqli, $_REQUEST['term']).'%" GROUP BY senior_desig ORDER BY senior_desig ASC LIMIT 0,5');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['senior_desig'] ,
            'value' => $row['senior_desig']
        );
    }
}

echo json_encode($data);
flush();
?>