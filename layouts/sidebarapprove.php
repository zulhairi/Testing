<?php

 

        $sql = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 15");
        $hasApproval = mysqli_num_rows($sql);  

        if ($hasApproval > 0) {
            print "<li>";
            print '<a href="?page=hodapprovaladvance">HOD Approval</a>';
            print "</li>";
        }        


    $sql7 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 21");
        $hasApproval2 = mysqli_num_rows($sql7);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=pmapprovaladvance">Project Manager Approval</a>';
            print "</li>";
        }

        $sql2 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 16");
        $hasApproval2 = mysqli_num_rows($sql2);  

        if ($hasApproval2 > 0) {
            print "<li>";
            print '<a href="?page=billing1approval">Billing 1 Approval</a>';
            print "</li>";
        }

        $sql3 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 17");
        $hasApproval3 = mysqli_num_rows($sql3);  

        if ($hasApproval3 > 0) {
            print "<li>";
            print '<a href="?page=billing2approval">Billing 2 Approval</a>';
            print "</li>";
        }
    

        $sql4 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 18");
        $hasApproval4 = mysqli_num_rows($sql4);  

        if ($hasApproval4 > 0) {
            print "<li>";
            print '<a href="?page=financeapproval">Finance Approval</a>';
            print "</li>";
        }
    

        $sql5 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 19");
        $hasApproval5 = mysqli_num_rows($sql5);  

        if ($hasApproval5 > 0) {
            print "<li>";
            print '<a href="?page=ceoapproval">CEO Approval</a>';
            print "</li>";
        }
    

        $sql6 = mysqli_query($mysqli, "SELECT * FROM approval_detail WHERE staffno = '".$ses_staffno."' AND approval_level_id = 20");
        $hasApproval6 = mysqli_num_rows($sql6);  

        if ($hasApproval6 > 0) {
            print "<li>";
            print '<a href="?page=accountsapproval">Accounts Approval</a>';
            print "</li>";
        }
    
?>