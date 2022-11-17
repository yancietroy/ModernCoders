<?php
ob_start();
session_start();

include('../router.php');
route(1);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = $_SESSION['USER-ORGS'][$orgid] ?? "";

if ($orgid <= 0 || !array_key_exists($orgid, $_SESSION['USER-ORGS'])) {
  header("location:student-index.php");
}

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(1, $data_userid);
$nav_selected = "Organizations / $orgName";
$nav_breadcrumbs = [
  ["Home", "student-index.php", "bi-house-fill"],
  ["Organizations", "student-orgs.php", ""],
  ["$orgName", "rso.php?id=$orgid", ""],
  ["Survey", "", ""],
];


if (isset($_POST['submit-response'])) {
  $survey_id =  $mysqli->real_escape_string($_POST['survey-id']);
  $timestamp = time();
  $query = "INSERT INTO tb_survey_answers(survey_id,question_id,student_no,answer,submitted) VALUES ";

  $answers = [];
  foreach ($_POST as $key => $value) {
    if (str_starts_with($key, 'q-')) {
      $type = explode('-', $key)[1];
      $qid = explode('-', $key)[2];

      if ($type == 4) {
        if (count($value) == 0) {
          $answer = "-1";
        } else {
          $answer = "[" . implode("],[", $value) . "]";
        }
      } else if ($type >= 5 && $type <= 7) {
        $answer = "[$value]";
      } else {
        $answer = $value;
      }

      array_push($answers, "('$survey_id','$qid','$data_userid','$answer','$timestamp')");
    }
  }

  $query = $query . implode(",", $answers);
  if (@mysqli_query($conn, $query)) {
    echo "<script>alert('Response has been submitted successfully.')</script>";
  } else {
    echo "<script>alert('Unexpected error while submitting your response. Please try again.')</script>";
  }
}


$hasSurvey = false;

$curdate = date('Y-m-d');
$sql = "SELECT * FROM tb_surveys WHERE tb_surveys.org_id='$orgid' AND ('$curdate'>=tb_surveys.start_date AND '$curdate'<=tb_surveys.end_date)";
if ($res = @mysqli_query($conn, $sql)) {
  if ($res->num_rows > 0) {
    $hasSurvey = true;
    $row = $res->fetch_assoc();
    $survey_id = $row['survey_id'];
    $title = $row['title'];
    $description = $row['description'];
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
  }
}

// Check if already submitted a response
if ($hasSurvey) {
  $query = "SELECT answer_id FROM tb_survey_answers WHERE survey_id='$survey_id' AND student_no='$data_userid' LIMIT 0,1";
  if ($res = @mysqli_query($conn, $query)) {
    if ($res->num_rows > 0) $hasSurvey = false;
  }
}


if (isset($_SESSION['msg'])) {
  print_r($_SESSION['msg']); #display message
  unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
  <title>JRU Student Organizations Portal</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
  <!-- calendar
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script> !-->
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <?php include("include/sidebar.php") ?>

    <div id="content">

      <!-- Navbar/Header  -->
      <?php include("include/header.php") ?>

      <!-- breadcrumb -->
      <?php include("include/breadcrumb.php") ?>

      <!-- Page content -->
      <?php
      if ($hasSurvey) {
      ?>
        <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
          <div class="card-body px-2 mx-3 py-3 pt-4 ">

            <h3 class="ms-3 mb-4"> <?= $title ?></h3>
            <p class="ms-3"><?= $description ?></p>
            <h6 class="ms-3 mb-4"><strong class="pr-1 text-muted ">Availability:<br></strong><?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>
          </div>
        </div>
        <form action="" method="POST" class="survey-form w-100 p-5">
          <input type="text" name="survey-id" style="display: none;" value="<?= $survey_id ?>">
          <?php
          $query = "SELECT * FROM tb_survey_questions WHERE survey_id='$survey_id'";
          if ($result = @mysqli_query($conn, $query)) {
            $count = 0;
            while ($row = $result->fetch_assoc()) {
              $count++;
              $qType = $row['type'];

              if ($qType == 1) { // TextBox
          ?>
                <label for="q-<?= $row['question_id'] ?>"><?= $count . ". " . $row['question'] ?></label>
                <div class="field">
                  <input type="text" class="form-control" id="q-<?= $row['question_id'] ?>" name="q-1-<?= $row['question_id'] ?>" required>
                </div>
              <?php
              } else if ($qType == 2) { // Multiline TextBox
              ?>
                <label for="q-<?= $row['question_id'] ?>"><?= $count . ". " . $row['question'] ?></label>
                <div class="field">
                  <textarea class="form-control" id="q-<?= $row['question_id'] ?>" name="q-2-<?= $row['question_id'] ?>" required></textarea>
                </div>
              <?php
              } else if ($qType == 3) { // Numeric
              ?>
                <label for="q-<?= $row['question_id'] ?>"><?= $count . ". " . $row['question'] ?></label>
                <div class="field">
                  <input type="number" class="form-control" id="q-<?= $row['question_id'] ?>" name="q-3-<?= $row['question_id'] ?>" required>
                </div>
              <?php
              } else if ($qType == 4) { // Checkboxes
              ?>
                <div class="group pt-2">
                  <p><?= $count . ". " . $row['question'] ?></p>
                  <?php
                  $rawChoices = explode(";;", $row['choices']);
                  $answerCount = 0;
                  foreach ($rawChoices as $choice) {
                  ?>
                    <label for="c-<?= $row['question_id'] . "-" . $answerCount ?>">
                      <input type="checkbox" name="q-4-<?= $row['question_id'] ?>[]" id="c-<?= $row['question_id'] . "-" . $answerCount ?>" value="<?= $answerCount ?>">
                      <?= $choice ?>
                    </label>
                  <?php
                    $answerCount++;
                  }

                  ?>
                </div>
              <?php
              } else if ($qType == 5) { // Radiobuttons
              ?>
                <div class="group pt-2">
                  <p><?= $count . ". " . $row['question'] ?></p>
                  <?php
                  $rawChoices = explode(";;", $row['choices']);
                  $answerCount = 0;
                  foreach ($rawChoices as $choice) {
                  ?>
                    <label for="c-<?= $row['question_id'] . "-" . $answerCount ?>">
                      <input type="radio" name="q-5-<?= $row['question_id'] ?>" id="c-<?= $row['question_id'] . "-" . $answerCount ?>" value="<?= $answerCount ?>" <?= $answerCount == 0 ? "checked" : "" ?>>
                      <?= $choice ?>
                    </label>
                  <?php
                    $answerCount++;
                  }

                  ?>
                </div>
              <?php
              } else if ($qType == 6) { // Dropdown
              ?>
                <label for="q-<?= $row['question_id'] ?>"><?= $count . ". " . $row['question'] ?></label>
                <div class="field" style="font-weight: normal;font-size: 13px;">
                  <select class="px-3 py-2" name="q-6-<?= $row['question_id'] ?>" id="q-<?= $row['question_id'] ?>">
                    <?php
                    $rawChoices = explode(";;", $row['choices']);
                    $answerCount = 0;
                    foreach ($rawChoices as $choice) {
                    ?>
                      <option value="<?= $answerCount ?>"><?= $choice ?></option>
                    <?php
                      $answerCount++;
                    }

                    ?>
                  </select>
                </div>
              <?php
              } else if ($qType == 7) { // Rating
                $ratings = explode(";;", $row['choices']);
              ?>
                <p><?= $count . ". " . $row['question'] ?></p>
                <div class="rating">
                  <input type="radio" name="q-7-<?= $row['question_id'] ?>" id="radio1" value="0">
                  <label for="radio1" title="<?= $ratings[0] ?? "" ?>">1</label>

                  <input type="radio" name="q-7-<?= $row['question_id'] ?>" id="radio2" value="1">
                  <label for="radio2" title="<?= $ratings[1] ?? "" ?>">2</label>

                  <input type="radio" name="q-7-<?= $row['question_id'] ?>" id="radio3" value="2">
                  <label for="radio3" title="<?= $ratings[2] ?? "" ?>">3</label>

                  <input type="radio" name="q-7-<?= $row['question_id'] ?>" id="radio4" value="3">
                  <label for="radio4" title="<?= $ratings[3] ?? "" ?>">4</label>

                  <input type="radio" name="q-7-<?= $row['question_id'] ?>" id="radio5" value="4" checked>
                  <label for="radio5" title="<?= $ratings[4] ?? "" ?>">5</label>
                </div>
                <div class="rating-footer mb-3">
                  <span><?= $ratings[0] ?? "Very Unsatisfied" ?></span>
                  <span><?= $ratings[count($ratings) - 1] ?? "Very Satisfied" ?></span>
                </div>

          <?php
              }
            }
          }
          ?>

          <div class="buttons mt-3 text-center">
            <input type="submit" class="btn" name="submit-response" value="Submit Response">
          </div>
        </form>
      <?php
      } else {
      ?>
        <div class="text-center">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-5">No Survey</h1>
              <p class="lead">There is no active survey at the moment.</p>
            </div>
          </div>
        </div>
      <?php
      }

      ?>

      <div id="layoutAuthentication_footer">
        <footer class="py-2 bg-light">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Modern Coders 2022</div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!--WAVES CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
</body>

</html>
