<style>
  .head{
    background-color:#3a7bd5;
    color:white;
  }

  .link-dark
  {
    color:#3a7bd5;
  }

  table {
    counter-reset: tableCount;     
}
.counterCell:before {              
    content: counter(tableCount); 
    counter-increment: tableCount; 
}

body{

  background: url("images/bg.jpg") no-repeat center bottom/cover;
}

  
  </style>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-links">
    <a class="active" href="?page=practice">Practice Form</a>
    <ul>
      
      <li>
        <a href="?page=practicesummary">Requested Practice</a>
      </li>

      <?php
      include "layouts/sidebarapprove.php";
      ?>
 
    </ul>
  </div>
  <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
  <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
  Logout</a>
</div>

<div class="container" style="margin-right:120px;">
  
<table class="table  table-striped text-center">
  <thead class="head">
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Advance Required</th>
      <th scope="col">When Required</th>
      <th scope="col">Nature</th>
      <th scope="col">Purpose</th>
      <th scope="col">Details</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
$sql2 = "SELECT * FROM test_claims WHERE staffno = '".$ses_staffno."'";
$result2 = mysqli_query($mysqli, $sql2);
while ($row2 = mysqli_fetch_array($result2)) {
    $id = $row2["id_claims"];
  
    $sql = "SELECT * FROM test_details WHERE id_claims = ".$id;
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);

?>
        <tr class="table-light">
            <td class="counterCell"></td>
            <td><?php echo "RM".$row["amount"]?></td>
            <td><?php echo $row["purpose"] ?></td>
            <td><?php echo $row["nature"] ?></td>
            <td><?php echo $row["purpose"] ?></td>
            <td>

          <a href="?page=practicedetailsummary&id=<?php echo $id; ?>" class="link-dark"><i class="fa-solid fa-eye"></i></a>
          </td>
          
          <td colspan = '2'>
          <?php
          $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =".$id);
          $rhod = mysqli_fetch_array($qhod);
          
          $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $firstApproverStatus = $r["approval_status"];

        if ($firstApproverStatus == "pending" || $firstApproverStatus == "Declined") {
          
            $approval_id = $r["approval_level_id"];
            $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $approval_id");
            $rr = mysqli_fetch_array($qq);
            $title = $rr["title"];
  
            if ($firstApproverStatus == "pending") {
              print "<strong><span style='color: white; background-color: orange; border-radius: 5px; line-height: 35px; padding: 5px;'>".$firstApproverStatus ." by ".staff_details($r["staffno"])["name"]." - ".  $title ."</span></strong>";
              print "<br>&nbsp;&nbsp;&nbsp;<a href='?page=practicesummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
              print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?page=editpracticeform&id=".$id."' class='link-dark'><i class='fa-solid fa-pen-to-square'></i></a>";

            }else if ($firstApproverStatus == "Declined")  {
              print "<strong><span style='color: white; background-color: green; border-radius: 5px; line-height: 35px; padding: 5px;'>".$firstApproverStatus ." by ".staff_details($r["staffno"])["name"]." - ". $title. "</span></strong>";
              print "&nbsp;&nbsp;&nbsp;<a href='?page=practicesummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
              print "&nbsp;&nbsp;&nbsp;<a href='?page=editpracticeform&id=".$id."' class='link-dark'><i class='fa-solid fa-pen-to-square'></i></a>";
            }
            
        }else{
          
          $q2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id ORDER BY approval_priority DESC LIMIT 1");
          $r2 = mysqli_fetch_array($q2);
            
          $approval_id = $r2["approval_level_id"];
            $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $approval_id");
            $rr = mysqli_fetch_array($qq);
            $title = $rr["title"];

          if ($r2["approval_status"] == "pending" || $r2["approval_status"] == "Declined") {
            print "<strong><span style='color: white; background-color: orange; border-radius: 5px; line-height: 35px; padding: 5px;'>".$r2["approval_status"] ." by ".staff_details($r2["staffno"])["name"]." - ". $title. "</span></strong>";
           
          }else{
            print "<strong><span style='color: white; background-color: green; border-radius: 5px; line-height: 35px; padding: 5px;'>".$r2["approval_status"] ." by ".staff_details($r2["staffno"])["name"]." - ". $title. "</span></strong>";
            
          }
          
        }

        
        ?>
         
            <?php

            if ($id == $_GET["id"]) {
              if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                
                    $sql = "DELETE FROM approval_detail WHERE t_claims_id  = " . $id;
                    mysqli_query($mysqli, $sql);

                    $sql2 = "DELETE FROM test_details WHERE id_claims = " . $id;
                    mysqli_query($mysqli, $sql2);

                    $sql3 = "DELETE FROM test_claims WHERE id_claims = " . $id;
                    mysqli_query($mysqli, $sql3);
                
                    $goto = "?page=practicesummary";
                    $msg = "Deleting <img src='images/loading.gif' />";
                    $func	-> info($msg,$goto);
                } 
            }
            
            ?>
            
          </td>
        </tr>
      <?php
        
        }
   
      ?>
  </tbody>
</table>
  </div>


