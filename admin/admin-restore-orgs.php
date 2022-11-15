<?php
include('../mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['ORG_ID'])){

        $query = "INSERT tb_orgs SELECT * FROM tb_orgs_archive WHERE ORG_ID='".$_POST["ORG_ID"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_orgs_archive WHERE ORG_ID='".$_POST["ORG_ID"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Restored Organization!')
                    window.location.href='admin-orgs-archive.php'</script>";
            }
            else
            {
                echo '<script> alert("Org Not Deleted"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Org Not Deleted"); </script>';
        }
    }
}
?>