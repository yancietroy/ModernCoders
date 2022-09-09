<?php
    include('mysql_connect.php');

    if (isset($_POST['updatedata']))
    {
        $id = $_POST['project_id'];
        $pn = $_POST['project_name'];
        $v = $_POST['venue'];
        $sd = $_POST['start_date'];
        $ed = $_POST['end_date'];
        $pt = $_POST['project_type'];
        $bs = $_POST['budget_source'];
        $pc = $_POST['project_category'];
        $p = $_POST['participants'];
        $b = $_POST['beneficiary'];
        $nop = $_POST['no_of_participants'];
        $nob = $_POST['no_of_beneficiary'];
        $eb = $_POST['estimated_budget'];
        $pd = $_POST['project_desc'];
        $s = "Pending";

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
                `budget_source` ='$bs',
                `project_category` ='$pc',
                `participants` ='$p',
                `beneficiary` ='$b',
                `no_of_participants` ='$nop',
                `no_of_beneficiary` ='$nob',
                `estimated_budget` ='$eb',
                `project_desc` ='$pd',
                `status` ='$s'
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
              alert('Status updated!')
              window.location.href='officer-revision.php'</script>";
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
                `status` ='$s'
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-done.php'</script>";
        }
    } else if(isset($_POST['Cancel']))
    {
        $id = $_POST['project_id'];
        $s = "Cancelled";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET
                `status` ='$s'
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-cancelled.php'</script>";
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
                `status` ='$s'
                WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='officer-ongoing.php'</script>";
        }
    }
@mysqli_close($conn);
?>
