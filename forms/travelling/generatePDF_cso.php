<?php
	
	$q = mysqli_query($mysqli,"SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
	$r = mysqli_fetch_array($q);
	
	$uq = mysqli_query($mysqli,"SELECT * FROM travel_details WHERE tclaims_id=".$_GET["id"]." AND  traveldetails_id=".$_GET["traveldetails_id"]."");
	$ur = mysqli_fetch_array($uq);

	
  $sq = mysqli_query($mysqli,"SELECT * FROM hr_employee WHERE staffno = '".$ses_staffno."'");
	$sr = mysqli_fetch_array($sq);
								
?>

<style type="text/css">
   @media print {
        @page {
          margin: 0;
        }
      }

body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #000;
}
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 10px;
	margin-bottom: 10px;
}
</style>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="2" valign="top"><img src="images/laterhead.jpg" width="430" height="72">
    <hr /></td>
    <td colspan="2" rowspan="8"> <table width="100%" border="1" cellspacing="0" cellpadding="3">
    <tr>
        <td colspan="10" valign="top" style="height: 50px; padding-top:20px;"><strong><center>For Billings and Accounts Use Only</center></strong></td>
  	</tr>
       
    
     <tr>
    <td style="height: 200px; padding-bottom:200px;">&nbsp; Additional Comments : </td>
    </tr>
    
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><h2>TRAVELLING FORM - Mr.Ravi</h2><hr /></td>
  </tr>
  <tr>
    <td width="25%"><strong>Reimbursable by Client</strong></td>
    <td width="25%"><strong>Month</strong></td>
    
  </tr>
  <tr>
    <td><?php print $r["reimbursable"];?></td>
    <td valign="top"><?php print date("F", strtotime($r["month"]));
?></td>
  </tr>
  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
  <td width="25%"><strong>Year</strong></td>
    <td width="25%"><strong>Name</strong></td>
  </tr>
  
   <tr>
    <td valign="top"><?php print date("Y", strtotime($r["month"]));?></td>
    <td valign="top"><?php print $sr["name"];?></td>
  </tr>
  
 <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
 
  <tr>
    <td valign="top"><strong>Position</strong></td>
    <td colspan="3"><strong>Staff No</strong></td>
  </tr>

  <tr>
    <td valign="top"><?php
    
    $designationId = $sr["desig"];

    $dq2 = mysqli_query($mysqli, "SELECT * FROM hr_designation WHERE desg_code = '".$designationId."'");
                    while ($dr2 = mysqli_fetch_array($dq2))
                    {
                    $designation = $dr2["desg_name"];

                    print $designation;
                    }

    ?></td>
    <td colspan="3"><?php print $sr["staffno"]; ?></td>
  </tr>

  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>

  <tr>
    <td valign="top"><strong>Class</strong></td>
    <td colspan="3"><strong>C.C</strong></td>
  </tr>

   <tr>
    <td valign="top"><?php print $r["class"]?></td>
    <td colspan="3"><?php print $r["cc"]; ?></td>
  </tr>

  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>

  <tr>
    <td valign="top"><strong>Vehicle Reg No</strong></td>
    <td colspan="3"><strong>Division / Department</strong></td>
  </tr>

  <tr>
    <td valign="top"><?php print $r["vehiclereg"]?></td>
    <td colspan="3"><?php print $r["division"]; ?></td>
  </tr>
  
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  
  <tr>
    <td><strong>Departure Date</strong></td>
    <td><strong>Time of Departure</strong></td>
    <td><strong>Arrival Date</strong></td>
    <td><strong>Time of Arrival</strong></td>
    
  </tr>

  <?php
  $counter = 1;
  $uq = mysqli_query($mysqli, "SELECT * FROM travel_details WHERE tclaims_id=" . $_GET["id"]);
  while ($ur = mysqli_fetch_array($uq)) {
  ?>

  <tr>
    
    <td><?php print $ur["datedeparture"]?></td>
    <td><?php print $ur["timedeparture"];?></td>
    <td><?php print $ur["datearrival"]?></td>
    <td><?php print $ur["timearrival"];?></td>
    
  </tr>

  <?php
  }

  ?>
  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td><strong>Nature</strong></td>
    <td><strong>Project Code</strong></td>
    <td><strong>Particular of Claim</strong></td>
    
  </tr>

  <?php
  $uq = mysqli_query($mysqli, "SELECT * FROM travel_details WHERE tclaims_id=" . $_GET["id"]);
  while ($ur = mysqli_fetch_array($uq)) {

  ?>
  
  <tr>
  <td><?php print $ur["nature"];?></td>
    <td><?php print $r["project_code"]?></td>
    
    <td>
      <?php

echo ucfirst($ur["particular"]);
if ($ur["particular"] === "mileage") {
  echo "<br>";
  echo "(" .$ur["distance"]. "KM)";
}
     
     ?>
     
    </td>
    
  </tr>

  <?php
  }
  $uq = mysqli_query($mysqli,"SELECT * FROM travel_details WHERE tclaims_id=".$_GET["id"]." AND  traveldetails_id=".$_GET["traveldetails_id"]."");
	$ur = mysqli_fetch_array($uq);
  ?>

  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
  <td><strong>Amount</strong></td>
    <td colspan="2"><strong>Total :</strong></td>
  </tr>
   <tr>
   <td><?php print "RM".$ur["amount"];?></td>
    <td colspan="2" valign="top"><?php print "RM" .$r["totals"];?></td>
  </tr>

  <tr>
    <td colspan="4"><hr /></td>
  </tr>

  <tr>
    <td><strong>Billing(1) Approval</strong></td>
    <td><strong>Billing(2) Approval</strong></td>
    <td><strong>CEO Approval</strong></td>
    <td><strong>Finance Approval</strong></td>

  </tr>
  
  <tr>
    <td><?php
     $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
     while ($dql5 = mysqli_fetch_array($sql5)) 
     {
         $id5 = $dql5["travel_id"];
   
         $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 36";
         $result6 = mysqli_query($mysqli, $sql6);
         $row6 = mysqli_fetch_assoc($result6);
   
         $hod = $row6["staffno"];
         $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
         $result7 = mysqli_query($mysqli, $sql7);
         $row7 = mysqli_fetch_array($result7);
         echo "<strong>".$row7["name"]."</strong>";
   
     }
    
    ?></td>
    <td><?php 
     $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
     while ($dql5 = mysqli_fetch_array($sql5)) 
     {
         $id5 = $dql5["travel_id"];
   
         $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 37";
         $result6 = mysqli_query($mysqli, $sql6);
         $row6 = mysqli_fetch_assoc($result6);
   
         $hod = $row6["staffno"];
         $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
         $result7 = mysqli_query($mysqli, $sql7);
         $row7 = mysqli_fetch_array($result7);
         echo "<strong>".$row7["name"]."</strong>";
   
     }
    ?></td>
    <td><?php
     $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
     while ($dql5 = mysqli_fetch_array($sql5)) 
     {
         $id5 = $dql5["travel_id"];
   
         $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 38";
         $result6 = mysqli_query($mysqli, $sql6);
         $row6 = mysqli_fetch_assoc($result6);
   
         $hod = $row6["staffno"];
         $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
         $result7 = mysqli_query($mysqli, $sql7);
         $row7 = mysqli_fetch_array($result7);
         echo "<strong>".$row7["name"]."</strong>";
   
     }
    
    ?></td>
    <td><?php 
     $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
     while ($dql5 = mysqli_fetch_array($sql5)) 
     {
         $id5 = $dql5["travel_id"];
   
         $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 39";
         $result6 = mysqli_query($mysqli, $sql6);
         $row6 = mysqli_fetch_assoc($result6);
   
         $hod = $row6["staffno"];
         $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
         $result7 = mysqli_query($mysqli, $sql7);
         $row7 = mysqli_fetch_array($result7);
         echo "<strong>".$row7["name"]."</strong>";
   
     }
    ?></td>
  </tr>

  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>


  
  
  <tr>
  
  <td><?php
  $sql5 = mysqli_query($mysqli, "SELECT * FROM travelclaims2 WHERE travel_id=".$_GET["id"]);
  while ($dql5 = mysqli_fetch_array($sql5)) 
  {
      $id5 = $dql5["travel_id"];

      $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 9";
      $result6 = mysqli_query($mysqli, $sql6);
      $row6 = mysqli_fetch_assoc($result6);

      $hod = $row6["staffno"];
      $sql7 = "SELECT * FROM hr_employee WHERE staffno = '".$hod."'";
      $result7 = mysqli_query($mysqli, $sql7);
      $row7 = mysqli_fetch_array($result7);
      echo "<strong>".$row7["name"]."</strong>";

  }
  ?></td>
  </tr>

  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript" language="javascript">
print();
//close();
</script>
