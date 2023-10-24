<?php
// include "../../../E-FORM/config.php";
  $searchTerm = $_GET["term"];
  // $sqlsearch = "SELECT * FROM hr_employee WHERE staffno LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR name LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" ORDER BY status ASC";
  $sqlsearch = "SELECT * from project_detail where project_code LIKE '%".$searchTerm."%'";
  // $sqlsearch = "SELECT * FROM `project_detail` ORDER BY `project_id` ASC ";
  $results = mysqli_query($mysqli, $sqlsearch);
  $json_array = array();
  $counter = 0;
  while($row = mysqli_fetch_array($results))
  {
    if ($counter >= 5)
    {
      break;
    }
    $json_array[] = 
    array(
                  'label' => $row['project_code'] .', '. $row['project_title'],
                  'value' => $row['project_code']
          );
          $counter ++;
  }
  
  echo json_encode($json_array);
  flush();

?>
