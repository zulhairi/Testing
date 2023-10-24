<?php

  $searchTerm = $_GET["term"];
  // $sqlsearch = "SELECT * FROM hr_employee WHERE staffno LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" OR name LIKE "%'. mysqli_real_escape_string($mysqli, $_REQUEST['term']) .'%" ORDER BY status ASC";
  $sqlsearch = "SELECT * from hr_employee where name LIKE '%".$searchTerm."%' AND status = 1 ORDER BY name ASC ";
  $results = mysqli_query($mysqli, $sqlsearch);
  $json_array = array();
  while($row = mysqli_fetch_array($results))
  {
    // $json_array[] = $data;
    $json_array[] = 
    array(
                  'label' => $row['staffno'] .', '. $row['name'].' ('.$row['div_code'].')-'.$array_empstat[$row["status"]] ,
                  'value' => $row['staffno']
          );
  }
  
  echo json_encode($json_array);
  flush();

?>
