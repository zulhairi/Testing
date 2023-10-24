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

.below-container
{
  background-color:white;
  height:150px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding: 20px;
  margin-bottom: 20px;
}

.cell-gap {
  padding-right: 65px;
}

/* Style the "Show X entries" label */
#travelClaimsTable_length label {
    display: flex;
    /* Use flexbox to align items */
    align-items: center;
    /* Vertically center items */
    margin-right: 10px;
    color: #555;
    font-weight: bold;
  }

  /* Style the "Show X entries" dropdown select */
  #travelClaimsTable_length select {
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f5f5f5;
    font-size: 16px;
  }

  /* Style the dropdown arrow */
  #travelClaimsTable_length select::-ms-expand {
    display: none;
    /* Remove the default arrow in IE */
  }

  #travelClaimsTable tbody tr {
    border-bottom: 1px solid #ddd;
    /* Add a bottom border to each row */
  }



  </style>
<!DOCTYPE html>
<html>
<head>

  <!--Copy this header as well for all the forms that needs listing-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="js/script.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<body id="printTable">

  <div class="sidebar">
    <div class="sidebar-links">
      <a class="active" href="?page=advance">Advance Form</a>
      <ul>
        
        <li>
          <a href="?page=advancesummary">Requested Advance</a>
        </li>

        <?php
        include "layouts/sidebarapprove.php";
        ?>
  
      </ul>
    </div>
    <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
    <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
    Back</a>
  </div>

  <div class="container"
    style="margin-left:270px;  background-color:white; padding-top:30px; border-radius:20px;box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; ">
    
    <table class="table table-striped text-center" id="travelClaimsTable">    <thead class="head">
      
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
  $sql = "SELECT * FROM advanceclaim WHERE advance_id = '".$id."'";
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
              $sql2 = "SELECT * from advance_details WHERE aclaims_id = '".$id."'";
              $result2 = mysqli_query($mysqli, $sql2);
              while ($row2 = mysqli_fetch_assoc($result2))
              {
                ?>
              <td style = "font-weight: bold;"><br><?php echo "RM".$row2["advance_required"]?></td>
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
  $sql = "SELECT * FROM advance_details WHERE aclaims_id = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            ?>
            <tr class="table-light">
            <td style = "font-weight: bold;"><br><?php echo "RM".$row["previous_advances"]?></td>
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
        <th scope="col" colspan="5" style="white-space: nowrap; background-color:white;"></th>

      </tr>
      </thead>

      <thead class="head">
    <tr>
      <th scope="col" colspan="5" style="text-align: center; white-space: nowrap;">Attachment</th>
    </tr>
  </thead>

    <tbody>
    <?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM advance_details WHERE aclaims_id = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            ?>
            <tr class="table-light">
            <td scope="col" colspan="5" style="text-align: center; white-space: nowrap;">
            <a href="https://intranet.minconsult.com/sources/E-FORM/<?php echo $row["attachment"]; ?>" class="link-dark" target="_blank"><i class="fa-solid fa-paperclip bigger-icon"></i></a><br><br>
            Click to view attachment
            </td>
          </tr>
        <?php
        }
        ?>
    </tbody>

    <thead class="head">
      <tr>
        <th scope="col" colspan="5" style="white-space: nowrap; background-color:white;"></th>
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
      
    </tr>
   
    <tr>
      <td class="cell-gap" valign="top">Project Manager Approval :</td>
      <td class="cell-gap" valign="top">Approval Status :</td>
      <td class="cell-gap" valign="top">Remarks :</td>
      <td class="cell-gap" valign="top">Action :</td>      
    </tr>
    <tr>
      <td class="cell-gap" valign="top">

      <?php

$sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id = '".$id."'");
  while ($dql5 = mysqli_fetch_array($sql5)) 
  {
      $id5 = $dql5["advance_id"];

      $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND staffno = '".$ses_staffno."' AND approval_level_id = 21";
          
      $result6 = mysqli_query($mysqli, $sql6);
      $row6 = mysqli_fetch_assoc($result6);
     
      $pm = $row6["staffno"];
      $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$pm."'";
      $result7 = mysqli_query($mysqli, $sql7);
      $row7 = mysqli_fetch_array($result7);

      echo "<strong>".$row7["name"]."</strong>";

  }

  if (isset($_POST["submit"])) {
    $pmApproval = $_POST["pm_approval"];
    $remarks = $_POST["remark"];
  
    if ($pmApproval == "1") {
      $pm_status = 'Approved';
    } else if ($pmApproval == "2") {
      $pm_status = 'Declined';
    }
  
   //next approval
   $form = 3;

   $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
   $r = mysqli_fetch_array($q);
   $firstApprovalStatus = $r["approval_status"];

   if ($firstApprovalStatus == "pending") {
     $next = $r["approval_priority"];
   }else{
     $next = check_next_approval($id, $ses_staffno);
   }
   
   $updateSql = "UPDATE approval_detail SET approval_status = '$pm_status',approval_remarks = '".$remarks."' WHERE staffno = '$ses_staffno' AND  t_claims_id = $id AND approval_priority = $next";

   if ($pm_status == "Declined") {
     mysqli_query($mysqli, $updateSql);

     $sqlh = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE travel_id = '".$_GET["id"]."'");
     $dqlh = mysqli_fetch_array($sqlh);
     $staff = $dqlh["staffno"];

     $aq1 = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staff."'");
     $ar1 = mysqli_fetch_array($aq1);

     if($ar1["imail"]!=""){
       $mto = $ar1["imail"];
       $subject = "Advance Form - Notification";

       $message = "Dear ".recap($ar1["name"]).",<br /><br />Your Advance Form has been Declined By the Approver

       Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=advance'>Here</a> To View And Verify
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

         // send email to next Person
         $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staffno."'");
         $ar = mysqli_fetch_array($aq);
         
           //no more next approver sent noti to user 
         if($dql8["approval_priority"] == ""){
           
           $sqlh = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE travel_id = '".$_GET["id"]."'");
           $dqlh = mysqli_fetch_array($sqlh);
           $staff = $dqlh["staffno"];

           $aq1 = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staff."'");
           $ar1 = mysqli_fetch_array($aq1);

           if($ar1["imail"]!=""){
             $mto = $ar1["imail"];
             $subject = "Advance Form - Notification";
     
             $message = "Dear ".recap($ar1["name"]).",<br /><br />Your Advance Form has been Updated By the Approver
     
             Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=advance'>Here</a> To View And Verify
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
           if($ar["imail"]!=""){
             $mto = $ar["imail"];
             $subject = "Advance Form - Next Approval";

             $message = "Dear ".recap($ar["name"]).",<br /><br />You Have New Advance Approval Pending

             Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=advance'>Here</a> To View And Verify
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
   
 
   $goto = "?page=pmapprovaladvance";
   $msg = "";
   $func	-> info($msg,$goto);
 
 }
 


?>
      
      </td>
      <td class="cell-gap" valign="top">
        <select name="pm_approval" required>
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

