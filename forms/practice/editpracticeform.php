
<style>
  body{

background: url("images/bg.jpg") no-repeat center bottom/cover;
}

.reason{
  height: 200px;
  border-style: solid;
  border-color: #3a7bd5;
  border-radius: 20px;
  padding-top: 10px;
}

.text{
  padding-left:10px;

}
  </style>
<?php

if(isset($_POST["submit"]))
{
    $advanceClaimId = mysqli_insert_id($mysqli);


    $auq = mysqli_query($mysqli,"SELECT * FROM claim_details WHERE id_claims=".$_GET["id"]);
    $aur = mysqli_fetch_array($auq);

    $attachment = $aur["attachment"];
    
    if ($_FILES["attachment"]["name"]) {
      $targetDir = "forms/practice/uploads/";
      $target_file = $targetDir . basename($_FILES["attachment"]["name"]);
      $uploadOK = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
          $attachment = $target_file; // Update attachment if new file is uploaded
      }
  }

    $reimbursable = ($_POST["reimbursable"] == 1) ? "Yes" : "No";

    $sql = "UPDATE test_details SET advance_required = '".$_POST["advancerequired"]."', when_required = '".$_POST["advanceDate"]."', project_code = '".$_POST["project"]."', nature = '".$_POST["nature"]."', purpose = '".$_POST["purpose"]."', previous_advances = '".$_POST["previousAdvance"]."', reimbursable = '".$reimbursable."', attachment = '".$attachment."' WHERE aclaims_id = '".$_GET['id']."'";

    if (mysqli_query($mysqli, $sql)) {
        $sql2 = "UPDATE advance_approval SET hod_staff_no = '".$_POST["HodApprover"]."', hod_update = '2022-04-22 10:34:23', hod_status = 'Pending', hod_remarks = 'Test', billing_staff_no = '6798', billing_update = '2022-04-22 10:34:23', billing_status = 'Pending', billing_remarks = 'Test', billing2_staff_no = '6798', billing2_update = '2022-04-22 10:34:23', billing2_status = 'Pending', billing2_remarks = 'Test', finance_staff_no = '6798', finance_update = '2022-04-22 10:34:23', finance_status = 'Pending', finance_remarks = 'Test', ceo_staff_no = '6798', ceo_update = '2022-04-22 10:34:23', ceo_status = 'Pending', ceo_remarks = 'Test', account_staff_no = '6798', account_update = '2022-04-22 10:34:23', account_status = 'Pending', account_remarks = 'Test' WHERE aclaims_id = '".$_GET['id']."'";

        if (mysqli_query($mysqli, $sql2)) {
            $goto = "?page=practicesummary";
            $msg = "";
            $func->info($msg, $goto);
        } else {
            if(mysqli_errno($mysqli)) {
                die("Database query failed: " . mysqli_error($mysqli));
            } else {
            }
        }
    } else {
        if(mysqli_errno($mysqli)) {
            die("Database query failed: " . mysqli_error($mysqli));
        } else {
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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

      
    </ul>
  </div>
  <a href="?page=practicesummary" class="logout-link" style = "background-color:#555; color:white;">
  <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
  Go Back</a>
</div>

<div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3><strong><center>Application for Advance</center></strong></h3>
    <form id="advance-form" action="" method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group">
      <?php
$q = mysqli_query($mysqli,"SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
$r = mysqli_fetch_array($q);

$auq = mysqli_query($mysqli,"SELECT * FROM advance_details WHERE aclaims_id=".$_GET["id"]);
$aur = mysqli_fetch_array($auq);

$sq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno = '".$ses_staffno."'");
$sr = mysqli_fetch_array($sq);
?>
        
      <?php
      $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '".$ses_staffno."'");
      while ($dr = mysqli_fetch_array($dq)) {
          $name = $dr["name"];
          $staffno = $dr["staffno"];
          $designationId = $dr["desig"];
          $designation = '';
          $divisionCode = $dr["div_code"];
          $division = '';

          $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '".$designationId."'");
          while ($dr2 = mysqli_fetch_array($dq2))
          {
          $designation = $dr2["desg_name"];
          
          }

          $dq3 = mysqli_query($mysqli, "SELECT * FROM hr_division WHERE div_code = '".$divisionCode."'");
          while ($dr3 = mysqli_fetch_array($dq3))
          {
          $division = $dr3["div_name"];
          }

      }
      ?>
      <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php
        $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '".$r['staffno']."'");
        while ($dr = mysqli_fetch_array($dq)) {
          $name = $dr["name"];
        }
         echo $name; 
         ?>" 
         readonly="readonly">
        <div>
        </div>
      </div> 
      <div class="form-group">
        <label for="staff">Staff No:</label>
        <input type="text" id="staff" name="staff" value="<?php echo $r['staffno']; ?>" readonly="readonly">
      </div>
    
      <div class="form-group">
      <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo $r['department']; ?>" readonly="readonly">
        <div>
        </div>
      </div> 

    <!-- <div class="form-row">
      <div class="form-group">
      <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo $r['designation']; ?>" readonly="readonly">
        <div>
        </div>  -->
      <!-- </div> 
      <div class="form-group">
        <label for="appointment">Date of Appointment:</label>
        <input type="date" id="appointment" name="appointment" value="<?php echo $r['date_appointment']; ?>" required>
      </div>
    </div> -->

    <br>
    <div class = "full-blue"></div>
  <br>
        <div class="form-row">

      </div>
      <div class="form-group">
            <label for="reimbursable-by-client">Reimbursable By Client:</label>
             <label for="reimbursable-yes" style="display: inline-block;">
             Yes
             <input type="checkbox" id="reimbursable-yes" name="reimbursable" value=1 class="boxy-checkbox" onclick="uncheckOther(this)"   />
             </label>
             <label for="reimbursable-no" style="display: inline-block;">
             No
             <input type="checkbox" id="reimbursable-no" name="reimbursable" value=2 class="boxy-checkbox" onclick="uncheckOther(this)"  />
         </label>
      </div>

      <div class="form-group">
        <label for="amount">Amount (RM):</label>
        <input type="number" id="amount" name="previousAdvance" value="<?php echo $aur['previous_advances']; ?>" required>
        
    </div>
    </div>


    <div class="form-group">
        <label for="place">Purpose of Advance:</label>
        <textarea id="purpose" name="purpose" rows="3" required><?php echo $aur['purpose']; ?></textarea>
      </div>

      <div class="form-group">
         <label for="HodApprover">HOD Approver:</label>
        <select id ="HodApprover" name = "HodApprover" hidden>
            <option value="">Please select</option>
            <?php

             $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
             $result = mysqli_query($mysqli, $sql);
             while ($row = mysqli_fetch_array($result)) {
               $HOD_Name = $row["name"];
               $HOD_staffno = $row["staffno"];
               $selected = ($ur['staffno'] === $HOD_staffno) ? 'selected' : '';
               echo "<option value='" . $HOD_staffno . "' " . $selected . ">" . '(' . "" . $HOD_staffno . "" . ')' . "  " . $HOD_Name . " </option>";
             }
            
            ?> 
        </select>
        <div>
      </div>
      <br>

<div class="form-group">
  <?php if ($aur["attachment"]) { ?>
    <span>Previous attachment : <a href="https://intranet.minconsult.com/sand/minco/sources/E-FORM/<?php echo $aur["attachment"]; ?>" style = "color: white; background-color: #3a7bd5;; border-radius: 10px; padding: 5px;" target="_blank">Click here</a></span><br>
  <?php } ?>
  <br>
  <label for="attachment">New attachment (If needed):</label>
  <input type="file" id="attachment" accept=".pdf" name="attachment">
  <small>Only PDF files are allowed.</small>
</div>
    <hr>
    <div class="form-buttons">
        <button type="submit" name="submit" id="submit">Submit</button>
      </div><br>

      <?php
      if ($ur['hod_status'] === 'Declined' || $ur['billing_status'] === 'Declined' || $ur['billing2_status'] === 'Declined' || $ur['finance_status'] === 'Declined' || $ur['ceo_status'] === 'Declined' || $ur['account_status'] === 'Declined')
      {
      ?>
      <div class = "reason">
      <center><h3><strong>Declination reason :</strong></h3></center>
      <div class = "text">
      <?php
if ($ur['hod_status'] === "Declined") {
    echo "HOD's Remarks :";
    echo "<br>";
    echo $ur['hod_remarks'];
} else if ($ur['billing_status'] === "Declined") {
    echo "Billing's Remarks :";
    echo "<br>";
    echo $ur['billing_remarks'];
} else if ($ur['billing2_status'] === "Declined") {
    echo "Billing 2's Remarks :";
    echo "<br>";
    echo $ur['billing2_remarks'];
} else if ($ur['finance_status'] === "Declined") {
    echo "Finance's Remarks :";
    echo "<br>";
    echo $ur['finance_remarks'];
} else if ($ur['ceo_status'] === "Declined") {
    echo "CEO's Remarks :";
    echo "<br>";
    echo $ur['ceo_remarks'];
} else if ($ur['account_status'] === "Declined") {
    echo "Account's Remarks :";
    echo "<br>";
    echo $ur['account_remarks'];
}

      }
?>
      </div>


    </div>
      </form>
  </div>

  
  <script src="script.js"></script>
</body>
</html>
<script>
  $(function() {
      $("#project").autocomplete({
        source: "?page=server3advance"
      });
    })
  </script>
