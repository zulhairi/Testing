<?php

        $sql = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 29");
        $hasApproval = mysqli_num_rows($sql);  

        if ($hasApproval > 0) {
            print "<li>";
            print '<a href="?page=hodapprovalpractice">HOD Approval</a>';
            print "</li>";
        }        

     
        $sql2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 30");
        $hasApproval2 = mysqli_num_rows($sql2);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=pmapproval">Project Manager Approval</a>';
            print "</li>";
        }

        $sql3 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 31");
        $hasApproval3 = mysqli_num_rows($sql3);  

        if ($hasApproval3 > 0) {
            print "<li>";
            print '<a href="?page=billingapprovaltravel">Billing 1 Approval</a>';
            print "</li>";
        }
    
?>