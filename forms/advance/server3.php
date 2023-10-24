<?php
// include "../../../E-FORM/config.php";
$searchTerm = $_GET["term"];
// $sqlsearch = "SELECT * FROM hr_employee WHERE staffno LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR name LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" ORDER BY status ASC";
$sqlsearch = "SELECT * from project_detail WHERE project_code LIKE '%" . $searchTerm . "%'";
// $sqlsearch = "SELECT * FROM `project_detail` ORDER BY `project_id` ASC ";
$results = mysqli_query($mysqli, $sqlsearch);
$json_array = array();
$counter = 0; // Initialize a counter

while ($row = mysqli_fetch_array($results)) {
    if ($counter >= 8) {
        break; // Break out of the loop after 5 suggestions
    }
    $json_array[] = array(
        'label' => $row['project_code'] . ', ' . $row['project_title'],
        'value' => $row['project_code']
    );
    $counter++; // Increment the counter
}

echo json_encode($json_array);
flush();
?>
