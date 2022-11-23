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

            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $fname   = $line[0];
                $lname  = $line[1];
                $email  = $line[2];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT USER_ID FROM tb_students2 WHERE EMAIL = '".$line[2]."'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE tb_students2 SET FIRST_NAME = '".$fname."', LAST_NAME = '".$lname."', EMAIL = '".$email."' WHERE EMAIL = '".$email."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO tb_students2 (FIRST_NAME, LAST_NAME, EMAIL) VALUES ('".$fname."', '".$lname."', '".$email."')");
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
header("Location: admin-students-users.php".$qstring);
