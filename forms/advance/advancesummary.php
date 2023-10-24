<style>
  .head {
    background-color: #3a7bd5;
    color: white;
  }

  .link-dark {
    color: #3a7bd5;
  }

  table {
    counter-reset: tableCount;
  }

  .counterCell:before {
    content: counter(tableCount);
    counter-increment: tableCount;
  }

  body {

    background: url("images/bg.jpg") no-repeat center bottom/cover;
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
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="css/style.css">

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


  <!--Data table related, can be copied for other forms-->

  <div class="container"
    style="margin-left:270px;  background-color:white; padding-top:30px; border-radius:20px;box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; ">
    <h2>Requested Advance Listing</h2>
    <table class="table table-striped text-center" id="travelClaimsTable">

      <!--The data table element ends here-->

      <thead class="head">
        <tr>
          <th scope="col">Item</th>
          <th scope="col">Advance Required</th>
          <th scope="col">When Required</th>
          <th scope="col">Nature</th>
          <th scope="col">Purpose</th>
          <th scope="col">Details</th>
          <th scope="col">Status</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql2 = "SELECT * FROM advanceclaim WHERE staffno = '" . $ses_staffno . "'";
        $result2 = mysqli_query($mysqli, $sql2);
        while ($row2 = mysqli_fetch_array($result2)) {

          $id = $row2["advance_id"];
          $sql = "SELECT * FROM advance_details WHERE aclaims_id = " . $id;
          $result = mysqli_query($mysqli, $sql);
          $row = mysqli_fetch_array($result);

          ?>
          <tr class="table-light">
            <td class="counterCell"></td>
            <td>
              <?php echo "RM" . $row["advance_required"] ?>
            </td>
            <td>
              <?php echo $row["when_required"] ?>
            </td>
            <td>
              <?php echo $row["nature"] ?>
            </td>
            <td>
              <?php echo $row["purpose"] ?>
            </td>
            <td>

              <a href="?page=detailsummary&id=<?php echo $id; ?>" class="link-dark"><i class="fa-solid fa-eye"></i></a>
            </td>

            <td colspan='2'>
              <?php
              $qhod = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id =$id AND form_category = 3");

              $rhod = mysqli_fetch_array($qhod);

              $q = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id AND form_category = 3 AND approval_priority = (SELECT MIN(approval_priority) FROM approval_level)");
              $r = mysqli_fetch_array($q);
              $firstApproverStatus = $r["approval_status"];

              if ($firstApproverStatus == "pending" || $firstApproverStatus == "Declined") {

                $approval_id = $r["approval_level_id"];
                $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $approval_id");
                $rr = mysqli_fetch_array($qq);
                $title = $rr["title"];


                if ($firstApproverStatus == "pending") {
                  print "<strong><span style='color: white; background-color: orange; border-radius: 5px; line-height: 35px; padding: 5px;'>" . $firstApproverStatus . " by " . staff_details($r["staffno"])["name"] . " - " . $title . "</span></strong><br>";
                  print "&nbsp;&nbsp;&nbsp;<a href='?page=advancesummary&id=" . $id . "' class='link-dark'onclick='confirmDelete(" . $id . ");'><i class='fa-solid fa-trash-can'></i></a>";
                  print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?page=editadvanceform&id=" . $id . "' class='link-dark'><i class='fa-solid fa-pen-to-square'></i></a>";

                } else {
                  print "<strong><span style='color: white; background-color: green; border-radius: 5px; line-height: 35px; padding: 5px;'>" . $firstApproverStatus . " by " . staff_details($r["staffno"])["name"] . " - " . $title . "</span></strong>";
                }

              } else {

                $q2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE t_claims_id = $id ORDER BY approval_priority DESC LIMIT 1");
                $r2 = mysqli_fetch_array($q2);

                $approval_id = $r2["approval_level_id"];
                $qq = mysqli_query($mysqli, "SELECT * FROM approval_level WHERE id = $approval_id");
                $rr = mysqli_fetch_array($qq);
                $title = $rr["title"];

                if ($r2["approval_status"] == "Declined") {
                  print "<strong><span style='color: white; background-color: #990F02; border-radius: 5px; line-height: 35px; padding: 5px;'>" . $r2["approval_status"] . " by " . staff_details($r2["staffno"])["name"] . " - " . $title . "</span></strong>";
                } else if ($r2["approval_status"] == "pending") {
                  print "<strong><span style='color: white; background-color: orange; border-radius: 5px; line-height: 35px; padding: 5px;'>" . $r2["approval_status"] . " by " . staff_details($r2["staffno"])["name"] . " - " . $title . "</span></strong>";
                } else {
                  print "<strong><span style='color: white; background-color: green; border-radius: 5px; line-height: 35px; padding: 5px;'>" . $r2["approval_status"] . " by " . staff_details($r2["staffno"])["name"] . " - " . $title . "</span></strong>";

                }

              }


              ?>

              <?php

              if ($id == $_GET["id"]) {
                if (isset($_GET['id'])) {
                  $id = $_GET['id'];

                  $sql = "DELETE FROM approval_detail WHERE t_claims_id  = " . $id;
                  mysqli_query($mysqli, $sql);

                  $sql2 = "DELETE FROM advance_details WHERE aclaims_id = " . $id;
                  mysqli_query($mysqli, $sql2);

                  $sql3 = "DELETE FROM advanceclaim WHERE advance_id = " . $id;
                  mysqli_query($mysqli, $sql3);

                  $goto = "?page=advancesummary";
                  $msg = "Deleting <img src='images/loading.gif' />";
                  $func->info($msg, $goto);
                }
              }

              ?>

            </td>
          </tr>
          <?php

        }

        ?>
      </tbody>
    </table>
  </div>

  <script>
    function confirmDelete(id) {
      var confirmDelete = confirm("Are you sure you want to delete this item?");
      if (confirmDelete) {
        // If the user confirms, redirect to the delete page or trigger the delete action
        window.location.href = "?page=advancesummary&id=" + id;
      }
      // If the user cancels, do nothing
    }

    $(document).ready(function () {
      $('#travelClaimsTable').DataTable();
    });

  </script>