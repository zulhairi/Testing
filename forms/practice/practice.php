<!DOCTYPE html>
<html>
<head>
  <style>
    /* Add your custom CSS styles here */
    .cloned-section {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
    }
    .remove-clone {
      color: red;
      cursor: pointer;
    }
    /* Retain your existing styles */
    body {
      background: url("images/bg.jpg") no-repeat center bottom/cover;
      /* Add your other background styles */
    }
    /* Add your other CSS styles for sidebar, form, etc. */
  </style>
</head>
<body>
  <!-- Your existing HTML structure for sidebar here -->
  <!-- ... -->

  <div class="form-container">
    <h2>MINCONSULT SDN BHD</h2>
    <h3><strong><center>Practice Form</center></strong></h3>
    <form method="post" action="process.php">
      <!-- Your existing form elements here -->
      <!-- ... -->

      <div id="cloned-container">
        <!-- Cloneable section template -->
        <div class="cloned-section">
          <!-- Clone "Reimbursable By Client" -->
          <div class="form-group">
            <label for="reimbursable-by-client">Reimbursable By Client:</label>
             <label for="reimbursable-yes" style="display: inline-block;">
             Yes
             <input type="checkbox" id="reimbursable-yes" name="reimbursable[]" value="1" class="boxy-checkbox" onclick="uncheckOther(this)"   />
             </label>
             <label for="reimbursable-no" style="display: inline-block;">
             No
             <input type="checkbox" id="reimbursable-no" name="reimbursable[]" value="2" class="boxy-checkbox" onclick="uncheckOther(this)"  />
          </label>
          </div>
          
          <!-- Clone "Amount (RM)" -->
          <div class="form-group">
            <label for="amount">Amount (RM):</label>
            <input type="number" class="amount" name="amount[]" step="0.01" required />
          </div>
          
          <!-- Clone "Purpose of Advance" -->
          <div class="form-group">
            <label for="purpose">Purpose of Advance:</label>
            <textarea name="purpose[]" rows="3" required></textarea>
          </div>
          
          <!-- Clone "HOD Approver" -->
          <div class="form-group">
            <label for="HodApprover">HOD Approver:</label>
            <select name="HodApprover[]" required>
              <option value="">Please select</option>
              <?php
              // Your PHP code to generate the HOD Approver options here
              ?>
            </select>
          </div>
          
          <!-- Clone "Supporting Attachment" -->
          <div class="form-group">
            <label for="attachment">Supporting attachment:</label>
            <input type="file" accept=".pdf" name="attachment[]">
            <small>Only PDF files are allowed.</small>
          </div>

          <div class="remove-clone" onclick="removeClone(this)">Remove</div>
        </div>
      </div>
      
      <button type="button" id="add-clone">Add More</button>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include your other scripts here -->

  <script>
    $(document).ready(function() {
      // Clone a section when "Add More" button is clicked
      $("#add-clone").click(function() {
        var clonedSection = $(".cloned-section:first").clone();
        clonedSection.find("input[type='checkbox']").prop("checked", false);
        clonedSection.find("input[type='number']").val("");
        clonedSection.find("textarea").val("");
        clonedSection.find("select").val("");
        clonedSection.find("input[type='file']").val("");
        $("#cloned-container").append(clonedSection);
      });

      // Remove a cloned section when "Remove" link is clicked
      function removeClone(element) {
        $(element).closest(".cloned-section").remove();
      }

      window.removeClone = removeClone; // Expose the function globally
    });
  </script>
</body>
</html>
