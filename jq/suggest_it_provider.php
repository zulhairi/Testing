<?php
include "../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT * FROM it_item WHERE item_purchase_from LIKE "%'.mysqli_real_escape_string($mysqli, $_REQUEST['term']).'%" GROUP BY item_purchase_from ORDER BY item_purchase_from ASC LIMIT 0,5');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['item_purchase_from'] ,
            'value' => $row['item_purchase_from']
        );
    }
}

echo json_encode($data);
flush();
?>