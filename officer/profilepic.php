<?php $query = "SELECT * FROM tb_officers WHERE officer_id = '$id'";
      $result = @mysqli_query($conn, $query);
      $data = @mysqli_fetch_array ($result);
      $profilePic = $data['profile_pic'];
      $userPic = "pictures/" . $profilePic;
      $defaultPic ="pictures/img_avatar.png";
      $profilepic = (file_exists($userPic)) ? $userPic : $defaultPic;
      /**if (file_exists('img/upload/groot/'. $user_id .'.jpg')) {
        $profilepic = $userPic;
      }
      else
      {
        $profilepic = $defaultPic;
      }**/
      ?>