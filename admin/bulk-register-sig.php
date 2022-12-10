<?php
// Load the database configuration file
include_once '../mysql_connect.php';

if(isset($_POST['importSubmit'])){

    // Allowed mime types
    $csvMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            $orgData = [];
            $queryOrg = "SELECT ORG_ID,ORG FROM tb_orgs";
            $resOrg = @mysqli_query($conn, $queryOrg);
            while ($rowOrg = $resOrg->fetch_assoc()) {
                $orgData[$rowOrg["ORG"]] = $rowOrg["ORG_ID"]; 
            }

            $collegeData = [];
            $queryCollege = "SELECT college_id,college FROM tb_collegedept";
            $resCollege = @mysqli_query($conn, $queryCollege);
            while ($rowCollege = $resCollege->fetch_assoc()) {
                $collegeData[$rowCollege["college"]] = $rowCollege["college_id"]; 
            }

            $sigData = [];
            $querySig= "SELECT signatory_id, signatory FROM tb_signatory_type";
            $resSig = @mysqli_query($conn, $querySig);
            while ($rowSig = $resSig->fetch_assoc()) {
                $sigData[$rowSig["signatory"]] = $rowSig["signatory_id"]; 
            }


            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $si =  $line[0]  ?? NULL;
                $fn = $line[1]  ?? NULL;
                $ln = $line[2]  ?? NULL;
                $e = $line[3]  ?? NULL;
                $pass = $line[4]  ?? NULL;
                $sigT =  $sigData[$line[5]]  ?? NULL;
                $cd =  $collegeData[$line[6]]  ?? NULL;
                $morgid =  $orgData[$line[7]]  ?? NULL;
                $pp = "avatar-default.png";
                $ul = "3";
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM tb_signatories WHERE email = '".$line[3]."'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE tb_signatories SET first_name = '".$fn."', last_name = '".$ln."', email = '".$e."', college_dept = '".$cd."', org_id = '".$morgid."', WHERE email = '".$e."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO tb_signatories(school_id, first_name, last_name, college_dept, org_id, email, password, signatorytype_id, account_created, profile_pic, usertype_id)
                    VALUES('$si', '$fn', '$ln', '$cd', '$morgid', '$e', SHA('$pass'), '$sigT', NOW(), '$pp', '$ul')");
                }
            }

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: admin-signatories-users.php".$qstring);
