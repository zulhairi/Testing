<style>
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
         <h3>
            <strong>
               <center>Entertainment / Gift Claims - External Party </center>
            </strong>
         </h3>
         <!-- <h3><strong><center>TRAVELLING, SUBSISTENCE, LODGING, MILEAGE AND MISCELLANEOUS EXPENSES CLAIMS</center></strong></h3> -->
         <br />
         <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
               <!-- <div class="form-group"> -->
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
                  <label for="position">Position:</label>
                  <input type="text" id="position" name="position" value="<?php echo $designation;?>" readonly="readonly" />
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <label for="staff">Staff No:</label>
                  <input type="text" id="staff" name="staff" value="<?php echo $staffno; ?>" readonly="readonly">
               </div>
               <div class="form-group">
                  <label for="department">Department:</label>
                  <input type="text" id="department" name="department" value="<?php echo $division; ?>" readonly="readonly">
                  <div>
                  </div>
               </div>
            
            
               
               
               <br>
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
                        <label for="bill">Bill No:</label>
                        <input type="text" id="bill" name="bill" required>
                     </div>
                    </div>
                    <div class="form-row">
                     <div class="form-group">
                        <label for="person">Name of Person:</label>
                        <input type = "text" id="person" name="person" required>
                     </div>
                     <div class="form-group">
                        <label for="designation">Title / Designation:</label>
                        <input type="text" id="designation" name="designation" required>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <label for="projectManager">Project Manager:</label>
                        <input type="text" id="projectManager" placeholder="Please enter project manager" name="projectManager" rows="3" required />
                     </div>
                     <div class="form-group">
                        <label for="project">Project & Job Number:</label>
                        <input type="text" id="project" placeholder="Please input project code" oninput="validateInput()" name="project" rows="3" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="company">Company:</label>
                     <input type = "text" id="company" name="company" required>
                  </div>
                  <div class="form-row">
                  <div class="form-group">
                           <label for="amount">Amount (RM):</label>
                           <input type="number" class="amount" id="amount" name="amount[]" step="0.01" required />
                        </div>
                  <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea id="remarks" name="remarks" rows="1" required></textarea>
                     </div>
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
                            <br>
                            <div class="form-group">
                           <label>
                           <input type="checkbox" name="verification" required>
                           I hereby certify that all information above is correct
                           </label>
                        </div>
                    
                        <br>
                        
                        
                        
                        
                        
                    
                        <label for="supporting-attachment">Include a supporting attachment:</label>
                        <input type="file" id="attachment" accept=".pdf" name="attachment[]" required>
                        <small>Only PDF files are allowed.</small>
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
                     Total: RM <input type="text" id="totals" name="totals" value="0" style = "width: 100px;">
                  </div>
               </div>
            </div>
         </form>
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
         var others = currentSection.find('.others');
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

         if (selectedClaims === 'others1' || selectedClaims === 'others2')
         {
          others.parents().show();
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
         var displaySpecify = currentSection.find('.others');
         var distanceInput = currentSection.find('.distance-travelled');
   

         if (selectedValue === "others1" || selectedValue === "others2") {
           displaySpecify.parent().show();
         } else {
           displaySpecify.parent().hide();
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
       const totalAmountDisplay = document.querySelector("#totals");
   
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

       const selectedClass = document.getElementById('class').value;
       const selectedCategory  = currentSection.querySelector('.category').value;
       
       let rate = 0;
   
       if (selectedClass === 'car')
       {
        if (selectedCategory === 'business' ) {
         if (distanceInput <= 500) {
           rate = distanceInput * 0.85;
         } else {
           rate = 500 * 0.85 + (distanceInput - 500) * 0.75;
         }
       } else if (selectedCategory === 'non-business') {
         if (distanceInput <= 500) {
           rate = distanceInput * 0.85;
         } else {
           rate = 500 * 0.55 + (distanceInput - 500) * 0.75;
         }
       }
       }else if (selectedClass === 'motorcycle') {
    if (selectedCategory === 'business') {
      if (distanceInput <= 500) {
        rate = distanceInput * 0.55; 
      } else {
        rate = 500 * 0.55 + (distanceInput - 500) * 0.45;
      }
    } else if (selectedCategory === 'non-business') {
      if (distanceInput <= 500) {
        rate = distanceInput * 0.55;
      } else {
        rate = 500 * 0.55 + (distanceInput - 500) * 0.45;
      }
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

  const totalAmountInput = document.getElementById('totals');
  totalAmountInput.value = totalAmount.toFixed(2);
}
   
   
</script>
<script>
  // Get the input elements
  var monthInput = document.getElementById('month');
  var dateInput = document.getElementById('date');

  // Listen for the 'input' event on the 'month' field
  monthInput.addEventListener('input', function() {
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->