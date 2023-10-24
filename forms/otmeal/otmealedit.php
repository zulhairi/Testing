<style>
   body{
   background: url("images/bg.jpg") no-repeat center bottom/cover;
   }
</style>
<?php
   if(isset($_POST["submit"]))
   {

    $name = $_POST["name"];
    $department = $_POST["department"];
    $staffno = $_POST["staff"];
    $total = $_POST['totals'];
    $hod = $_POST["HodApprover"];

     $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$hod."'");
     $ar = mysqli_fetch_array($aq);
     if($ar["imail"]!=""){
       $mto = $ar["imail"];
       $subject = "Email Title Here";

       $message = "Dear ".recap($ar["name"]).",<br /><br />HOD - You Have New OT Meal Allowance Approval Pending

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
         
       }else{
         print "Mail Sent Failed";
       }
     }
   
     mysqli_query($mysqli, "INSERT INTO otmealclaim
                       (
                       name,
                       staffno,
                       department,
                       total
                       )
   
                       VALUES
                       (
                         '".$name."',
                         '".$staffno."',
                         '".$department."',
                         '".$total."'
                        )
     ");

       $OTMealClaimId = mysqli_insert_id($mysqli);
       $dates = $_POST['date'];
       $days = $_POST['day'];
       $staffs = $_POST['person'];
       $projects = $_POST['project'];
       $timeinNHs = $_POST['timeinNH'];
       $timeoutNHs = $_POST['timeoutNH'];
       $timeinOTs = $_POST['timeinOver'];
       $timeoutOTs = $_POST['timeoutOver'];
       $totalOTs = $_POST['totalOT'];
       $amounts = $_POST['amount'];
      
       $targetDir = "forms/otmeal/uploads/";
       $attachments = array();
   
   for ($i = 0; $i < count($projects); $i++) {
   $target_file = $targetDir . basename($_FILES["attachment"]["name"][$i]);
   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   
   if (move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $target_file)) {
     $attachments[$i] = $target_file;
   }
   }
   
       for ($i = 0; $i < count($projects); $i++) {
         $date = $dates[$i];
         $day = $days[$i];
         $staff = $staffs[$i];
         $project = $projects[$i];
         $timeinNH = $timeinNHs[$i];
         $timeoutNH = $timeoutNHs[$i];
         $timeinOT = $timeinOTs[$i];
         $timeoutOT = $timeoutOTs[$i];
         $totalOT = $totalOTs[$i];
         $amount = $amounts[$i];
         $attachment = $attachments[$i];
   
         mysqli_query($mysqli,"INSERT INTO otmeal_details 
                   (otclaim_id,
                   date,
                   day,
                   staff,
                   project,
                   time_in_nh,
                   time_out_nh,
                   time_in_ot,
                   time_out_ot,
                   total_ot_hours,
                   amount,
                   attachment
                 ) 
                   VALUES 
                   (
                     '".$OTMealClaimId."',
                   '".$date."',
                   '".$day."',
                   '".$staff."',
                   '".$project."',
                   '".$timeinNH."',
                   '".$timeoutNH."',
                   '".$timeinOT."',
                   '".$timeoutOT."',
                   '".$totalOT."',
                   '".$amount."',
                   '".$attachment."'
                   )
                   ");

                   if(mysqli_errno($mysqli)) {
                    die("Database query failed: " . mysqli_error($mysqli));
                }
               
       }
      
       $hod_id = 24;

        $hq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $hod_id");
        $hq = mysqli_fetch_array($hq);
        $hPriority = $hq["approval_priority"];

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
          '".$OTMealClaimId."',
          '".$hod."', 
          'pending',
          '',
          '".date("Y-m-d")."'
        )");

        // mail
        //check sent to who first time
          $form = 4;
         
          $q = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE form_categories = $form AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
          $r = mysqli_fetch_array($q);
          $id = $r["approval_priority"];

          $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $entertainmentClaimId AND approval_priority = $id");
          $dql8 = mysqli_fetch_array($sql8);
          $staffno = $dql8['staffno'];  

        //send mail firstime

          $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$staffno."'");
          $ar = mysqli_fetch_array($aq);
          if($ar["imail"]!=""){
            $mto = $ar["imail"];
            $subject = "Email Title Here ".$app_id;

            $message = "Dear ".recap($ar["name"]).",<br /><br />HOD - You Have New OT Meal Allowance Approval Pending

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
   
         $goto = "?page=otmealsummary";
         $msg = "";
         $func	-> info($msg,$goto);
        
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <link rel="stylesheet" href="/resources/demos/style.css">
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

    <div class="form-container">
      <h2>MINCONSULT SDN BHD</h2>
      <h3>
         <strong>
            <center>Overtime Meal Allowance</center>
         </strong>
      </h3>
      <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
      <br />
        
        <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
              <div class="form-row" style = "width: 101%;">
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
                </div>
                <div class="form-group">
                  <label for="staff">Staff No:</label>
                  <input type="text" id="staff" name="staff" value="<?php echo $staffno;?>" readonly="readonly" />
                </div>
                <div class="form-group">
                  <label for="department">Department:</label>
                  <input type="text" id="department" name="department" value="<?php echo $division; ?>" readonly="readonly">
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
                  </div>
              </div> 
              <div class="form-row" style = "width: 101%;">
              </div>
                <div class = "full-blue"></div>
              <br>
            <div class="form-group">
                <div class="cloned-container" id="cloned-container">
                    <div class="cloned" id="cloned">
                      <div class="form-number2"></div>
                      <div class="form-row">
                          <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" id="date" name="date[]"  required />
                          </div>
                          <div class="form-group">
                            <label for="day">Day:</label>
                            <input type="text" id="day" name="day[]" required>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group">
                            <label for="person">Claim For(Staff Name):</label>
                            <input type = "text" id="person" name="person[]" required>
                          </div>
                          <div class="form-group">
                    <label for="project">Project & Job Number:</label>
                    <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project[]" rows="3" required />
                </div>
                      </div>
                      <h2>Overtime (O/T) Expended</h2>
                      <div class="form-row">
                          <div class="form-group">
                            <label for="timeInNH">Time In (Normal Hours)</label>
                            <input type="time" id="timeinNH" name="timeinNH[]"  required />
                          </div>
                          <div class="form-group">
                            <label for="day">Time Out (Normal Hours):</label>
                            <input type="time" class="time-input1" id="timeoutNH_1" name="timeoutNH[]" data-index="1" required>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group">
                            <label for="timeInOT">Time In (Overtime):</label>
                            <input type = "time" id="timeinOver" name="timeinOver[]" required>
                          </div>
                          <div class="form-group">
                            <label for="day">Time Out (Overtime):</label>
                            <input type="time" class="time-input2" id="timeoutOver_1" name="timeoutOver[]" data-index="2" required>
                          </div>
                      </div>
                      <div class = "full-blue"></div>
                      <br>
                      <div class="form-row">
                      <div class="form-group">
                            <label for="totalOT">Total O/T (Hours):</label>
                            <input type="number" class="totalOT" id="totalOT_1" name="totalOT[]" step="0.01" readonly>
                          </div>
                          <div class="form-group">
                            <label for="amount">Amount (RM):</label>
                            <input type="number" class="amount" id="amount" max = "10" min = "1" name="amount[]" step="0.01"  />
                          </div>
                      </div>
                      <br>
                      <div class="form-group">
                          <label>
                          <input type="checkbox" name="verification" required>
                          I hereby certify that all information above is correct
                          </label>
                      </div>
                      <br>
                      <label for="supporting-attachment">Include a supporting attachment:</label>
                      <input type="file" id="attachment" accept=".pdf" name="attachment[]">
                      <small>Only PDF files are allowed.</small>
                      <hr />
                    </div>
                </div>
            </div> 
          </div> 
          <div id="form-buttons-container">
                <div class="form-buttons">
                  <button type="submit"  name="submit">Submit</button>
          </div>
        </form>
   </body>
</html>
<script>
$(document).ready(function() {

  $(document).on("change", "#timeoutNH_1, #timeoutOver_1", function() {
    var currentSection = $(this).closest('.cloned');
    var timeoutNH_1 = currentSection.find('#timeoutNH_1').val();
    var timeoutOver_1 = currentSection.find('#timeoutOver_1').val();
    var totalOT_1 = currentSection.find('#totalOT_1');

    if (timeoutNH_1 && timeoutOver_1) {
        // Both values are present, proceed with calculations
        console.log(timeoutNH_1, timeoutOver_1);

        const timeoutNH = new Date(`1970-01-01T${timeoutNH_1}`);
        const timeoutOver = new Date(`1970-01-01T${timeoutOver_1}`);

        if (!isNaN(timeoutNH) && !isNaN(timeoutOver)) {
            // Perform calculations here
            const totalOTHours = (timeoutOver - timeoutNH) / (1000 * 60 * 60);
            console.log("Total OT Hours:", totalOTHours);

            const roundedTotalOTHours = Math.floor(totalOTHours * 4) / 4;
            totalOT_1.val(roundedTotalOTHours.toFixed(2));
        }
    }
  });

 

  // Validation function for total O/T hours
  function validateTotalOT(totalOTValue) {
    if (totalOTValue < 2.50) {
      // Disable the submit button if total OT hours are less than 2.50
      $("button[name='submit']").prop("disabled", true);
    } else {
      $("button[name='submit']").prop("disabled", false);
    }
  }
  
});

   function updateTotalAmount() {
     const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
     let totalAmount = 0;
     clonedContainers.forEach((cloned) => {
       const amount = parseFloat(cloned.querySelector('.amount').value);
       totalAmount += isNaN(amount) ? 0 : amount;
     });
   
     document.getElementById('totals').value = totalAmount.toFixed(2);
   }
   
   const fileInput = document.getElementById('attachment');
   
     fileInput.addEventListener('change', () => {
       const file = fileInput.files[0];
       const fileType = file.type;
   
       if (fileType !== 'application/pdf') {
         fileInput.setCustomValidity('Only PDF files are allowed.');
       } else {
         fileInput.setCustomValidity('');
       }
     });
   
     var count = 1;
   
     $(document).ready(function() {
   
       function removeSection(element) {
         if (count > 1) {
           $(element).remove();
           count--;
           updateTotalAmount();
         }
       }
   
       function updateRemoveBtnStatus() {
         if (count > 1) {
           $('.remove-travel-btn').prop('disabled', false);
         } else {
           $('.remove-travel-btn').prop('disabled', true);
         }
       }
   
       function removeLastClonedSection() {
         if (count > 1) {
           $('#cloned-container').find('.cloned').last().remove();
           count--;
           updateTotalAmount();
           updateRemoveBtnStatus();
         }
       }
   
       $(".add-travel-btn").click(function() {
         var clonedSection = cloneSection();
         $('#cloned-container').append(clonedSection);
         count++;
       });
           
       $(".remove-travel-btn").click(function() {
         var lastClonedSection = $('#cloned-container').find('.cloned').last();
         removeSection(lastClonedSection);  
       });      
   
       $('form[name="borang"]').submit(function(e) {
         var totalForms = $('[id^="cloned"]').length;
   
         $('<input>').attr({
           type: 'hidden',
           name: 'count',
           value: count
         }).appendTo($(this));
   
         $('<input>').attr({
           type: 'hidden',
           name: 'totalForms',
           value: totalForms
         }).appendTo($(this));
       });
   
     });
   
      document.addEventListener("DOMContentLoaded", function () {
       const addTravelBtn = document.querySelector(".add-travel-btn");
       const removeTravelBtn = document.querySelector(".remove-travel-btn");
       const formContainer = document.querySelector("#travelling-form");
       const totalAmountDisplay = document.querySelector("#totals");
   
       removeTravelBtn.addEventListener("click", function () {
         if (formContainer.children.length > 2) {
           formContainer.removeChild(formContainer.lastElementChild);
         }
         updateTotalAmount(); 
       });
   
       formContainer.addEventListener("input", updateTotalAmount); 
   
       function removeTravel(event) {
         const button = event.target;
         const clonedContainer = button.closest('.cloned-container');
         const clonedContainers = document.querySelectorAll('.cloned-container');
   
         if (clonedContainers.length > 1) {
           clonedContainer.remove();
           updateTotalAmount();
         }
       }
   
   function updateTotalAmount() {
         const amounts = document.querySelectorAll("input[name='amount[]']");
         let totalAmount = 0;
   
         amounts.forEach(function (amountInput) {
           const amountValue = parseFloat(amountInput.value);
           if (!isNaN(amountValue)) {
             totalAmount += amountValue;
           }
         });
   
         totalAmountDisplay.textContent = totalAmount;
         totals.value = totalAmount;
       }
   
        
     });
   
     function validateInput() {
       var input = document.getElementById('project');
       input.value = input.value.replace(/\s/g, '');     
     }
   
     $(function() {
       $("#projectManager").autocomplete({
         source: "?page=server2"
       });
   
       $("#project").autocomplete({
         source: "?page=server3"
       });
     });
   
     function cloneSection() {
         var clonedSection = $('#cloned').clone().prop('id', 'cloned' + count);
         clonedSection.find('.form-number2').text('Item ' + (count + 1));
   
         var displaySpecify = clonedSection.find('.display-specify');
         displaySpecify.prop('id', 'display-specify' + count).hide();

         var timeinNH = clonedSection.find('.timeinNH');
         timeinNH.prop('id', 'timeinNH' + count);

         var timeoutNH_1 = clonedSection.find('.timeoutNH_1');
         timeoutNH_1.prop('id', 'timeoutNH_1' + count);
         
         var timeinOver = clonedSection.find('.timeinOver');
         timeinOver.prop('id', 'timeinOver' + count);

         var timeoutOver_1 = clonedSection.find('.timeoutOver_1');
         timeoutOver_1.prop('id', 'timeoutOver_1' + count);

         var totalOT_1 = clonedSection.find('.totalOT_1');
         totalOT_1.prop('id', 'totalOT_1' + count);

         clonedSection.find('.amount').val('');
   
         $("button[name='submit']").click(function(event) {
        if (totalOTValue < 2.50) {
          event.preventDefault(); // Prevent form submission
          alert("Total O/T hours must be 2.50 or more");
        }
      });

      return clonedSection;
     
     }
   
</script>
