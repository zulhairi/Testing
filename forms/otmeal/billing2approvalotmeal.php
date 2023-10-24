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
    </tr>
  </thead>
  <tbody>
  <?php

    $sql = "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_status = 'pending' AND approval_level_id = 26";
    $result4 = mysqli_query($mysqli, $sql);
    while($row4 = mysqli_fetch_array($result4)){

      //check $t_id
      $t_id = $row4["t_claims_id"];
      $priority = $row4["approval_priority"];
      
      // $sql1 = "SELECT * FROM approval_detail WHERE t_claims_id = $t_id  ORDER BY approval_priority";
      // $result5 = mysqli_query($mysqli, $sql1);

      // while($row5 = mysqli_fetch_array($result5)){
     
        // if (($row4["approval_priority"]  <  $row5["approval_priority"] && $row5["approval_status"] == "pending") || ($row4["approval_priority"]  >  $row5["approval_priority"] && $row5["approval_status"] == "Approved") ) {
    
    ?>
          <tr class="table-light">
            <td class="counterCell"></td>
                
              <?php 
                $sql2 = "SELECT * FROM otmealclaim WHERE otmeal_id =".$row4["t_claims_id"];
                $result2 = mysqli_query($mysqli, $sql2);
                $row2 = mysqli_fetch_array($result2);
              
                $sql3 = "SELECT * FROM hr_employee WHERE staffno = '".$row2["staffno"]."'";
                $result3 = mysqli_query($mysqli, $sql3);
                $row3 = mysqli_fetch_array($result3);
              
              ?>

            <td><?php echo $row2["name"] ?></td>
            <td><?php echo $row2["staffno"] ?></td>
            <td><?php echo $row2["department"] ?></td>
            <td><?php echo "RM".$row2["total"] ?></td>
          
            <td>
             <a href="?page=billing2approvalstatusotmeal&id=<?php echo $row4["t_claims_id"]; ?>" class="link-dark"><i class="fa-solid fa-eye"></i></a>
            </td>
          </tr>
          
          <?php
     
    // }
  // }
     
  }  
  
?>
  </tbody>
</table>
  </div>


