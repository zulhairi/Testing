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
            <a class="active" href="?page=otmealForm">OT Meal Form</a>
            <ul>
               <li>
                  <a href="?page=otmealsummary">Requested OT Meal</a>
               </li>
               <?php
                  include "layouts/sidebarapproveotmeal.php";
                  ?>
            </ul>
         </div>
         <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
         <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
         Back</a>
      </div>

<div class="container" style="margin-right:120px;">
<table class="table  table-striped text-center">
  <thead class="head">
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Staff</th>
      <th scope="col">Staff No</th>
      <th scope="col">Department</th>
      <th scope="col">Total</th>
      <th scope="col">Details</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sql2 = "SELECT * FROM otmealclaim WHERE staffno = '".$ses_staffno."'";
$result2 = mysqli_query($mysqli, $sql2);
while ($row2 = mysqli_fetch_array($result2)) {
    $id = $row2["otmeal_id"];

    $sql = "SELECT * FROM otmeal_details WHERE otclaim_id = ".$id;
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
?>
        <tr class="table-light">
            <td class="counterCell"></td>
            <td><?php echo $row2["name"] ?></td>
            <td><?php echo $row2["staffno"] ?></td>
            <td><?php echo $row2["department"] ?></td>
            <td><?php echo "RM".$row2["total"] ?></td>
            <td>

          <a href="?page=detailsummary4&id=<?php echo $id; ?>" class="link-dark"><i class="fa-solid fa-eye"></i></a>
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
              print "<br>&nbsp;&nbsp;&nbsp;<a href='?page=otmealsummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
              print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?page=otmealedit&id=".$id."' class='link-dark'><i class='fa-solid fa-pen-to-square'></i></a>";


            }else if ($firstApproverStatus == "Declined")  {
              print "<strong><span style='color: white; background-color: green; border-radius: 5px; line-height: 35px; padding: 5px;'>".$firstApproverStatus ." by ".staff_details($r["staffno"])["name"]." - ". $title. "</span></strong>";
              print "&nbsp;&nbsp;&nbsp;<a href='?page=otmealsummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
              print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?page=otmealedit&id=".$id."' class='link-dark'><i class='fa-solid fa-pen-to-square'></i></a>";

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

      //   if ($rhod["hod_status"] === "Approved" && $pmapproval === 'Approved' && $billing_approval === 'Pending' && $billing2_approval === 'Pending' && $account_approval === 'Pending' && $payroll_approval === 'Pending') {
      //       echo "<strong><span>Hod Approved</span></strong>";
      //   } else if ($hodapproval === 'Declined' || $pmapproval === 'Declined' || $billing_approval === 'Declined' || $billing2_approval === 'Declined' || $account_approval === 'Declined' || $payroll_approval === 'Declined') {
      //       echo "<a href='?page=travelsummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
      //   } else if ($hodapproval === 'Pending') {
      //     echo "<a href='?page=travelsummary&id=".$id."' class='link-dark'><i class='fa-solid fa-trash-can'></i></a>";
      // }
      // else if ($rhod["hod_status"] === "Approved" && $pmapproval === 'Approved' && $billing_approval === 'Approved' && $billing2_approval === 'Approved' && $account_approval === 'Approved' && $payroll_approval === 'Approved')
      // {
      //   echo "<strong><span>Everything Approved</span></strong>";
      // }
      // else{
      //   echo "<strong><span>Approval On Process</span></strong>";
      // }
        ?>
         
            <?php

           if ($id == $_GET["id"]) {
    if (isset($_GET['id'])) {
        $idToDelete = $_GET['id']; 

        echo "Deleting records for ID: $idToDelete<br>"; 

        $sql = "DELETE FROM approval_detail WHERE t_claims_id = $idToDelete";
        if (mysqli_query($mysqli, $sql)) {
            // echo "Approval detail records deleted successfully<br>"; 
        } else {
            echo "Error deleting approval detail records: " . mysqli_error($mysqli) . "<br>"; 
        }

        $sql2 = "DELETE FROM otmeal_details WHERE otclaim_id = $idToDelete";
        if (mysqli_query($mysqli, $sql2)) {
            // echo "Entertainment detail records deleted successfully<br>"; 
        } else {
            echo "Error deleting entertainment detail records: " . mysqli_error($mysqli) . "<br>"; 
        }

        $sql3 = "DELETE FROM otmealclaim WHERE otmeal_id = $idToDelete";
        if (mysqli_query($mysqli, $sql3)) {
            // echo "Entertainment claim records deleted successfully<br>"; 
        } else {
            echo "Error deleting entertainment claim records: " . mysqli_error($mysqli) . "<br>"; 
        }

        $goto = "?page=otmealsummary";
        $msg = "Deleting <img src='images/loading.gif' />";
        $func->info($msg, $goto);
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


