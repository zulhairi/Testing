
<style>
  body{

background: url("images/bg.jpg") no-repeat center bottom/cover;
}
  </style>
<?php

if(isset($_POST["submit"]))
{

  $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$_POST["HodApprover"]."'");
  $ar = mysqli_fetch_array($aq);
  if($ar["imail"]!=""){
    $mto = $ar["imail"];
    $subject = "Email Title Here";

    $message = "Dear ".recap($ar["name"]).",<br /><br />HOD - You Have New Travelling Approval Pending

    Please Click <a href='https://intranet.minconsult.com/sand/minco/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
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
      print "Mailed Sent";
    }else{
      print "Mail Sent Failed";
    }
  }

  mysqli_query($mysqli,"INSERT INTO advanceclaim 
								(staffno,
							  designation,
								date_appointment,
								department
                ) 
								VALUES 
								('".$_POST["staff"]."',
								'".$_POST["designation"]."',
								'".$_POST["appointment"]."',
								'".$_POST["department"]."'
								)
                
                ");

                $advanceClaimId = mysqli_insert_id($mysqli);

                $targetDir = "forms/advance/uploads/"; 
                $target_file = $targetDir . basename($_FILES ["attachment"]["name"]);
                $uploadOK = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file))
                {
                  $attachment = $target_file;
                }

                $reimbursable = ($_POST["reimbursable"] == 1) ? "Yes" : "No";

                mysqli_query($mysqli,"INSERT INTO advance_details 
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
                  '".$advanceClaimId."',
                '".$_POST["advancerequired"]."',
								'".$_POST["advanceDate"]."',
								'".$_POST["project"]."',
								'".$_POST["nature"]."',
                '".$_POST["purpose"]."',
                '".$_POST["previousAdvance"]."',
                '0',
                '".$reimbursable."',
                '".$attachment."'
								)
                
                ");

        $hod_id = 15;
        $pm_id = 21;

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
        approval_approved_date
        )
        
        VALUES
        (
          '".$hod_id."',
          '".$hPriority."',
          '".$advanceClaimId."',
          '".$_POST["HodApprover"]."', 
          'pending',
          '',
          '".date("Y-m-d")."'
        )");

        mysqli_query($mysqli, "INSERT INTO approval_detail
        (
        approval_level_id,
        approval_priority,
        t_claims_id,
        staffno,
        approval_status,
        approval_remarks,
        approval_approved_date
        )

        VALUES
        (
        '".$pm_id."',
        '".$pPriority."',
          '".$advanceClaimId."',
          '".$_POST["projectManager"]."', 
          'pending',
          '',
          '".date("Y-m-d")."'
          )");


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

          $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staffno."'");
          $ar = mysqli_fetch_array($aq);
          if($ar["imail"]!=""){
            $mto = $ar["imail"];
            $subject = "Email Title Here ".$app_id;

            $message = "Dear ".recap($ar["name"]).",<br /><br />HOD - You Have New Advance Approval Pending

            Please Click <a href='https://intranet.minconsult.com/sand/minco/sources/E-FORM/?page=travelForm'>Here</a> To View And Verify
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
   
         $goto = "?page=advancesummary";
         $msg = "";
         $func	-> info($msg,$goto);

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
    <a class="active" href="?page=advance">Advance Form</a>
    <ul>
      
      <li>
        <a href="?page=advancesummary">Requested Advance</a>
      </li>

      <?php
      include "layouts/sidebarapprove.php";
      echo "Testing";
      ?>
 
    </ul>
  </div>
  <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
  <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
  Logout</a>
</div>

<div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3><strong><center>Application for Advance</center></strong></h3>
    <form id="advance-form" action="" method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group">
        
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
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly="readonly">
        <div>
        </div>
      </div> 
      <div class="form-group">
        <label for="staff">Staff No:</label>
        <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" readonly="readonly">
      </div>
      <div class="form-group">
        <label for="staff">Staff No:</label>
        <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" readonly="readonly">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
      <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo $designation; ?>" readonly="readonly">
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
    <div class = "full-blue"></div>
  <br>
        <div class="form-row">
      <div class="form-group">
        <label for="advancerequired">Advance Required:</label>
        <input type="number" id="advancerequired" name="advancerequired" required>
        <div>
        </div>
    </div>
    <div class="form-group">
        <label for="advanceDate">When Required:</label>
        <input type="date" id="advanceDate" name="advanceDate" required>
      </div>
      </div>

      <div class="form-group">
        <label for="place">Project Code:</label>
        <input type = "text" id="project" name="project" required>
      </div>

      <div class="form-group">
                      <label for="projectManager">Project Manager:</label>
                      <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager" rows="3" required />
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
        <input type="number" id="previousAdvance" name="previousAdvance" required>
        <div>
        </div>
    </div>
    <div class="form-group">
        <label for="reimbursable">Reimbursable or not:</label>
        <select id ="reimbursable" name = "reimbursable" required>
            <option value="0">Please select</option>
          <option value="1">Yes</option>
          <option value="2">No</option>
        </select>
      </div>
      <div class="form-group">
        <label for="HodApprover">HOD Approver:</label>
        <select id ="HodApprover" name = "HodApprover" required>
            <option value="">Please select</option>

            <?php

            $sql = "SELECT * FROM `hr_employee` WHERE `status` = 1 AND `intra_level` = 2 ORDER BY `div_code` DESC";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($result))
            {
              $HOD_Name = $row["name"];
              $HOD_staffno = $row["staffno"];
              echo "<option value='". $HOD_staffno ."'>".'('."".$HOD_staffno."".')'."  " . $HOD_Name . " </option>";
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
  $(function() {
      $("#project").autocomplete({
        source: "?page=server3advance"
      });
    })

    $(function() {
      $("#projectManager").autocomplete({
        source: "?page=server2"
      });
    })
  </script>
