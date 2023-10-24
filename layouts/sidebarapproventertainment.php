<?php

        $sql = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 10 AND approval_status = 'pending' ");
        $hasApproval = mysqli_num_rows($sql);  

        if ($hasApproval > 0) {
            print "<li>";
            print '<a href="?page=hodapprovalentertain">HOD Approval</a>';
            print "</li>";
        }        
 

        $sql2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 11 AND approval_status = 'pending' ");
        $hasApproval2 = mysqli_num_rows($sql2);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=billingapprovalentertain">Billing 1 Approval</a>';
            print "</li>";
        }

        $sql3 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 12 AND approval_status = 'pending' ");
        $hasApproval3 = mysqli_num_rows($sql3);  

        if ($hasApproval3 > 0) {
            print "<li>";
            print '<a href="?page=billing2approvalentertain">Billing 2 Approval</a>';
            print "</li>";
        }
    

        $sql4 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 13 AND approval_status = 'pending' ");
        $hasApproval4 = mysqli_num_rows($sql4);  

        if ($hasApproval4 > 0) {
            print "<li>";
            print '<a href="?page=accountapprovalentertain">Account Approval</a>';
            print "</li>";
        }
    

        $sql5 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 14 AND approval_status = 'pending' ");
        $hasApproval5 = mysqli_num_rows($sql5);  

        if ($hasApproval5 > 0) {
            print "<li>";
            print '<a href="?page=payrollapprovalentertain">Payroll Approval</a>';
            print "</li>";
        }
    
    
?>