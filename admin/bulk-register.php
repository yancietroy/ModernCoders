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
            $queryOrg = "SELECT ORG_ID,ORG FROM tb_orgs WHERE ORG_TYPE_ID = 1";
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


            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $fn = $line[2]  ?? NULL;
                $ln = $line[1]  ?? NULL;
                $mn = $line[3]  ?? NULL;
                $date =  $line[6]  ?? NULL;
                $age = $line[7]  ?? NULL;
                $g =  $line[8]  ?? NULL;
                $si =  $line[0]  ?? NULL;
                $yl =  $line[9]  ?? NULL;
                $cd =  $collegeData[$line[11]]  ?? NULL;
                $course =  $line[12]  ?? NULL;
                $morgid =  $orgData[$line[13]]  ?? NULL;
                $section =  $line[10]  ?? NULL;
                $e = $line[4]  ?? NULL;
                $pass =  $line[5]  ?? NULL;
                $pp = "avatar-default.png";
                $ul = "1";
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT ID FROM tb_students WHERE EMAIL = '".$line[4]."'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE tb_students SET FIRST_NAME = '".$fn."', MIDDLE_NAME = '".$mn."', LAST_NAME = '".$ln."', EMAIL = '".$e."', BIRTHDATE = '".$date."', AGE = '".$age."', GENDER = '".$g."', YEAR_LEVEL = '".$yl."', COLLEGE_DEPT = '".$cd."', COURSE = '".$course."', MORG_ID = '".$morgid."', SECTION = '".$section."' WHERE EMAIL = '".$e."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL, COLLEGE_DEPT, COURSE, MORG_ID, SECTION, EMAIL, PASSWORD, ACCOUNT_CREATED, PROFILE_PIC, USER_TYPE)
                    VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$cd', '$course', '$morgid', '$section', '$e', SHA('$pass'), NOW(), '$pp', '$ul')");
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
