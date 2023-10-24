<style>
  body {

    background: url("images/bg.jpg") no-repeat center bottom/cover;
  }
</style>
<?php

if (isset($_POST["submit"])) {
  $form = 3;
  mysqli_query($mysqli, "INSERT INTO advanceclaim 
								(staffno,
							  designation,
								date_appointment,
								department,
                form_category
                ) 
								VALUES 
								('" . $_POST["staff"] . "',
								'" . $_POST["designation"] . "',
								'" . $_POST["appointment"] . "',
								'" . $_POST["department"] . "',
                " . $form . "
								)
                
                ");

  $advanceClaimId = mysqli_insert_id($mysqli);

  $targetDir = "forms/advance/uploads/ " . $ses_staffno . "/";
  mkdir($targetDir, 0770);
  $secondnameCounter = 1;

  
  $target_file = $targetDir . basename($_FILES["attachment"]["name"]);
  $uploadOK = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {

    $attachment = $target_file;

    $firstname = $_POST["staff"];
    $thirdname = date("his");
    $newname = $targetDir . $firstname . "_" . $secondnameCounter . "_" . $thirdname . ".pdf";
    $counter = 0;

    if (rename($target_file, $newname)) {
      $attachment = $newname;
    }

    $secondnameCounter++;


  }

  $reimbursable = ($_POST["reimbursable"] == 1) ? "Yes" : "No";

  mysqli_query($mysqli, "INSERT INTO advance_details 
								(aclaims_id,
							  advance_required,
								when_required,
								project_code,
                nature,
                purpose,
                previous_advances,
                approved_advance,
                reimbursable,
                attachment
                ) 
								VALUES 
								(
                  '" . $advanceClaimId . "',
                '" . $_POST["advancerequired"] . "',
								'" . $_POST["advanceDate"] . "',
								'" . $_POST["project"] . "',
								'" . $_POST["nature"] . "',
                '" . $_POST["purpose"] . "',
                '" . $_POST["previousAdvance"] . "',
                '0',
                '" . $reimbursable . "',
                '" . $attachment . "'
								)
                
        ");

  if (mysqli_query($mysqli, $insertQuery)) {
    echo "Data inserted successfully!";
  } else {
    // echo "Error: " . mysqli_error($mysqli);
  }

  $hod_id = 21; //UNIQUE CASE OPPOSITE ID
  $pm_id = 15;

  $hq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $hod_id");
  $hq = mysqli_fetch_array($hq);
  $hPriority = $hq["approval_priority"];

  $pq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $pm_id");
  $rq = mysqli_fetch_array($pq);
  $pPriority = $rq["approval_priority"];

  mysqli_query($mysqli, "INSERT INTO approval_detail
        (
        approval_level_id,
        approval_priority,
        t_claims_id,
        staffno,
        approval_status,
        approval_remarks,
        approval_approved_date,
        form_category
        )
        
        VALUES
        (
          '" . $hod_id . "',
          '" . $hPriority . "',
          '" . $advanceClaimId . "',
          '" . $_POST["HodApprover"] . "', 
          'pending',
          '',
          '" . date("Y-m-d") . "',
          " . $form . "
        )");

  if (mysqli_query($mysqli, $insertQuery)) {
    echo "Data inserted successfully!";
  } else {
    // echo "Error: " . mysqli_error($mysqli);
  }

  mysqli_query($mysqli, "INSERT INTO approval_detail
        (
        approval_level_id,
        approval_priority,
        t_claims_id,
        staffno,
        approval_status,
        approval_remarks,
        approval_approved_date,
        form_category
        )

        VALUES
        (
        '" . $pm_id . "',
        '" . $pPriority . "',
          '" . $advanceClaimId . "',
          '" . $_POST["projectManager"] . "', 
          'pending',
          '',
          '" . date("Y-m-d") . "',
          " . $form . "
          )");

  if (mysqli_query($mysqli, $insertQuery)) {
    echo "Data inserted successfully!";
  } else {
    // echo "Error: " . mysqli_error($mysqli);
  }


  // mail
  //check sent to who first time
  $form = 3;

  $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
  $r = mysqli_fetch_array($q);
  $id = $r["approval_priority"];

  $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $advanceClaimId AND approval_priority = $id");
  $dql8 = mysqli_fetch_array($sql8);
  $staffno = $dql8['staffno'];

  //send mail firstime

  $aq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE staffno='" . $staffno . "'");
  $ar = mysqli_fetch_array($aq);
  if ($ar["imail"] != "") {
    $mto = $ar["imail"];
    $subject = "Advance Form - Request " . $app_id;

    $message = "Dear " . recap($ar["name"]) . ",<br /><br />HOD - You Have New Advance Approval Pending

            Please Click <a href='https://intranet.minconsult.com/sources/E-FORM/?page=hodapprovaladvance'>Here</a> To View And Verify
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
      // print "Mailed Sent ".$mto;
    } else {
      // print "Mail Sent Failed";
    }
  }

  $goto = "?page=advancesummary";
  $msg = "";
  $func->info($msg, $goto);

}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <a href="?page=idx" class="logout-link" style="background-color:#555; color:white;">
      <img src="images/logout.png" alt="Exam"
        style="display:inline-block; vertical-align:middle; width:30px; height:30px;">
      Back</a>
  </div>

  <div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3><strong>
        <center>Application for Advance</center>
      </strong></h3>
    <form id="advance-form" action="" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group">

          <?php
          $dq = mysqli_query($mysqli, "SELECT * FROM hr_employee WHERE status = 1 AND staffno = '" . $ses_staffno . "'");
          while ($dr = mysqli_fetch_array($dq)) {
            $name = $dr["name"];
            $staffno = $dr["staffno"];
            $designationId = $dr["desig"];
            $designation = '';
            $divisionCode = $dr["div_code"];
            $division = '';

            $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '" . $designationId . "'");
            while ($dr2 = mysqli_fetch_array($dq2)) {
              $designation = $dr2["desg_name"];

            }

            $dq3 = mysqli_query($mysqli, "SELECT * FROM hr_division WHERE div_code = '" . $divisionCode . "'");
            while ($dr3 = mysqli_fetch_array($dq3)) {
              $division = $dr3["div_name"];
            }

          }
          ?>

          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly="readonly">
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="staff">Staff No:</label>
          <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" readonly="readonly">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="designation">Designation:</label>
          <input type="text" id="designation" name="designation" value="<?php echo $designation; ?>"
            readonly="readonly">
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="appointment">Date of Appointment:</label>
          <input type="date" id="appointment" name="appointment" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="department">Department:</label>
          <input type="text" id="department" name="department" value="<?php echo $division; ?>" readonly="readonly">
          <div>
          </div>
        </div>

      </div>
      <br>
      <div class="full-blue"></div>
      <br>
      <div class="form-row">
        <div class="form-group">
          <label for="advancerequired">Advance Required:</label>
          <input type="number" step="any" id="advancerequired" name="advancerequired" required>
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="advanceDate">When Required:</label>
          <input type="date" id="advanceDate" name="advanceDate" value="<?php echo date('Y-m-d'); ?>"
            min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>"
            required>
        </div>
      </div>

      <div class="form-group">
        <label for="place">Project Code:</label>
        <input type="text" id="project" name="project" required>
      </div>

      <div class="form-group">
        <label for="projectManager">Project Manager:</label>
        <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager" rows="3"
          required />
      </div>

      <div class="form-group">
        <label for="place">Nature of Works:</label>
        <textarea id="nature" name="nature" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="place">Purpose of Advance:</label>
        <textarea id="purpose" name="purpose" rows="3" required></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="previousAdvance">Previous Advances In Hand (RM):</label>
          <input type="number" step="any" id="previousAdvance" name="previousAdvance" required>
          <div>
          </div>
        </div>
        <div class="form-group">
          <label for="reimbursable">Reimbursable or not:</label>
          <select id="reimbursable" name="reimbursable" required>
            <option value="0">Please select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </div>
        <div class="form-group">
          <label for="HodApprover">HOD Approver:</label>
          <select id="HodApprover" name="HodApprover" required>
            <option value="">Please select</option>

            <?php

            $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($result)) {
              $HOD_Name = $row["name"];
              $HOD_staffno = $row["staffno"];
              echo "<option value='" . $HOD_staffno . "'>" . '(' . "" . $HOD_staffno . "" . ')' . "  " . $HOD_Name . " </option>";
            }

            ?>
          </select>
          <div>
          </div>
          <br>
          <div class="form-group">
            <label>
              <input type="checkbox" name="verification" required>
              I hereby certify that all information above is correct
            </label>
          </div>
          <br>
          <div class="form-group">
            <label for="attachment">Supporting attachment:</label>
            <input type="file" id="attachment" accept=".pdf" name="attachment">
            <small>Only PDF files are allowed.</small>
          </div>
          <hr>
          <div class="form-buttons">
            <button type="submit" name="submit" id="submit">Submit</button>
          </div>
    </form>
  </div>
  <script src="script.js"></script>
</body>

</html>

<script>
  $(function () {
    $("#project").autocomplete({
      source: "?page=server3advance"
    });
  })

  $(function () {
    $("#projectManager").autocomplete({
      source: "?page=server2"
    });
  })

</script>
<script>
  // Get the input elements
  var monthInput = document.getElementById('appointment');
  var dateInput = document.getElementById('advanceDate');

  // Listen for the 'input' event on the 'month' field
  monthInput.addEventListener('input', function () {
    // Get the value from the 'month' field
    var selectedMonth = new Date(monthInput.value);

    // Calculate the minimum allowed date for 'date' field (2 months before the 'month' field)
    var minAllowedDate = new Date(selectedMonth);
    minAllowedDate.setDate(1); // Set the date to the 1st of the month
    minAllowedDate.setMonth(selectedMonth.getMonth() - 2); // Subtract 2 months

    // Set the 'min' and 'max' attributes for the 'date' field
    dateInput.min = minAllowedDate.toISOString().slice(0, 10);
    dateInput.max = selectedMonth.toISOString().slice(0, 10);

    // If the selected date in 'date' field is beyond the allowed range, reset it to the minimum allowed date
    if (new Date(dateInput.value) < minAllowedDate || new Date(dateInput.value) > selectedMonth) {
      dateInput.value = minAllowedDate.toISOString().slice(0, 10);
    }
  });
</script>