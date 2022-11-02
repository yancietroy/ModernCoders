<?php
    include('../mysql_connect.php');

    if (isset($_POST['updatedata']))
    {
        $id = $_POST['project_id'];
        $pn = $_POST['project_name'];
        $v = $_POST['venue'];
        $sd = $_POST['start_date'];
        $ed = $_POST['end_date'];
        $pt = $_POST['project_type'];
        $or = $_POST['organizer'];
        $pc = $_POST['project_category'];
        $p = $_POST['participants'];
        $std = $_POST['status_date'];
        $rb = $_POST['requested_by'];
        $br = $_POST['budget_req'];
        $eb = $_POST['estimated_budget'];
        $obj = $_POST['objectives'];
        $s = "Pending";
        $ati = 1;

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
                `requested_by` ='$rb',
                `budget_req` ='$br',
                `estimated_budget` ='$eb',
                `status` ='$s',
                `approval_id` ='$ati',
                `status_date` = NOW()
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
              alert('Status updated!')
              window.location.href='officer-pending.php'</script>";
        }
    } else if(isset($_POST['Done']))
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
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-done.php'</script>";
        }
    } else if(isset($_POST['Cancel']))
    {
        $id = $_POST['project_id'];
        $s = "Reschedule";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `status` ='$s', `status_date` = NOW()
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-reschedule.php'</script>";
        }
    } else if(isset($_POST['Ongoing']))
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
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-ongoing.php'</script>";
        }
    }
@mysqli_close($conn);
?>
