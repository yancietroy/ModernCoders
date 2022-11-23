<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_username = $_SESSION['USER-NAME'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Projects";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
  ["Projects", "officer-projects.php", ""],
  ["Create New Project", "create-project.php", "bi-plus-circle-fill"],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datepicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>
<style>
  table,
  td,
  th {
    border: 1px solid #00226C;
    text-align: center;
  }

  th {
    background-color: #00226C;
    ;
    color: white;
    padding-right: 20px;
    padding-left: 10px;
  }
</style>

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
      <form action="" method="post" class="requires-validation" enctype="multipart/form-data" autocomplete="off" data-parsley-validate data-parsley-trigger="keyup" data-parsley-errors-messages-disabled parsley-use-html5-constraints>
        <div class="row ms-3 me-3 mt-2">
          <div class="col-lg-6 col-6  mb-4">
            <h4>Create New Project</h4>
          </div>
        </div>
        <div class="wrap shadow px-5 py-4 mx-auto mb-4">
          <div class="row ms-3 me-3 text-center ">
            <div class="col-lg-12 col-12">
              <h7 id="titlejru">Jose Rizal University</h7>
            </div>
          </div>
          <div class="row ms-3 me-3 text-center mb-2">
            <div class="col-lg-12 col-12  mb-4">
              <h3 id="titleproj">Activity Proposal Form</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="project_name" id="asterisk">Project name:</label>
                <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" maxlength="50" required />
                <div class="valid-feedback"></div>

              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="organizer" id="asterisk">Organizer/s:</label>
                <input type="text" name="organizer" id="organizer" class="form-control" maxlength="200" required />
                <div class="valid-feedback"></div>

              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="venue" id="asterisk">Venue:</label>
                <input type="text" name="venue" id="venue" class="form-control" maxlength="50" required />
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-4 col-sm-3 mb-4">
              <label class="form-label select-label" for="project_type" id="asterisk">Project Type:</label>
              <select class="mt-0 ms-0 form-select" name="project_type" id="project_type" required>
                <option class="greyclr" selected disabled value="">Select Type</option>
                <option value="Curricular">Curricular</option>
                <option value="Extra Curricular">Extra Curricular</option>
                <option value="Outreach">Outreach</option>
                <option value="Seminar">Seminar</option>
                <option value="Competition">Competition</option>
                <option value="Assembly">Assembly</option>
                <option value="Socialization/Teambuilding">Socialization/Teambuilding</option>
                <option value="Student Learning Circle">Student Learning Circle</option>
                <option value="Showcase">Showcase</option>
                <option value="Other">Other</option>
              </select>
              <div class="valid-feedback"> </div>

            </div>
            <div class="col-12 col-md-4 col-sm-3 mb-4">
              <label class="form-label select-label" for="project_category" id="asterisk">Category:</label>
              <select class="mt-0 ms-0 form-select" name="project_category" id="project_category" required>
                <option class="greyclr" selected disabled value="">Select Category</option>
                <option value="Onsite">Onsite</option>
                <option value="Online">Online</option>
                <option value="Hybrid">Hybrid</option>
              </select>
              <div class="valid-feedback"> </div>
            </div>
            <div class="col-12 col-md-4 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="participants" id="asterisk">Participants:</label>
                <input type="text" name="participants" id="participants" class="form-control" maxlength="100" required />
                <div class="valid-feedback"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="start_date" id="asterisk">Start Date:</label>
                <input type="text" class="form-control" name="start_date" id="start_date" onkeydown="return false;" value="" required />
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="end_date" id="asterisk">End Date:</label>
                <input type="text" class="form-control" name="end_date" id="end_date" onkeydown="return false;" value="" required />
                <div class="valid-feedback"></div>
              </div>
            </div>
            <!--
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="no_of_participants" id="asterisk">No. of Participants:</label>
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_participants" maxlength="4" id="no_of_participants" class="form-control" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Number of Participants field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="beneficiary" id="asterisk">Beneficiary:</label>
                <input type="text" name="beneficiary" id="beneficiary" class="form-control"  maxlength="50" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Beneficiary field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="no_of_beneficiary" id="asterisk">No. of Beneficiary:</label>
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_beneficiary" maxlength="4" id="no_of_beneficiary" class="form-control" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Number of Beneficiary field cannot be blank!</div>
              </div>
            </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <label class="form-label select-label" for="budget_source" id="asterisk">Budget Request:</label>
              <select class="mt-0 ms-0 form-select" name="budget_source" id="budget_source" required>
                <option class="greyclr" selected disabled value="" >Select Budget Source</option>
                <option value="Student Council">Student Council</option>
                <option value="Organization">Student Organization</option>
                <option value="Accounting Office">Accounting Office</option>
                <option value="Third Party">Third Party</option>
                <option value="Third Party">None</option>
              </select>
              <div class="valid-feedback">  </div>
              <div class="invalid-feedback">Category field cannot be blank!</div>
              <label class="form-label mt-4" for="estimated_budget" id="asterisk">Estimated Budget:</label>
              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control currency" required />
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">Budget field cannot be blank!</div>
            </div>-->

          </div>

          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="objectives" id="asterisk">Objectives:</label>
                <textarea class="form-control" name="objectives" id="objectives" rows="3" placeholder="Enter project objectives and details." required></textarea>
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="budget_req" id="asterisk">Budget Request:</label>
                <input type="text" class="form-control" maxlength="2" id="numOfRows" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Item Quantity" required />
                <div class="valid-feedback"></div>
              </div>
              <div id="amortizationTable" class="table-responsive-xl mt-4"></div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4 pt-4">
              <button type="button" class="btn btn-primary mt-1 " id="amortTable">Get Budget Request Table</button>
            </div>
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="estimated_budget" id="asterisk">Estimated Budget:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" pattern="[0-9.,]+" class="form-control" name="estimated_budget" id="estimated_budget" style="background-color: #fff;" readonly />
                  <div class="valid-feedback"></div>
                </div>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label mb-2" for="attachments" id="asterisk">Upload Attachments:</label>
                <input class="form-control mt-3" name="attachments" id="attachments" type="file" accept=".zip,.rar,.7zip" id="formFileMultiple" required>
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-8 col-sm-3 mb-4">
              <small class="text-muted">*Note: Upload a zip file containing necessary documents in this form that will support your request
                (invitation letter, quotation of provider, Program of the Activity etc.) <br>

                *Note: Please attach other request form/ file
                (Facility Request, Announcement Request, Service/ Guest Pass, etc.) <br>
                *Note: Please be mindful about submitting project proposals during exam week</small>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <input class="btn btn-lg btn-outline-info" type="reset" value="Reset">
              <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit">
            </div>
          </div>
        </div>
        <?php
        $mysqli = new mysqli("$servername", "$username", "$password", "$database");

        if ($mysqli->connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli->connect_error;
          exit();
        }

        if (isset($pn) || isset($vn) || isset($pt) || isset($sdate) || isset($edate) || isset($o) || isset($pc)   || isset($p) || isset($obj) ||  isset($br) || isset($eb) || isset($_POST['submit'])) {
          // Escape special characters, if any
          $pn = $mysqli->real_escape_string($_POST['project_name']);
          $o = $mysqli->real_escape_string($_POST['organizer']);
          $vn = $mysqli->real_escape_string($_POST['venue']);
          $pt = $mysqli->real_escape_string($_POST['project_type']);
          $sdate = $mysqli->real_escape_string($_POST['start_date']);
          $edate = $mysqli->real_escape_string($_POST['end_date']);
          $pc = $mysqli->real_escape_string($_POST['project_category']);
          $p = $mysqli->real_escape_string($_POST['participants']);
          $obj = $mysqli->real_escape_string($_POST['objectives']);
          //$br = $mysqli->real_escape_string($_POST['budget_req']);
          $eb = $mysqli->real_escape_string($_POST['estimated_budget']);
          $s = "Pending";
          $aid = '1';
          $userName = $_SESSION['USER-NAME'];
          $posID = $_SESSION['USER-POS'];
          $collegeDept = $_SESSION['USER-COLLEGE'];

          $budgetitems = [];
          foreach ($_POST as $key => $value) {
            if (str_starts_with($key, "payment-")) {
              $tag = explode("-", $key)[1];
              array_push($budgetitems, $_POST["budgetdesc-$tag"] . "::" . $value);
            }
          }

          $items = implode(";;", $budgetitems);
          $items = $mysqli->real_escape_string($items);

          $pname = rand(1000, 100000) . "-" . $_FILES['attachments']['name'];
          $destination = 'attachments/' . $pname;
          $tname = $_FILES['attachments']['tmp_name'];
          move_uploaded_file($tname, $destination);

          $query = "INSERT INTO tb_projectmonitoring(project_name, organizer, venue, project_type, start_date, end_date, project_category, participants, objectives, budget_req, estimated_budget, date_submitted, status, attachments, status_date, requested_by, org_id, position_id, approval_id, college_id) VALUES('$pn', '$o', '$vn', '$pt', '$sdate', '$edate', '$pc', '$p', '$obj', '$items', '$eb', NOW(), '$s', '$pname', NOW(), '$userName', '$orgid', '$posID', '$aid', '$collegeDept')";
          $result = @mysqli_query($conn, $query);

          $sqlGetSignatories = "SELECT school_id FROM tb_signatories WHERE org_id='$orgid'";
          if ($resSignatories = @mysqli_query($conn, $sqlGetSignatories)) {
            if ($resSignatories->num_rows > 0) {
              $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
              $values = [];

              $timestamp = time();
              while ($signatory = $resSignatories->fetch_assoc()) {
                $uid = $signatory['school_id'];
                array_push($values, "('$timestamp','$uid','1','$pn','A new project has been created by $data_username.','')");
              }
              $SqlNotif .= implode(",", $values);

              @mysqli_query($conn, $SqlNotif);
            }
          }

          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Project Created',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";

          @mysqli_close($conn);
        }
        ?>
      </form>
      <!-- Footer -->
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
    <script src="../assets/js/date.js"></script>
    <!-- Datepicker cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(document).ready(function() {
        $('#start_date').datetimepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          formatTime: 'H:i',
          formatDate: 'm.d.Y',
          minDate: new Date()
        });

        $('#end_date').datetimepicker({
          dateFormat: "dd-M-yy",
          minDate: 0
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $('#start_date').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });
        $('#end_date').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });
      });
    </script>
    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }

  //    $('#estimated_budget').on("change keyup paste click", function(e) {
    //    setTimeout(() => {
    //      let parts = $(this).val().split(".");
    //      let v = parts[0].replace(/\D/g, ""),
      //      dec = parts[1]
      //    let calc_num = Number((dec !== undefined ? v + "." + dec : v));
          // use this for numeric calculations
          // console.log('number for calculations: ', calc_num);
    //      let n = new Intl.NumberFormat('en-EN').format(v);
    //      n = dec !== undefined ? n + "." + dec : n;
    //      $(this).val(n);
    //    })
    //  })
    </script>
    <script>
      $(document).ready(function() {
        $('#amortTable').click(function() {
          var i = $('#numOfRows').val();
          var s2 = "<table><th>Item No.</th><th>Description</th><th>Price</th>"
          for (var j = 0; j < i; j++) {
            s2 += "<tr><td>" + (j + 1) + "</td><td><input type='text' id='budgetdesc-" + (j + 1) + "' name='budgetdesc-" + (j + 1) + "'></td><td><input type='text'  maxlength='5' onkeypress=\"return /[0-9]/i.test(event.key)\" class='payment' id='payment-" + (j + 1) + "' name='payment-" + (j + 1) + "'/></td></tr>";
          }
          s2 += "<tr><td></td><td><input type='text' id='estimated_budget' readonly='readonly' style='background-color:#C0C0C0' /></td></tr></table>";
          $('#amortizationTable').html(s2);
        });

        $("#amortizationTable").on("change", ".payment", function() { // <-- Only changed this line
          var sum = 0;
          $(".payment").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
              sum += parseFloat(this.value);
            }
          });
          $('#estimated_budget').val(sum);
        });
      });
    </script>
    <script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>
