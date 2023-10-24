
<style>
   .head{
    background-color:#3a7bd5;
    color:white;
  }

  .bigger-icon {
    font-size: 250%;
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

.container2 {
    background-color: #3a7bd5;
    height: 4%;
    width: 107%;
    color: white;
    padding-top: 1%;
    font-size: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }

  .below-container {
    background-color: white;
    height: 15%;
    width: 107%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    padding: 2%;
    margin-bottom: 10%;
  }

.cell-gap {
  padding-right: 65px;
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
      <a class="active" href="?page=travelForm">Travelling Form</a>
      <ul>
        
        <li>
          <a href="?page=travelsummary">Requested Travelling</a>
        </li>

        <?php
        include "layouts/sidebarapprovetravelling.php";
        ?>
  
      </ul>
    </div>
    <a href="?page=csoapprovaltravel" class="logout-link" style = "background-color:#555; color:white;">
  <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
  Back</a>
  </div>

  <div class="container" style="margin-right:15%;">
  <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <thead class="head">
      <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <th scope="col" style="white-space: nowrap;">Staff No</th>
        <th scope="col" style="white-space: nowrap;">Reimbursable</th>
        <th scope="col" style="white-space: nowrap;">Month</th>
        <th scope="col" style="white-space: nowrap;">Class</th>
        <th scope="col" colspan="2" style="white-space: nowrap;">C.C (Vehicle)</th>
          <th scope="col" colspan="2" style="white-space: nowrap;">Project Code</th>
          <!-- <th scope="col" colspan="2" style="white-space: nowrap;">Project Manager</th> -->
          <th scope="col" colspan="3" style="white-space: nowrap;">Total</th>
      </tr>
    </thead>
    <tbody>
        <?php

            if (logged_in() == 2) {
                $form = 5;
                $approval_level_id = 34;               
            }else{
                $form = 1;
                $approval_level_id = 5;
            }

        $id = $_GET['id'];
        $sql = "SELECT * FROM travelclaims2 WHERE travel_id = '" . $id . "'";
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $id2 = $row["travel_id"];
          ?>

          <tr class="table-light">
            <td style="font-weight: bold;"><br>
              <?php echo $row["staffno"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php echo $row["reimbursable"] ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php
              echo date("F Y", strtotime($row["month"]));
              ?>
            </td>
            <td style="font-weight: bold;"><br>
              <?php
              echo ucfirst($row["class"]);
              ?>
            </td>
            <td colspan="2" style="font-weight: bold;"><br>
              <?php echo $row["cc"] ?>
            </td>
            <td colspan="2" style="font-weight: bold;"><br>
              <?php echo $row["project_code"] ?>
            </td>
            
            <td colspan="3" style="font-weight: bold;"><br>
              <?php echo "RM" . $row['totals'];
              ?>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>

        
      </div>

      <thead class="head">
      <tr>
      <th scope="col" colspan=11 style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

    <thead class="head">
      <tr>
      <th scope="col" style="white-space: nowrap;">Place</th>
      <th scope="col" style="white-space: nowrap;">Time of Departure</th>
      <th scope="col" style="white-space: nowrap;">Departure Date</th>
      <th scope="col" style="white-space: nowrap;">Time of Arrival</th>
      <th scope="col" style="white-space: nowrap;">Arrival Date</th>
      <th scope="col" style="white-space: nowrap;">Nature</th>
      <th scope="col" style="white-space: nowrap;">Category</th>
      <th scope="col" style="white-space: nowrap;">Particular of Claims</th>
      <th scope="col" colspan="3" style="white-space: nowrap;">Amount</th>
      </tr>
    </thead>

    <tbody>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM travel_details WHERE tclaims_id = '" . $id . "'";
    $result_travel_details = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result_travel_details) > 0) {
      while ($row_travel_details = mysqli_fetch_assoc($result_travel_details)) {
        ?>
        <tr class="table-light">

          <td style="font-weight: bold;"><br>
            <?php echo $array_place[$row_travel_details["place"]] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo date("h:iA", strtotime($row_travel_details["timedeparture"])) ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details['datearrival'] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo date("h:iA", strtotime($row_travel_details["timearrival"])) ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details['datedeparture'] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo $row_travel_details["nature"] ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo ucfirst($row_travel_details["category"]) ?>
          </td>
          <td style="font-weight: bold;">
            <br>
            <?php
            echo ucfirst($row_travel_details["particular"]);
            if ($row_travel_details["particular"] === "mileage") {
              echo "<br>";
              echo "(" . $row_travel_details["distance"] . "KM)";
            }
            ?>
          </td>
          <td style="font-weight: bold;"><br>
            <?php echo "RM" . $row_travel_details["amount"] ?>
          </td>

          <?php


          $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =" . $id);
          $rhod = mysqli_fetch_array($qhod);

          $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $firstApproverStatus = $r["approval_status"];

          if ($firstApproverStatus === 'pending') {
            $sql2 = "SELECT COUNT(*) AS num_amounts FROM travel_details WHERE tclaims_id = '$id'";
            $result2 = mysqli_query($mysqli, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $numAmounts = $row2['num_amounts'];

            $editUrl = "?page=editTravelling&tclaims_id=" . $id . "&traveldetails_id=" . $row_travel_details['traveldetails_id'];
            $deleteUrl = "?page=detailsummary2&traveldetails_id=" . $row_travel_details['traveldetails_id'] . "&id=" . $id;

            echo '<td><br>';
            echo '<a href="' . $editUrl . '" class="link-dark"><i class="fa-solid fa-pen-to-square"></i></a>';
            echo '</td>';

            if ($numAmounts > 1) {
              echo '<td><br>';
              // echo '<a href="'.$deleteUrl.'" class="link-dark"><i class="fa-solid fa-trash-can"></i></a>';
              print "<a href='javascript:void(0);' class='link-dark' onclick='confirmDelete(" . $id . ", " . $row_travel_details["traveldetails_id"] . ");'><i class='fa-solid fa-trash-can'></i></a>";

              echo '</td>';
            } else {
              echo '<td></td>';
            }

          } else {
            echo "<td></td>";
            echo "<td></td>";
          }
          ?>
        </tr>
        <?php
      }
    } else {

    }
    ?>

    <?php
    if (isset($_GET['traveldetails_id']) && isset($_GET['id'])) {
      $traveldetails_id = $_GET['traveldetails_id'];
      $tclaims_id = $_GET['id'];

      $sql2 = "DELETE FROM travel_details WHERE traveldetails_id = '$traveldetails_id' AND tclaims_id = '$tclaims_id' ";
      mysqli_query($mysqli, $sql2);

      $sql = "SELECT SUM(amount) AS total_amount FROM travel_details WHERE tclaims_id = '$tclaims_id'";
      $result = mysqli_query($mysqli, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalAmount = $row['total_amount'];

        $sql3 = "UPDATE travelclaims2 SET totals = '$totalAmount' WHERE travel_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql3);

        if ($totalAmount == 0) {
          $sql4 = "DELETE FROM travel_approval WHERE tclaims_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql4);

          $sql5 = "DELETE FROM travel_details WHERE tclaims_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql5);

          $sql6 = "DELETE FROM travelclaims2 WHERE travel_id = '$tclaims_id'";
          mysqli_query($mysqli, $sql6);

          $goto = "?page=travelsummary";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        } else {
          $goto = "?page=detailsummary2&id=$tclaims_id";
          $msg = "Deleting <img src='images/loading.gif' />";
          $func->info($msg, $goto);
        }
      } else {
        $sql4 = "DELETE FROM travel_approval WHERE tclaims_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql4);

        $sql5 = "DELETE FROM travel_details WHERE tclaims_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql5);

        $sql6 = "DELETE FROM travelclaims2 WHERE travel_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql6);

        $goto = "?page=travelsummary";
        $msg = "Deleting <img src='images/loading.gif' />";
        $func->info($msg, $goto);
      }
    }
    ?>

  </tbody>


    <thead class="head">
      <tr>
      <th scope="col" colspan="11" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

      <thead class="head">
    <tr>
    <th scope="col" colspan="11" style="text-align: center; white-space: nowrap;">Attachment</th>
    </tr>
  </thead>

    <tbody>
    <?php
      $id = $_GET['id'];
      $sql = "SELECT * FROM travel_details WHERE tclaims_id = '".$id."'";
      $result = mysqli_query($mysqli, $sql);
      ?>

      <tr class="table-light">
        <td scope="col" colspan="12" style="text-align: center; white-space: nowrap;">
          <div style="display: flex; justify-content: flex-start;">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              $attachment = $row["attachment"];
            ?>
              <div style="margin-right: 20px;">
                <a href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $attachment; ?>" class="link-dark" target="_blank">
                  <i class="fa-solid fa-paperclip bigger-icon"></i>
                </a>
                <br><br>
                Click to view attachment
              </div>
            <?php
            }
      ?>
    </div>
  </td>
</tr>

    </tbody>

    <thead class="head">
      <tr>
      <th scope="col" colspan="11" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

  </table>

  <strong><center>
<div class = "container2">
  Approval Status
    </div>
    </strong>
    </center>

    <div class="below-container">
    <form id="approval-HOD" action="" method="POST" enctype="multipart/form-data">
  <table>
    <tr class="tableheader">
      <!-- Header content -->
    </tr>
   
    <tr>
      <td class="cell-gap" valign="top">Mr. Ravi Approval :</td>
      <td class="cell-gap" valign="top">Approval Status :</td>
      <td class="cell-gap" valign="top">Remarks :</td>
      <td class="cell-gap" valign="top">Action :</td>

    </tr>
    <tr>
      <td class="cell-gap" valign="top">

      <?php
     $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id = '".$id."'");
     while ($dql5 = mysqli_fetch_array($sql5)) 
     {
       
         $id5 = $dql5["travel_id"];
         
         $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND staffno = '".$ses_staffno."'";
         $result6 = mysqli_query($mysqli, $sql6);
         $row6 = mysqli_fetch_assoc($result6);

         $hod = $row6["staffno"];
         $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
         $result7 = mysqli_query($mysqli, $sql7);
         $row7 = mysqli_fetch_array($result7);
         echo "<strong>".$row7["name"]."</strong>";

     }

  if (isset($_POST["submit"])) {
        $csoApproval = $_POST["cso_approval"];
        $remarks = $_POST["remark"];
      
        if ($csoApproval == "1") {
          $cso_status = 'Approved';
        } else if ($csoApproval == "2") {
          $cso_status = 'Declined';
        }
        
        //next approval
        // $form = 1;
        $next = check_next_approval($id, $ses_staffno);
        $updateSql = "UPDATE approval_detail SET approval_status = '$cso_status',approval_remarks = '".$remarks."' WHERE staffno = '$ses_staffno' AND  t_claims_id = $id AND approval_priority = $next";

        if ($cso_status == "Declined") {
          mysqli_query($mysqli, $updateSql);
    
          $sqlh = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id = '".$_GET["id"]."'");
          $dqlh = mysqli_fetch_array($sqlh);
          $staff = $dqlh["staffno"];
    
          $aq1 = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staff."'");
          $ar1 = mysqli_fetch_array($aq1);
    
          if($ar1["imail"]!=""){
            $mto = $ar1["imail"];
            $subject = "Travelling Form - Notification";
    
            $message = "Dear ".recap($ar1["name"]).",<br /><br />You Travelling Form has been Declined By the Approver
    
            Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
            <br /><br />
            Regards
            <br />
            E-Form System Services
            <br />";
    
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: No-Reply <no-reply@minconsult.com>' . "\r\n" .
            'Reply-To: no-reply@minconsult.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            if (mail($mto, $subject, $message, $headers)) {
              print "Mailed Sent ".$mto;
            }else{
              print "Mail Sent Failed";
            }
          }
    
        }else{

          if (mysqli_query($mysqli, $updateSql)) {
          
              insert_into_next($next,$form, $id);
      
              $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority > $next");
              $dql8 = mysqli_fetch_array($sql8);
              $staffno = $dql8['staffno'];    
              
              //no more next approver sent noti to user 
              if($dql8["approval_priority"] == ""){
                
                $sqlh = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id = '".$_GET["id"]."'");
                $dqlh = mysqli_fetch_array($sqlh);
                $staff = $dqlh["staffno"];

                $aq1 = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staff."'");
                $ar1 = mysqli_fetch_array($aq1);

                if($ar1["imail"]!=""){
                  $mto = $ar1["imail"];
                  $subject = "Travelling Form - Notification";
          
                  $message = "Dear ".recap($ar1["name"]).",<br /><br />You Travelling Form has been Updated By the Approver
          
                  Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
                  <br /><br />
                  Regards
                  <br />
                  E-Form System Services
                  <br />";
          
                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  $headers .= 'From: No-Reply <no-reply@minconsult.com>' . "\r\n" .
                  'Reply-To: no-reply@minconsult.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
                  if (mail($mto, $subject, $message, $headers)) {
                    print "Mailed Sent ".$mto;
                  }else{
                    print "Mail Sent Failed";
                  }
                }

              } else{
                    // send email to next Person
                    $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staffno."'");
                    $ar = mysqli_fetch_array($aq);
                    if($ar["imail"]!=""){
                      $mto = $ar["imail"];
                      $subject = "Travelling Form - Finance Approval";
                
                      $message = "Dear ".recap($ar["name"]).",<br /><br />You Have New Travelling Approval Pending
                
                      Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
                      <br /><br />
                      Regards
                      <br />
                      E-Form System Services
                      <br />";
                
                      $headers = "MIME-Version: 1.0" . "\r\n";
                      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                      $headers .= 'From: No-Reply <no-reply@minconsult.com>' . "\r\n" .
                      'Reply-To: no-reply@minconsult.com' . "\r\n" .
                      'X-Mailer: PHP/' . phpversion();
                      if (mail($mto, $subject, $message, $headers)) {
                        print "Mailed Sent to ".$mto;
                      }else{
                        print "Mail Sent Failed";
                      }
                    }

              }

            
          } else {
            if(mysqli_errno($mysqli)) {
              die("Database query failed: " . mysqli_error($mysqli));
            } else {
                
            }
          }
        }

        
        $goto = "?page=csoapprovaltravel";
        $msg = "";
        $func	-> info($msg,$goto);

      }
  
?>
      
      </td>
      <td class="cell-gap" valign="top">
        <select name="cso_approval">
          <option value="">Please Select</option>
          <option value="1">Approve</option>
          <option value="2">Decline</option>
        </select>
      </td>
      <td class="cell-gap" valign="top">
      <textarea name="remark" placeholder="Enter remark"></textarea>
      </td>
     
      <td class="cell-gap" valign="top">
      <button type="submit" name="submit">Submit</button>
      </td>
      
    </tr>
</form>
  </table>
</div>
</div>
  