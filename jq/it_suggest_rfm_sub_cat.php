<?php
include "../../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT * FROM it_rfm WHERE rfm_cat_sub LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" GROUP BY rfm_cat_sub ORDER BY rfm_cat_sub ASC');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => recap($row['rfm_cat_sub']) ,
            'value' => recap($row['rfm_cat_sub'])
        );
    }
}

echo json_encode($data);
flush();
?>