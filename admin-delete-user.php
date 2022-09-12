<?php
include('mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){
        
        /**$fn = $_POST['FIRST_NAME'];
        $ln = $_POST['LAST_NAME'];
        $mn = $_POST['MIDDLE_NAME'];
        $date = $_POST['BIRTHDATE'];
        $age = $_POST['AGE'];
        $g = $_POST['GENDER'];
        $si = $_POST['STUDENT_ID'];
        $yl = $_POST['YEAR_LEVEL'];
        $course = $_POST['COURSE'];
        $morgid = $_POST['MORG_ID'];
        $section = $_POST['SECTION'];
        $e = $_POST['EMAIL'];
        $pass = $_POST['PASSWORD'];

        $query = "INSERT INTO tb_students_archive(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL, COURSE, MORG_ID, SECTION, EMAIL, PASSWORD) VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$course', '$morgid', '$section', '$e', '$pass')";**/
        $query = "INSERT tb_students_archive SELECT * FROM tb_students WHERE STUDENT_ID='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {
            
            $query = "DELETE FROM tb_students WHERE STUDENT_ID='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $_SESSION['msg'] = '<script>alert("Data Deleted")</script>';
                header("Location:admin-user.php");
            }
            else
            {
                echo '<script> alert("Data Not Deleted"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    } 
}
?>