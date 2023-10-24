<?php

        $sql = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 24");
        $hasApproval = mysqli_num_rows($sql);  

        if ($hasApproval > 0) {
            print "<li>";
            print '<a href="?page=hodapprovalotmeal">HOD Approval</a>';
            print "</li>";
        }        

        $sql2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 25");
        $hasApproval2 = mysqli_num_rows($sql2);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=billingapprovalotmeal">Billing 1 Approval</a>';
            print "</li>";
        }

        $sql3 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 26");
        $hasApproval3 = mysqli_num_rows($sql3);  

        if ($hasApproval3 > 0) {
            print "<li>";
            print '<a href="?page=billing2approvalotmeal">Billing 2 Approval</a>';
            print "</li>";
        }
    

        $sql4 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 27");
        $hasApproval4 = mysqli_num_rows($sql4);  

        if ($hasApproval4 > 0) {
            print "<li>";
            print '<a href="?page=financeapprovalotmeal">Finance Approval</a>';
            print "</li>";
        }
    

        $sql5 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 28");
        $hasApproval5 = mysqli_num_rows($sql5);  

        if ($hasApproval5 > 0) {
            print "<li>";
            print '<a href="?page=payrollapprovalotmeal">Payroll Approval</a>';
            print "</li>";
        }
    
?>