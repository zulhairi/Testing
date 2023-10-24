<?php

        $sql = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 1 AND approval_status = 'pending' ");
        $hasApproval = mysqli_num_rows($sql);  

        if ($hasApproval > 0) {
            print "<li>";
            print '<a href="?page=hodapprovaltravel">HOD Approval</a>';
            print "</li>";
        }        

     
        $sql2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 2 AND approval_status = 'pending' ");
        $hasApproval2 = mysqli_num_rows($sql2);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=pmapproval">Project Manager Approval</a>';
            print "</li>";
        }

        $sql3 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id IN (4,32,36) AND approval_status = 'pending' ");
        $hasApproval3 = mysqli_num_rows($sql3);  

        if ($hasApproval3 > 0) {
            print "<li>";
            print '<a href="?page=billingapprovaltravel">Billing 1 Approval</a>';
            print "</li>";
        }
    

        $sql4 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id IN (5,33,37) AND approval_status = 'pending' ");
        $hasApproval4 = mysqli_num_rows($sql4);  

        if ($hasApproval4 > 0) {
            print "<li>";
            print '<a href="?page=billingapprovaltravel2">Billing 2 Approval</a>';
            print "</li>";
        }
    

        $sql5 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id IN (8,35,39) AND approval_status = 'pending' ");
        $hasApproval5 = mysqli_num_rows($sql5);  

        if ($hasApproval5 > 0) {
            print "<li>";
            print '<a href="?page=financeapprovaltravel">Finance Approval</a>';
            print "</li>";
        }
    

        $sql6 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 9 AND approval_status = 'pending' ");
        $hasApproval6 = mysqli_num_rows($sql6);  

        if ($hasApproval6 > 0) {
            print "<li>";
            print '<a href="?page=payrollapprovaltravel">Payroll Approval</a>';
            print "</li>";
        }
    
        $sql7 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 38 AND approval_status = 'pending'");
        $hasApproval7 = mysqli_num_rows($sql7);  

        if ($hasApproval7 > 0) {
            print "<li>";
            print '<a href="?page=ceoapprovaltravel">CEO Approval</a>';
            print "</li>";
        }

        $sql8 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 34 AND approval_status = 'pending'");
        $hasApproval8 = mysqli_num_rows($sql8);  

        if ($hasApproval8 > 0) {
            print "<li>";
            print '<a href="?page=csoapprovaltravel">CSO Approval</a>';
            print "</li>";
        }
?>