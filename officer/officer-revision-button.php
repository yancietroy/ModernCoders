<?php
    include('../mysql_connect.php');
    session_start();
    $mysqli = new mysqli("$servername","$username","$password","$database");

        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }

    if (isset($_POST['updatedata']) || isset($id) || isset($pn) || isset($v) || isset($sd) || isset($ed) || isset($pt) || isset($or) || isset($pc) || isset($p) || isset($std) || isset($br) || isset($eb) || isset($obj) || isset($pname) || isset($tname))
    {
        $id = $_POST['project_id'];
        $pn = $mysqli -> real_escape_string  ($_POST['project_name']);
        $v = $mysqli -> real_escape_string  ($_POST['venue']);
        $sd = $mysqli -> real_escape_string  ($_POST['start_date']);
        $ed = $mysqli -> real_escape_string  ($_POST['end_date']);
        $pt = $mysqli -> real_escape_string  ($_POST['project_type']);
        $or = $mysqli -> real_escape_string  ($_POST['organizer']);
        $pc = $mysqli -> real_escape_string  ($_POST['project_category']);
        $p = $mysqli -> real_escape_string  ($_POST['participants']);
        $std = $mysqli -> real_escape_string  ($_POST['status_date']);
        $eb =  $mysqli -> real_escape_string ($_POST['estimated_budget']);
        $obj = $mysqli -> real_escape_string  ($_POST['objectives']);
        $s = "Pending";
        $ati = 1;

        $budgetitems = [];
        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, "payment-")) {
                $tag = explode("-", $key)[1];
                array_push($budgetitems, $_POST["budgetdesc-$tag"] . "::" . $value);
            }
        }

        $items = implode(";;", $budgetitems);
        $items = $mysqli->real_escape_string($items);

        $fileName = rand(1000, 100000) . "-" . $_FILES['attachments']['name'];
        $fileDestination = 'attachments/' . $fileName;
        $tfileName = $_FILES['attachments']['tmp_name'];
        move_uploaded_file($tfileName, $fileDestination);

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `project_name` ='$pn',
                `venue` ='$v',
                `start_date` ='$sd',
                `end_date` ='$ed',
                `project_type` ='$pt',
                `objectives` ='$obj',
                `project_category` ='$pc',
                `participants` ='$p',
                `organizer` ='$or',
                `budget_req` ='$items',
                `estimated_budget` ='$eb',
                `status` ='$s',
                `approval_id` = '$ati',
                `status_date` = NOW(),
                `attachments` = '$fileName'    
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to pending.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }else{
                $_SESSION["sweetalert"] = [
                    "title" => "Status Update",
                    "text" => "There was an error upon updating your project details.",
                    "icon" => "error", //success,warning,error,info
                    "redirect" => null,
                ];

            }
            header("location:officer-pending.php");
        }
    } else if(isset($_POST['Done']) || isset($id))
    {
        $id = $_POST['project_id'];
        $s = "Done";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `status` ='$s', `status_date` = NOW()
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Successfully updated your project details.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }else{
                $_SESSION["sweetalert"] = [
                    "title" => "Status Update",
                    "text" => "There was an error upon updating your project details.",
                    "icon" => "error", //success,warning,error,info
                    "redirect" => null,
                ];

            }
        }
            header("location:officer-done.php");
    } else if(isset($_POST['Cancel']) || isset($id))
    {
        $id = $_POST['project_id'];
        $s = "Reschedule";

        $budgetitems = [];
        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, "payment-")) {
                $tag = explode("-", $key)[1];
                array_push($budgetitems, $_POST["budgetdesc-$tag"] . "::" . $value);
            }
        }

        $items = implode(";;", $budgetitems);
        $items = $mysqli->real_escape_string($items);

        $fileName = rand(1000, 100000) . "-" . $_FILES['attachments']['name'];
        $fileDestination = 'attachments/' . $fileName;
        $tfileName = $_FILES['attachments']['tmp_name'];
        move_uploaded_file($tfileName, $fileDestination);

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `status` ='$s', 
                `status_date` = NOW(),
                `budget_req` ='$items',
                `attachments` = '$fileName'
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "You have Rescheduled the project.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }else{
                $_SESSION["sweetalert"] = [
                    "title" => "Status Update",
                    "text" => "There was an error upon rescheduling your project.",
                    "icon" => "error", //success,warning,error,info
                    "redirect" => null,
                ];

            }
        }
            header("location:officer-reschedule.php");
    } else if(isset($_POST['Ongoing']) || isset($id))
    {
        $id = $_POST['project_id'];
        $s = "Ongoing";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `status` ='$s', `status_date` = NOW()
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Successfully updated your project details.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }else{
                $_SESSION["sweetalert"] = [
                    "title" => "Status Update",
                    "text" => "There was an error upon updating your project details.",
                    "icon" => "error", //success,warning,error,info
                    "redirect" => null,
                ];

            }
        }
            header("location:officer-ongoing.php");
    }
?>
