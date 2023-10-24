<?php
	
	$q = mysqli_query($mysqli,"SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
	$r = mysqli_fetch_array($q);
	
	$uq = mysqli_query($mysqli,"SELECT * FROM advance_approval WHERE aclaims_id=".$_GET["id"]);
	$ur = mysqli_fetch_array($uq);
	
	$auq = mysqli_query($mysqli,"SELECT * FROM advance_details WHERE aclaims_id=".$_GET["id"]);
	$aur = mysqli_fetch_array($auq);

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
       
    <!-- <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr> -->
    
    
     <tr>
    <td style="height: 200px; padding-bottom:200px;">&nbsp; Additional Comments : </td>
    </tr>
    
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><h2>ADVANCE FORM</h2><hr /></td>
  </tr>
  <tr>
    <td width="25%"><strong>Reimbursable by Client</strong></td>
    <td width="25%"><strong>Month</strong></td>
    
  </tr>
  <tr>
    <td><?php print $aur["reimbursable"];?></td>
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
    <td colspan="3"><strong>Division / Department</strong></td>
  </tr>

  <tr>
    <td colspan="3"><?php print $r["department"]; ?></td>
  </tr>
  
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  
  <tr>
    <td><strong>When Rquired</strong></td>
    <td><strong>Advance Required</strong></td>
    <td><strong>Project Code</strong></td>
    <td><strong>Nature</strong></td>
  </tr>
  
  <tr>
    <td><?php print $aur["when_required"]?></td>
    <td><?php print "RM".$aur["advance_required"];?></td>
    <td><?php print $aur["project_code"];?></td>
    <td><?php print $aur["nature"];?></td>
  </tr>
  
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
    <td><strong>Purpose</strong></td>
    <td><strong>Previous Advances</strong></td>
    <td><strong>Approved Advances</strong></td>
  </tr>
  
  <tr>
    <td><?php print $aur["purpose"]?></td>
    <td><?php print "RM".$aur["previous_advances"]?></td>
    <td><?php print "RM".$aur["approved_advance"]?></td>
  </tr>
  
  <tr>
    <td colspan="4"><hr /></td>
  </tr>

  <tr>
    <td><strong>Project Manager Approval</strong></td>
    <td><strong>HOD Approval</strong></td>
    <td><strong>Billing 1 Approval</strong></td>
    <td><strong>Billing 2 Approval</strong></td>

  </tr>
  
  <tr>
    <td><?php 
$sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
  while ($dql5 = mysqli_fetch_array($sql5)) 
  {
      $id5 = $dql5["advance_id"];

      $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 21";
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
    $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["advance_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 15";
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
    $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["advance_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 16";
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
    $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
    while ($dql5 = mysqli_fetch_array($sql5)) 
    {
        $id5 = $dql5["advance_id"];
  
        $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 17";
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
    <td><strong>Finance Approval</strong></td>
    <td><strong>CEO Approval</strong></td>
    <td><strong>Account Approval</strong></td>
  </tr>
  
  <tr>
  <td><?php
  $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
  while ($dql5 = mysqli_fetch_array($sql5)) 
  {
      $id5 = $dql5["advance_id"];

      $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 18";
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
   $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
   while ($dql5 = mysqli_fetch_array($sql5)) 
   {
       $id5 = $dql5["advance_id"];
 
       $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 19";
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
   $sql5 = mysqli_query($mysqli, "SELECT * FROM advanceclaim WHERE advance_id=".$_GET["id"]);
   while ($dql5 = mysqli_fetch_array($sql5)) 
   {
       $id5 = $dql5["advance_id"];
 
       $sql6 = "SELECT * FROM approval_detail WHERE t_claims_id = ".$id5." AND approval_level_id = 20";
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
