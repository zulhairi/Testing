<style>
    body{

  background: url("images/bg.jpg") no-repeat center bottom/cover;
  }
</style>
  <?php

  if(isset($_POST["submit"]))
  {
 
    $aq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno='".$ses_staffno."'");
    $ar = mysqli_fetch_array($aq);
    if($ar["imail"]!=""){
      $mto = $ar["imail"];
      $subject = "Email Title Here";
      $message = "Dear ".recap($ar["name"]).",<br /><br />Please Note That Email Testing<br />Project Title: Testing<br />Project Code: code<br />Please Click <a href=''>Here</a> To View And Verify<br /><br />Regards<br />E-Form System Services<br />";
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

    $reimbursable = null; 

    if (isset($_POST["reimbursable"])) {
      $reimbursable = $_POST["reimbursable"];
    }

    $month = $_POST["month"];
    $staffno = $_POST["staffno"];
    $vehiclereg = $_POST["vehicle-reg-no"];
    $division = $_POST["division-department"];
    $position = $_POST["position"];
    $class = $_POST["class"];
    $cc = $_POST["cc"];
    $totals = $_POST["totals"];
    $project = $_POST["project"];
    $pmanager = $_POST["projectManager"];
    $hod = $_POST["HodApprover"];

    mysqli_query($mysqli, "INSERT INTO travelclaims2
                      (
                      reimbursable,
                      month,
                      staffno,
                      vehiclereg,
                      division,
                      position,
                      class,
                      cc,
                      totals,
                      project_code
                      )

                      VALUES
                      (
                        '".$reimbursable."',
                        '".$month."',
                        '".$staffno."',
                        '".$vehiclereg."',
                        '".$division."',
                        '".$position."',
                        '".$class."',
                        '".$cc."',
                        '".$totals."',
                        '".$project."'
                        )
    ");

      $travelClaimId = mysqli_insert_id($mysqli);
       
      $dates = $_POST['date'];
      $places = $_POST['place'];
      $departures = $_POST['departure-time'];
      $arrivals = $_POST['arrival-time'];
      $natures = $_POST['nature'];
      $countries = $_POST['country'];
      $categories = $_POST['category'];
      $particularsOfClaims = $_POST['particulars-of-claims'];
      $amount = $_POST['amount'];
      $distance = $_POST['distance'];

      $targetDir = "forms/travelling/uploads/";
      $attachments = array();

for ($i = 0; $i < count($places); $i++) {
  $target_file = $targetDir . basename($_FILES["attachment"]["name"][$i]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if (move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $target_file)) {
    $attachments[$i] = $target_file;
  }
}

      // Loop through the values
      for ($i = 0; $i < count($places); $i++) {
        $date = $dates[$i];
        $place = $places[$i];
        $departure = $departures[$i];
        $arrival = $arrivals[$i];
        $nature = $natures[$i];
        $country = $countries[$i];
        $category = $categories[$i];
        $currentParticularsOfClaims = $particularsOfClaims[$i];
        $amounts = $amount[$i];
        $distances = $distance[$i];
        $attachment = $attachments[$i];

        mysqli_query($mysqli,"INSERT INTO travel_details 
                  (tclaims_id,
                  date,
                  place,
                  timedeparture,
                  timearrival,
                  nature,
                  category,
                  particular,
                  amount,
                  distance,
                  attachment
                ) 
                  VALUES 
                  (
                    '".$travelClaimId."',
                  '".$date."',
                  '".$place."',
                  '".$departure."',
                  '".$arrival."',
                  '".$nature."',
                  '".$category."',
                  '".$currentParticularsOfClaims."',
                  '".$amounts."',
                  '".$distances."',
                  '".$attachment."'
                  )
                  ");
      }

      mysqli_query($mysqli, "INSERT INTO travel_approval
                        (
                        tclaims_id,
                        hod_staff_no,
                        hod_update,
                        hod_status,
                        hod_remarks,
                        pm_staff_no,
                        pm_update,
                        pm_status,
                        pm_remarks,
                        billing_staff_no,
                        billing_update,
                        billing_status,
                        billing_remarks,
                        billing2_staff_no,
                        billing2_update,
                        billing2_status,
                        billing2_remarks,
                        account_staff_no,
                        account_update,
                        account_status,
                        account_remarks,
                        payroll_staff_no,
                        payroll_update,
                        payroll_status,
                        payroll_remarks
                        )

                        VALUES
                        (
                          '".$travelClaimId."',
                          '".$hod."', 
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '".$pmanager."',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test',
                          '6798',
                          '2022-04-22 10:34:23',
                          'Pending',
                          'Test'
                          )
      ");

      if(mysqli_errno($mysqli)) {
                          die("Database query failed: " . mysqli_error($mysqli));
                      } else {
                          
                      }

  //   $reimbursable = null; 

  //   if (isset($_POST["reimbursable"])) {
  //     $reimbursable = $_POST["reimbursable"];
  //   }

  //   $month = $_POST["month"];
  //   $staffno = $_POST["staffno"];
  //   $vehiclereg = $_POST["vehicle-reg-no"];
  //   $division = $_POST["division-department"];
  //   $position = $_POST["position"];
  //   $class = $_POST["class"];
  //   $cc = $_POST["cc"];
  //   $totals = $_POST["totals"];
  //   $project = $_POST["project"];
  //   $pmanager = $_POST["projectManager"];
  //   $hod = $_POST["HodApprover"];

  //   mysqli_query($mysqli, "INSERT INTO travelclaims2
  //                     (
  //                     reimbursable,
  //                     month,
  //                     staffno,
  //                     vehiclereg,
  //                     division,
  //                     position,
  //                     class,
  //                     cc,
  //                     totals,
  //                     project_code,
  //                     project_manager,
  //                     hod
  //                     )

  //                     VALUES
  //                     (
  //                       '".$reimbursable."',
  //                       '".$month."',
  //                       '".$staffno."',
  //                       '".$vehiclereg."',
  //                       '".$division."',
  //                       '".$position."',
  //                       '".$class."',
  //                       '".$cc."',
  //                       '".$totals."',
  //                       '".$project."',
  //                       '".$pmanager."',
  //                       '".$hod."'
  //                       )
  //   ");

  //   if(mysqli_errno($mysqli)) {
  //     die("Database query failed: " . mysqli_error($mysqli));
  // } 

  //   $targetDir = "forms/travelling/uploads/"; 
  //   $target_file = $targetDir . basename($_FILES ["attachment"]["name"]);
  //   $uploadOK = 1;
  //   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  //   if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file))
  //   {
  //     $attachment = $target_file;
  //   }
    
  //   $totalForms = $_POST["totalForms"];
  //   $date = $_POST["date"];
  //   $place = $_POST["place"];
  //   $departure = $_POST["departure-time"];
  //   $arrival = $_POST["arrival-time"];
  //   $nature = $_POST["nature"];

  //   $category = $_POST["category0"];

  //   $amount = $_POST["amount"];
  //   $distance = $_POST["distance"];
    
  //   for ($i=0; $i < $totalForms; $i++) {

  //     if ($category[$i] === "business") {
  //       $particularClaims  = $_POST["particulars-of-claims(business)"];
  //     } elseif ($category[$i] === "non-business") {
  //       $particularClaims = $_POST["particulars-of-claims(non-business)"];
  //     }

  // mysqli_query($mysqli,"INSERT INTO travel_details 
  //                 (tclaims_id,
  //                 date,
  //                 place,
  //                 timedeparture,
  //                 timearrival,
  //                 nature,
  //                 category,
  //                 particular,
  //                 amount,
  //                 distance,
  //                 attachment
  //               ) 
  //                 VALUES 
  //                 (LAST_INSERT_ID(),
  //                 '".$date[$i]."',
  //                 '".$place[$i]."',
  //                 '".$departure[$i]."',
  //                 '".$arrival[$i]."',
  //                 '".$nature[$i]."',
  //                 '".$category[$i]."',
  //                 '".$particularClaims[$i]."',
  //                 '".$amount[$i]."',
  //                 '".$distance[$i]."',
  //                 '".$attachment."'
  //                 )
  //                 ");	

  //                 if(mysqli_errno($mysqli)) {
  //                   die("Database query failed: " . mysqli_error($mysqli));
  //               } else {
                    
  //               }

  //             }

    
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
    <a href="?page=idx" class="logout-link" style = "background-color:#555; color:white;">
    <img src="images/logout.png" alt="Exam" style="display:inline-block; vertical-align:middle; width:30px; height:30px;">  
    Back</a>
  </div>
    
    <div class="form-container">
    
      <h2>MINCONSULT SDN BHD</h2>
      <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
      <br />
          <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <!-- <div class="form-group"> -->
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
                  
           
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="reimbursable-by-client">Reimbursable By Client:</label>
                    <label for="reimbursable-yes" style="display: inline-block;">
                        Yes
                        <input type="checkbox" id="reimbursable-yes" name="reimbursable" value="Yes" class="boxy-checkbox" onclick="uncheckOther(this)" />
                    </label>
                    <label for="reimbursable-no" style="display: inline-block;">
                        No
                        <input type="checkbox" id="reimbursable-no" name="reimbursable" value="No" class="boxy-checkbox" onclick="uncheckOther(this)" />
                    </label>
                  </div>
                </div>

                <div class="form-group">
                    <label for="month">Month:</label>
                    <input type="date" id="month" name="month" required />
                </div>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name[]" value="<?php echo $name;?>" readonly="readonly" />
                </div>
             
              
              <div class="form-row">
                  <div class="form-group">
                      <label for="staff-no">Staff No:</label>
                      <input type="text" id="staff-no" value="<?php echo $staffno;?>" name="staffno" readonly="readonly" />
                  </div>
                  <div class="form-group">
                      <label for="vehicle-reg-no">Vehicle Reg No:</label>
                      <input type="text" id="vehicle-reg-no" name="vehicle-reg-no" pattern="[A-Za-z0-9-]+" required />
                  </div>
                  <div class="form-group">
                      <label for="division-department">Division / Department:</label>
                      <input type="text" id="division-department" value="<?php echo $division;?>" name="division-department" readonly="readonly" />
                  </div>
                  <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" id="position" name="position" value="<?php echo $designation;?>" readonly="readonly" />
                  </div>
                  <div class="form-group">
                      <label for="class">Class:</label>
                      <select id="class" name="class" required>
                          <option value="car">Automobile</option>
                          <option value="motorcycle">Motorcycle</option>
                      </select> 
                  </div>
                  <div class="form-group">
                      <label for="cc">C.C (Vehicle CC):</label>
                      <input type="text" id="cc" name="cc" pattern="[0-9]+" required />
                  </div>
                  <div class="form-group">
                      <label for="project">Project & Job Number:</label>
                      <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project" rows="3" required />
                  </div>
                  <div class="form-group">
                      <label for="projectManager">Project Manager:</label>
                      <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager" rows="3" required />
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
              <br>
              
              <div class="form-group">
                <div class="cloned-container" id="cloned-container">
                  
                      <div class="cloned" id="cloned">
                          <div class="form-group">
                              <div class="form-number2"></div>
                              <label for="date">Date:</label>
                              <input type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-2 months -1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" id="date" name="date[]"  required />
                            </div>
                          <div class="form-group">
                            <label for="place">Place:</label>
                            <select id="place" name="place[]" class="place">
                              <option value="semenanjung">Semenanjung</option>
                              <option value="s/s">Sabah/Sarawak</option>
                              <option value="overseas">Overseas</option>
                            </select>
                          </div>
                          <div class="form-group country-list" style="display: none;">
                            <label for="country">Country:</label>
                            <select id="country" name="country[]" class="country">
                              <option value="">Select Country</option>
                              <option value="nepal">Nepal</option>
                              <option value="poland">Poland</option>
                              <option value="zimbabwe">Zimbabwe</option>
                            </select>
                          </div>

                          <div class="form-group">
                              <label for="departure-time">Time of Departure:</label>
                              <input type="time" id="departure-time" name="departure-time[]" required />
                          </div>
                        
                          <div class="form-group">
                              <label for="arrival-time">Time of Arrival:</label>
                              <input type="time" id="arrival-time" name="arrival-time[]" required />
                          </div>
                      
                          <div class="form-group"></div>
                          <div class="form-group">
                              <label for="nature-of-duties">Nature of Duties:</label>
                              <textarea id="nature-of-duties" name="nature[]" rows="3" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="category0">Category:</label>
                            <select id="category0" name="category[]" class="category">
                              <option value="default">Please Select a category</option>
                              <option value="business">Business</option>
                              <option value="non-business">Non-business</option>
                            </select>
                          </div>
                          <div class="form-group claims-business" id="claims-business0" style="display: none;">
                            <label for="">Particulars of Claims:</label>
                            <select id="particulars-of-claims0" name="particulars-of-claims[]" class="particulars-of-claims">
                              <!-- <option value="default">Please Select</option> -->
                              <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                              <option value="mileage">Travelling (Mileage)</option>
                              <option value="travelling-carental">Travelling (Car Rental)</option>
                              <option value="petrol">Petrol</option>
                              <option value="toll">Toll</option>
                              <option value="parking">Parking</option>
                              <option value="transport">Transport - Air Fare</option>
                              <option value="subsistence">Subsistence</option>
                              <option value="accomodation">Accomodation</option>
                              <option value="lodging">Lodging</option>
                              <option value="stationary">Stationary</option>
                              <option value="printing">Printing</option>
                              <option value="staffamenities">Staff Amenities</option>
                              <option value="tender">Tender Purchase Fee</option>
                              <option value="process">Processing Fee</option>
                              <option value="computer">Computer Services</option>
                              <option value="postage">Postage</option>
                              <option value="courier">Courier</option>
                              <option value="entertainment">Entertainment</option>
                              <option value="gift">Gift</option>
                              <option value="telephone">Telephone</option>
                              <option value="others1">Others</option>
                            </select>
                          </div>
                          <div class="form-group claims-non-business" id="claims-non-business" style="display: none;">
                            <label for="">Particulars of Claims:</label>
                            <select id="particulars-of-claims1" name="particulars-of-claims[]" class="particulars-of-claims">
                              <!-- <option value="default">Please Select</option> -->
                              <option value="travelling-ehailing">Travelling (E-Hailing)</option>
                              <option value="travelling-owncar">Travelling (Own Car)</option>
                              <option value="travelling-carental">Travelling (Car Rental)</option>
                              <option value="transport">Transport - Air Fare</option>
                              <option value="subsistence">Subsistence</option>
                              <option value="accomodation">Accomodation</option>
                              <option value="lodging">Lodging</option>
                              <option value="others2">Others</option>
                            </select>
                          </div>

                          <div class="form-group input-distance-travelled" style="display: none;">
                            <label for="distance-travelled">Distance Travelled (KM):</label>
                            <input type="number" class="distance-travelled" name="distance[]" onkeyup="calculateAmount(this)" />
                          </div>
                          <div class="form-group">
                            <label for="amount">Amount (RM):</label>
                            <input type="number" class="amount" id="amount" name="amount[]" step="0.01" required />
                          </div>

                          <label for="supporting-attachment">Include a supporting attachment:</label>
                          <input type="file" id="attachment" accept=".pdf" name="attachment[]" required>
                          <hr />
                      </div>
                </div>
              </div>
            </div>

            <div id="form-buttons-container">
              <div class="form-buttons">
                <button type="button" class="add-travel-btn">+</button>
                <button type="button" class="remove-travel-btn">-</button>
                <button type="submit"  name="submit">Submit</button>
                <div class="total-container">
                  <input type="text" name="totals" id="totals" />
                  <span>Total: RM</span><span id="total-amount">0</span>
                </div>    
              </div>
            </div>
            
          </form>
    </div>  
  </body>
</html>

    <script>
      
      function updateTotalAmount() {
        const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
        let totalAmount = 0;
        clonedContainers.forEach((cloned) => {
          const amount = parseFloat(cloned.querySelector('.amount').value);
          totalAmount += isNaN(amount) ? 0 : amount;
        });

        document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
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
          $(document).on("change", ".place", function() {
            var currentCountryList = $(this).closest('.cloned').find('.country-list');
            if ($(this).val() === "overseas") {
              currentCountryList.show();
            } else {
              currentCountryList.hide();
            }
          });

          $(document).on("change", ".category", function() {
            var currentSection = $(this).closest('.cloned');
            var categoryValue = $(this).val();
            var claimsBusiness = currentSection.find('.claims-business');
            var claimsNonBusiness = currentSection.find('.claims-non-business');

            var distanceInput = currentSection.find('.distance-travelled');
            var selectedCategory = $(this).val();
            var selectedClaims = currentSection.find('.particulars-of-claims').val();

            if (selectedCategory === 'business' || selectedCategory === 'non-business') {
                  distanceInput.parent().show();
                } else {
                  distanceInput.parent().hide();
            }

            if (selectedClaims === 'mileage' || selectedClaims === 'travelling-owncar') {
              distanceInput.parent().show();
            }
         
            if (categoryValue === "business") {
              claimsBusiness.show();
              claimsNonBusiness.hide();
          
            } else if (categoryValue === "non-business") {
              claimsBusiness.hide();
              claimsNonBusiness.show();
           
            } else {
              claimsBusiness.hide();
              claimsNonBusiness.hide();
            
            }

            currentSection.find('.particulars-of-claims').val('').trigger('change');
            currentSection.find('.display-specify').hide();

            calculateAmount(distanceInput);
           
          });

          $(document).on("change", ".particulars-of-claims", function() {
            var currentSection = $(this).closest('.cloned');
            var selectedValue = $(this).val();
            var displaySpecify = currentSection.find('.display-specify');
            var distanceInput = currentSection.find('.distance-travelled');

            //here
            if (selectedValue === "others1" || selectedValue === "others2") {
              displaySpecify.show();
            } else {
              displaySpecify.hide();
            }
            if (selectedValue === "mileage" || selectedValue === "travelling-owncar") {
              distanceInput.parent().show();
            } else {
              distanceInput.parent().hide();
            }
            calculateAmount(distanceInput);

          });

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

          $(document).on('change', '.category', function() {
              var currentSection = $(this).closest('.cloned');
              var selectedCategory = $(this).val();
              var distanceInput = currentSection.find('.distance-travelled');

              if (selectedCategory === 'business' || selectedCategory === 'non-business') {
                distanceInput.parent().show();
              } else {
                distanceInput.parent().hide();
              }

              calculateAmount(distanceInput);
            });

            $(document).on('keyup', '.distance-travelled', function() {
              calculateAmount(this);
            });

        });

         document.addEventListener("DOMContentLoaded", function () {
          const addTravelBtn = document.querySelector(".add-travel-btn");
          const removeTravelBtn = document.querySelector(".remove-travel-btn");
          const formContainer = document.querySelector("#travelling-form");
          const totalAmountDisplay = document.querySelector("#total-amount");

          removeTravelBtn.addEventListener("click", function () {
            if (formContainer.children.length > 2) {
              formContainer.removeChild(formContainer.lastElementChild);
            }
            updateTotalAmount(); 
          });

          formContainer.addEventListener("input", updateTotalAmount); 


            // Modify the removeTravel function
          function removeTravel(event) {
            const button = event.target;
            const clonedContainer = button.closest('.cloned-container');
            const clonedContainers = document.querySelectorAll('.cloned-container');

            if (clonedContainers.length > 1) {
              clonedContainer.remove();
              // Recalculate the total amount after removing a cloned section
              updateTotalAmount();
            }
          }

           
        });

      

        var places = document.querySelectorAll(".place");

        places.forEach(function (place) {
          place.addEventListener("change", function() {
            var currentCountryList = this.parentNode.nextElementSibling;
            if (this.value === "overseas") {
              currentCountryList.style.display = "block";
            } else {
              currentCountryList.style.display = "none";
            }
          });
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

            var placeDropdown = clonedSection.find('.place');
            placeDropdown.prop('id', 'place' + count).prop('name', 'place[]');

            var countryDropdown = clonedSection.find('.country-list');
            countryDropdown.prop('id', 'country' + count).prop('name', 'country[]').hide();

            var categoryDropdown = clonedSection.find('.category');
            categoryDropdown.prop('id', 'category' + count).prop('name', 'category[]');

            var claimsBusiness = clonedSection.find('.claims-business');
            claimsBusiness.prop('id', 'claims-business' + count);

            var claimsNonBusiness = clonedSection.find('.claims-non-business');
            claimsNonBusiness.prop('id', 'claims-non-business' + count);

            var particularsOfClaims = clonedSection.find('.particulars-of-claims');
            particularsOfClaims.prop('id', 'particulars-of-claims' + count);

            var displaySpecify = clonedSection.find('.display-specify');
            displaySpecify.prop('id', 'display-specify' + count).hide();

            clonedSection.find('.distance-travelled').val(''); // Clear the Distance Travelled field
            clonedSection.find('.amount').val('');

            return clonedSection;
        }

        function calculateAmount(input) {
          var currentSection = input.closest('.cloned');
          var distanceInput = parseFloat(currentSection.querySelector('.distance-travelled').value);
          var amountInput = currentSection.querySelector('.amount');

          const selectedClass = currentSection.querySelector('.category').value;
          let rate = 0;

          if (selectedClass === 'business') {
            if (distanceInput <= 1) {
              rate = distanceInput * 85;
            } else if (distanceInput <= 500) {
              rate = distanceInput * 0.85;
            } else {
              rate = 500 * 0.85 + (distanceInput - 500) * 0.75;
            }
          } else if (selectedClass === 'non-business') {
            if (distanceInput <= 1) {
              rate = distanceInput * 55;
            } else if (distanceInput <= 500) {
              rate = distanceInput * 0.55;
            } else {
              rate = 500 * 0.55 + (distanceInput - 500) * 0.45;
            }
          }

          amountInput.value = rate.toFixed(2);

          // Calculate and update the total amount
          const clonedContainers = document.querySelectorAll('.cloned-container .cloned');
          let totalAmount = 0;
          clonedContainers.forEach((cloned) => {
            const amount = parseFloat(cloned.querySelector('.amount').value);
            totalAmount += isNaN(amount) ? 0 : amount;
          });

          document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
        }


        
   
          
        
          





    </script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->