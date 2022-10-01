<?php

$query = "SELECT * FROM tb_students WHERE STUDENT_ID = '$id'";
$result = @mysqli_query($conn, $query);
$data = @mysqli_fetch_array($result);
$profilePic = $data['PROFILE_PIC'];
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
