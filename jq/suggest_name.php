<?php
include "../../config.php";
if ( !isset($_REQUEST['term']) )
    exit;

$rs = mysqli_query($mysqli,'SELECT * FROM hr_employee WHERE staffno LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR name LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" ORDER BY status ASC');

$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
    while( $row = mysqli_fetch_array($rs) )
    {
        $data[] = array(
            'label' => $row['staffno'] .', '. $row['name'].' ('.$row['div_code'].')-'.$array_empstat[$row["status"]] ,
            'value' => $row['staffno']
        );
    }
}

echo json_encode($data);
flush();
?>