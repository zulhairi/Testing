<?php
include "../../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT * FROM it_item WHERE item_code LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR item_name LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" AND item_stat="0" ORDER BY item_name ASC LIMIT 0,5');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['item_code'] .', '. $row['item_name'] ,
            'value' => $row['item_id']."-".$row['item_code']."-".$row['item_name']
        );
    }
}

echo json_encode($data);
flush();
?>