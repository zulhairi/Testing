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

.blink {
  animation: blinker 3s linear infinite;
}

.table-cell {
    padding: 8px; /* Adjust as needed */
    text-align: center;
  }
  
  /* Style for bold headings */
  .bold-heading {
    font-weight: bold;
  }

/* @keyframes blinker {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
} */

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
  <table class="table table-striped text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <thead class="head">
      <tr style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <th scope="col" colspan = "4" style="white-space: nowrap;">Name</th>
        <th scope="col" colspan = "4" style="white-space: nowrap;">Staff No</th>
        <th scope="col" colspan = "4" style="white-space: nowrap;">Department</th>
        <th scope="col" colspan = "4" style="white-space: nowrap;">Total</th>
        <th scope="col" colspan = "4" style="white-space: nowrap;"></th>
      </tr>
    </thead>
    <tbody>
    <?php

  $id = $_GET['id'];
  $sql = "SELECT * FROM otmealclaim WHERE otmeal_id = '".$id."'";
          $result = mysqli_query($mysqli, $sql);
          while ($row = mysqli_fetch_assoc($result)) 
          {
            $id2 = $row["otmeal_id"];
            ?>
            <tr class="table-light">
            <td colspan = "4" style = "font-weight: bold;"><br><?php echo $row["name"]?></td>
            <td colspan = "4" style = "font-weight: bold;"><br><?php echo $row["staffno"]?></td>
            <td colspan = "4" style = "font-weight: bold;"><br><?php echo $row["department"]?></td>
            <td colspan = "4" style = "font-weight: bold;"><br><?php echo "RM".$row["total"]?></td>
            <th scope="col" colspan = "9" style="white-space: nowrap;"></th>
          </tr>
        <?php
        }
        ?>
    </tbody>
        
      </div>

      <thead class="head">
      <tr>
        <th colspan = "20" scope="col" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

    <thead class="head">
      <tr>
        <th scope="col" style="white-space: nowrap;">Date</th>
        <th scope="col" style="white-space: nowrap;">Day</th>
        <th scope="col" style="white-space: nowrap;">Staff</th>
        <th scope="col" style="white-space: nowrap;">Project</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Time In(NH)</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Time Out(NH)</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Time In(OT)</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Time Out(OT)</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Total(Hours)</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Amount</th>
        <th scope="col" colspan = "2" style="white-space: nowrap;">Actions</th>
      </tr>
    </thead>

    <tbody>
    <?php
$id = $_GET['id'];
$sql = "SELECT * FROM otmeal_details WHERE otclaim_id = '".$id."'";
$result_travel_details = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($result_travel_details) > 0) {
    while ($row_otmeal_details = mysqli_fetch_assoc($result_travel_details)) {
        ?>
        <tr class="table-light">
            <td style="font-weight: bold;"><br><?php echo $row_otmeal_details['date'] ?></td>
            <td style="font-weight: bold;"><br><?php echo $row_otmeal_details["day"] ?></td>
            <td style="font-weight: bold;"><br><?php echo $row_otmeal_details["staff"] ?></td>
            <td style="font-weight: bold;"><br><?php echo $row_otmeal_details["project"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo $row_otmeal_details["time_in_nh"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo $row_otmeal_details["time_out_nh"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo $row_otmeal_details["time_in_ot"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo $row_otmeal_details["time_out_ot"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo $row_otmeal_details["total_ot_hours"] ?></td>
            <td colspan = "2" style="font-weight: bold;"><br><?php echo "RM".$row_otmeal_details["amount"] ?></td>
<?php

// $sql_approval = "SELECT * FROM travel_approval WHERE tclaims_id = '".$id."'";
            // $result_approval = mysqli_query($mysqli, $sql_approval);
            // $hod_approval = null;



            // if (mysqli_num_rows($result_approval) > 0) {
            //     $row_approval = mysqli_fetch_assoc($result_approval);
            //     $hod_approval = $row_approval['hod_status'];
            // }

            $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =".$id);
          $rhod = mysqli_fetch_array($qhod);
          
          $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $firstApproverStatus = $r["approval_status"];

            if ($firstApproverStatus === 'pending') {
                $sql2 = "SELECT COUNT(*) AS num_amounts FROM otmeal_details WHERE otclaim_id = '$id'";
                $result2 = mysqli_query($mysqli, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $numAmounts = $row2['num_amounts'];

                $editUrl = "?page=editTravelling&otmealdetails_id=".$row_otmeal_details['otd_id']."&id=".$id;
                $deleteUrl = "?page=detailsummary4&otmealdetails_id=".$row_otmeal_details['otd_id']."&id=".$id;
                
                echo '<td><br>';
                echo '<a href="'.$editUrl.'" class="link-dark"><i class="fa-solid fa-pen-to-square"></i></a>';
                echo '</td>';

                if ($numAmounts > 1) {
                    echo '<td><br>';
                    echo '<a href="'.$deleteUrl.'" class="link-dark"><i class="fa-solid fa-trash-can"></i></a>';
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
  }
 else {

}
?>

<?php
if (isset($_GET['otmealdetails_id']) && isset($_GET['id'])) {
    $traveldetails_id = $_GET['otmealdetails_id'];
    $tclaims_id = $_GET['id'];

    $sql2 = "DELETE FROM otmeal_details WHERE otd_id = '$traveldetails_id' AND otclaim_id = '$tclaims_id' ";
    mysqli_query($mysqli, $sql2);

    $sql = "SELECT SUM(amount) AS total_amount FROM otmeal_details WHERE otclaim_id = '$tclaims_id'";
    $result = mysqli_query($mysqli, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalAmount = $row['total_amount'];

        $sql3 = "UPDATE otmealclaim SET total = '$totalAmount' WHERE otmeal_id = '$tclaims_id'";
        mysqli_query($mysqli, $sql3);

        if ($totalAmount == 0) {

            $sql5 = "DELETE FROM otmeal_details WHERE otclaim_id = '$tclaims_id'";
            mysqli_query($mysqli, $sql5);

            $sql6 = "DELETE FROM otmealclaim WHERE otmeal_id = '$tclaims_id'";
            mysqli_query($mysqli, $sql6);

            $goto = "?page=otmealsummary";
            $msg = "Deleting <img src='images/loading.gif' />";
            $func->info($msg, $goto);
        } else {
            $goto = "?page=detailsummary4&id=$tclaims_id";
            $msg = "Deleting <img src='images/loading.gif' />";
            $func->info($msg, $goto);
        }
    } else {
      $sql5 = "DELETE FROM otmeal_details WHERE otclaim_id = '$tclaims_id'";
      mysqli_query($mysqli, $sql5);

      $sql6 = "DELETE FROM otmealclaim WHERE otmeal_id = '$tclaims_id'";
      mysqli_query($mysqli, $sql6);

      $goto = "?page=otmealsummary";
      $msg = "Deleting <img src='images/loading.gif' />";
      $func->info($msg, $goto);
    }
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
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th colspan="9" scope="col" style="white-space: nowrap; background-color:white;"></th>
      </tr>
      </thead>

      <thead class="head">
    <tr>
      <th scope="col" colspan="20" style="text-align: center; white-space: nowrap; font-size:20px;">Attachment</th>
    </tr>
  </thead>

    <tbody>
    <?php
$id = $_GET['id'];
$sql = "SELECT * FROM otmeal_details WHERE otclaim_id = '".$id."'";
$result = mysqli_query($mysqli, $sql);
?>

<tr class="table-light">
  <td scope="col" colspan="20" style="text-align: center; white-space: nowrap;">
    <div style="display: flex; justify-content: flex-start;">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        $attachment = $row["attachment"];
      ?>
        <div style="margin-right: 20px;">
          <a href="https://intranet.minconsult.com/sand/minco/sources/E-FORM/<?php echo $attachment; ?>" class="link-dark" target="_blank">
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
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th scope="col" style="white-space: nowrap; background-color:white;"></th>
        <th colspan="20" scope="col" style="white-space: nowrap; background-color:white;"></th>
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
    <table align="center">
      <tr class="tableheader">
        <!-- Header content -->
      </tr>

      <?php
      //change to approval_detail table
       
          $sl = mysqli_query($mysqli,"SELECT * FROM approval_detail WHERE t_claims_id = '".$id."'");
          while($sq = mysqli_fetch_array($sl)){

            if ($sq["approval_level_id"] == 24) {
            //HOD  
              $approval_status = $sq["approval_status"];
            }
            
            elseif ($sq["approval_level_id"] == 25) {
            //PM
              $pm_approval = $sq["approval_status"];
            }
            
            elseif ($sq["approval_level_id"] == 26) {
            //BIL1
              $billing_approval = $sq["approval_status"];
              
            }
            
            elseif ($sq["approval_level_id"] == 27) {
            //BIL2
            
              $billing2_approval =  $sq["approval_status"];
            }
            
            elseif ($sq["approval_level_id"] == 28) {
            //ACC
              $finance_approval = $sq["approval_status"];
            }
            else{
              print "UNKNOWN";
            }

          }
        
      ?>
  <tr>
    <td class="cell-gap" valign="top">HOD Approval : <br><strong><?php echo !empty($approval_status) ? $approval_status : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
    <td class="cell-gap" valign="top">Billing (1) : <br><strong><?php echo !empty($pm_approval) ? $pm_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>   
    <td class="cell-gap" valign="top">Billing (2) Approval : <br><strong><?php echo !empty($billing_approval) ? $billing_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
    <td class="cell-gap" valign="top">Finance Approval : <br><strong><?php echo !empty($billing2_approval) ? $billing2_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
    <td class="cell-gap" valign="top">Payroll Approval : <br><strong><?php echo !empty($finance_approval) ? $finance_approval : "<span style = 'color:red;'>Pending</span>"; ?></strong></td>
  </tr>
    </table>
  </div>
  <br>
  <?php
  if ($approval_status === 'Approved' && $pm_approval === 'Approved' && $billing_approval === 'Approved' && $billing2_approval === 'Approved' && $finance_approval === 'Approved') {
    ?>
    <strong><center>
    <div class="containerpdf">
      Convert to PDF
    </div>
    </strong>
    </center>
    <center>
      <div class="below-containerpdf">
      <a href="?page=generatePDFotmeal&id=<?php echo $id; ?>" class="link-dark">
                <i class="fa-sharp fa-solid fa-file-pdf"></i>
    </a><br><br>
      Click to convert to PDF
        
      </div>
    </center>
    <?php
  
}
  ?>
  </div>
 
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<script>
$(document).ready(function () {  
    var form = $('#printTable'),  
    cache_width = form.width(),  
    a4 = [595.28, 841.89]; // for a4 size paper width and height  

    $('#generate_pdf').on('click', function () {  
        $('body').scrollTop(0);  
        generatePDF();  
    });  
    
    function generatePDF() {  
        getCanvas().then(function (canvas) {  
            var img = canvas.toDataURL("image/png"),  
             doc = new jsPDF({  
                 unit: 'px',  
                 format: 'a4'  
             });  
            doc.addImage(img, 'JPEG', 20, 20);  
            doc.save('TravelForm.pdf');  
            form.width(cache_width);  
        });  
    }  
      
    function getCanvas() {  
        form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
        return html2canvas(form, {  
            imageTimeout: 2000,  
            removeContainer: true  
        });  
    }
});
</script>