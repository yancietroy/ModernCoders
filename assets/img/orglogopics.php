<?php $query = "SELECT * FROM tb_orgs WHERE ORG_ID = '$orgid'";
      $result = @mysqli_query($conn, $query);
      $data = @mysqli_fetch_array($result);
      $logoPic = $data['logo'];
      $logoUserPic = "../assets/img/logos/" . $logoPic;
      $defaultLogoPic ="../assets/img/logos/jru-logo.png";
      $logoPic = (file_exists($logoUserPic)) ? $logoUserPic : $defaultLogoPic;
      /**if (file_exists('img/upload/groot/'. $user_id .'.jpg')) {
        $profilepic = $logoUserPic;
      }
      else
      {
        $profilepic = $defaultLogoPic;
      }**/
?>