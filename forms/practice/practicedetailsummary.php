<style>
  .head{
    background-color:#3a7bd5;
    color:white;
  } 

  .bigger-icon {
  font-size: 35px; 
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

.second-header {
  margin-top: 20px;
  padding-top: 20px; 
}

.container2
{
  background-color:#3a7bd5;
  height:50px; 
  color:white;
  padding-top:10px;
  font-size:20px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.containerpdf
{
  background-color:#3a7bd5;
  height:50px; 
  color:white;
  padding-top:10px;
  font-size:20px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.below-container
{
  background-color:white;
  height:100px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding-top: 20px;
  padding-right: 10px;
  padding-bottom: 50px;
  padding-left: 20px;
}

.below-containerpdf
{
  background-color:white;
  height:150px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding-top: 30px;
  padding-right: 10px;
  padding-bottom: 50px;
  padding-left: 20px;
}

.cell-gap {
  padding-right: 50px;
}

.fa-sharp {

  font-size: 50px;
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
<body id="printTable">

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
  <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <thead class="head">
      <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <th scope="col" style="white-space: nowrap;">Staff No</th>
        <th scope="col" style="white-space: nowrap;">Designation</th>
        <th scope="col" style="white-space: nowrap;">Appointed Date</th>
        <th scope="col" style="white-space: nowrap;">Department</th>
        <th scope="col" style="white-space: nowrap;">Required Advance</th>
      </tr>
    </thead>
    <tbody>
    <?php

  $id = $_GET['id'];
  $sql = "SELECT * FROM test_claims WHERE id_claims = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            $id2 = $row["travel_id"];
            ?>
            <tr class="table-light">
            <td style = "font-weight: bold;"><br><?php echo $row["staffno"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["designation"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["date_appointment"]?> </td>
            <td style = "font-weight: bold;"><br><?php echo $row["department"]?></td>
            

            <?php
              $sql2 = "SELECT * from test_details WHERE id_claims = '".$id."'";
              $result2 = mysqli_query($mysqli, $sql2);
              while ($row2 = mysqli_fetch_assoc($result2))
              {
                ?>
              <td style = "font-weight: bold;"><br><?php echo "RM ".$row2["amount"]?></td>
          </tr>
        <?php
              }
        }
        ?>
    </tbody>
        
      </div>

      <thead class="head">
      <tr>
        <th scope="col" colspan="5" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

    <thead class="head">
      <tr>
        <th scope="col" style="white-space: nowrap;">Previous Advance</th>
        <th scope="col" style="white-space: nowrap;">Reimbursable</th>
        <th scope="col" style="white-space: nowrap;">Project Code</th>
        <th scope="col" style="white-space: nowrap;">Nature</th>
        <th scope="col" style="white-space: nowrap;">Purpose</th>
      </tr>
    </thead>

    <tbody>
    <?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM test_details WHERE id_claims = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            ?>
            <tr class="table-light">
            <td style = "font-weight: bold;"><br><?php echo "RM ".$row["amount"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["reimbursable"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["project_code"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["nature"]?></td>
            <td style = "font-weight: bold;"><br><?php echo $row["purpose"]?></td>
            
          </tr>
        <?php
        }
        ?>
    </tbody>

    <thead class="head">
      <tr>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

      <thead class="head">
    <tr>
      <th scope="col" colspan="5" style="text-align: center; white-space: nowrap; font-size:20px;">Attachment</th>
    </tr>
  </thead>

    <tbody>
    <?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM test_details WHERE id_claims = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            ?>
            <tr class="table-light">
            <td scope="col" colspan="5" style="text-align: center; white-space: nowrap;">
            <a href="https://intranet.minconsult.com/sand/minco/sources/E-FORM/<?php echo $row["attachment"]; ?>" class="link-dark" target="_blank"><i class="fa-solid fa-paperclip bigger-icon"></i></a><br><br>
            Click to view attachment
            </td>
          </tr>
        <?php
        }
        ?>
    </tbody>

    <thead class="head">
      <tr>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

  </table>


  <strong><center>
  <div class = "container2">
    <!-- Approval Status <button id="generate_pdf">Print</button> -->
    Approval Phase

      </div>
      </strong>
      </center>

      <div class="below-container">
    <table align = "center">
      <tr class="tableheader">
        <!-- Header content -->
      </tr>

      <?php
      //change to approval_detail table
       
          $sl = mysqli_query($mysqli,"SELECT * FROM approval_detail WHERE t_claims_id = '".$id."'");
          while($sq = mysqli_fetch_array($sl)){

            if ($sq["approval_level_id"] == 29) {
            //HOD  
              $approval_status = $sq["approval_status"];
            }
            
            elseif ($sq["approval_level_id"] == 30) {
            //PM
              $pm_approval = $sq["approval_status"];
            }
            
            elseif ($sq["approval_level_id"] == 31) {
            //BIL1
              $billing_approval = $sq["approval_status"];
              
            }

            else{
              print "UNKNOWN";
            }

          }
        
      ?>
  <tr>
    <td class="cell-gap" valign="top">HOD Approval : <br><strong><?php echo !empty($approval_status) ? $approval_status : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
    <td class="cell-gap" valign="top">Payrool Approval : <br><strong><?php echo !empty($pm_approval) ? $pm_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>   
    <td class="cell-gap" valign="top">Account Approval : <br><strong><?php echo !empty($account_approval) ? $account_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
  </tr>
    </table>
  </div>
  <br>
  <?php
  if ($approval_status === 'Approved' && $pm_approval === 'Approved' && $billing_approval === 'Approved' && $billing2_approval === 'Approved' && $finance_approval === 'Approved' && $ceo_approval === 'Approved' && $account_approval === 'Approved') {
    ?>
    <strong><center>
    <div class="containerpdf">
      Convert to PDF
    </div>
    </strong>
    </center>
    <center>
      <?php
      $sql = "SELECT * FROM travel_details WHERE tclaims_id = '".$id."'";
      $result = mysqli_query($mysqli, $sql);
      while($row2 = mysqli_fetch_array($result))
      {
        $traveldetails = $row2['traveldetails_id'];
      }
      ?>
      <div class="below-containerpdf">
      <a href="?page=advancegeneratePDF&id=<?php echo $id; ?>" class="link-dark">
                <i class="fa-sharp fa-solid fa-file-pdf"></i>
    </a><br><br>
      Click to convert to PDF
        
      </div>
    </center>
    <?php
  
}
  ?>
  </div>
 