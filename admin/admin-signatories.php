<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../admin-login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JRU Student Organizations Portal</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">

</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="admin-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
      <li class="active">
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
              <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
            </li>
            <li  class="active">
              <a href="admin-signatories.php"><i class="bi bi-person-check-fill"></i> <span>Signatories</span></a>
            </li>
            <li>
              <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
          <ul class="collapse list-unstyled" id="orgsSubmenu">
            <li>
              <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
          </li>
          <li>
              <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
          </li>
          <li>
              <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
            </li>
        </ul>
      </li>
      <li>
        <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
      </li>
      <li>
        <a href="admin-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
      </li>
      <li class="d-lg-none">
        <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>
      </li>

      </ul>
      <!-- nav footer?
      <ul class="list-unstyled CTAs">
        <li>
          <a>about</a>
        </li>
        <li>
          <a>logout</a>
        </li>
      </ul> -->
    </nav>
    <!-- Navbar  -->
    <div id="content">

      <nav class="navbar shadow navbar-expand navbar-light bg-light" aria-label="navbar" id="topbar">
        <div class="container-fluid">
          <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell me-lg-2 mt-2" style="width:  25px; height:  25px;"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle me-lg-2" src="../assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="admin-profile.php">Profile</a></li>
                    <li>
                      <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../admin-login.php">Logout</a></li>
                  </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Signatories</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h4>Signatory User Management</h4>
        </div>
        <div class="col-lg-6 col-7 mb-2 d-flex align-items-end justify-content-end">
          <a class="btn btn-default btn-circle button px-3" href="admin-signatory-reg.php" role="button"><i class="bi bi-plus-circle-fill"></i> New Signatory</a>
        </div>
      </div>
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-sm-6">
          <div class="card-counter primary">
            <div class="inner">
              <h2><i class="bi bi-person-circle"></i></h2>
              <p>Masterlist</p>
            </div>
            <div class="icon">
              <i class="bi bi-file-person" aria-hidden="true"></i>
            </div>
            <a href="admin-signatories-users.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6">
          <div class="card-counter bg-secondary">
            <div class="inner">
              <h2><i class="bi bi-archive-fill"></i></h2>
              <p>Archive</p>
            </div>
            <div class="icon">
              <i class="bi bi-archive"></i>
            </div>
            <a href="admin-archive-signatories.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        </div>

      </div>

        <!-- Footer -->
      <div id="layoutAuthentication_footer">
        <footer class="py-2 bg-light mt-3">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Modern Coders 2022</div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    </div>
  <!-- Student Modal -->
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Signatory Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="admin-update-signatories.php" method="POST">
                    <div class="modal-body">
                      <div class="container-md">
                        <div class="row justify-content-between">
                       <div class="col-4 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="school_id" >JRU ID:</label>
                           <input type="text" name="school_id" id="school_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4">
                       <div class="form-outline">
                         <label class="form-label" for="date_submitted" >Account Created:</label>
                         <input type="text" name="date_submitted" id="date_submitted" class="form-control" style="background-color: #fff;" readonly />
                       </div>
                     </div>
                       </div>
                        <div class="row justify-content-between">
                        <div class="col-12 col-md-6 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="first_name" >First name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-lg"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" required  />
                          </div>
                        </div>
                          <div class="col-12 col-md-6 mb-4">
                          <label class="form-label" for="last_name" >Last Name:</label>
                          <input type="text" name="last_name" id="last_name" class="form-control form-control-lg"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" required  />
                          </div>
                          </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="email" >Email:</label>
                            <input type="text" name="email" id="email" class="form-control"  pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30" required  />
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="signatory_type" >Signatory Type:</label>
                              <input type="text" name="signatory_type" id="signatory_type" class="form-control" style="background-color: #fff;" readonly/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="org_id" >Organization:</label>
                              <select class="form-select" name="org_id" id="org_id">
                              <?php
                                $query = "SELECT org_id, org FROM tb_orgs";
                                $result = @mysqli_query($conn, $query);
                                        while($data = @mysqli_fetch_array($result)) {
                                            echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                        }
                              ?>
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-2 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
  </div>
  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-3 px-3">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="admin-delete-signatories.php" method="POST">
                    <div class="modal-body">
                      <div class="col-12 col-md-12 justify-content-center ">
                        <div class="form-outline">
                           <label class="form-label" for="delete_id" >School ID:</label>
                           <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                        <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Permanently delete user data? This cannot be undone.</p>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="deletedata" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        $(document).on('click', '.viewbtn', function(){
           var school_id = $(this).attr("id");
           $.ajax({
                url:"admin-fetch-signatories.php",
                method:"POST",
                data:{school_id:school_id},
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#school_id').val(data.school_id);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#signatory_type').val(data.signatory_type);
                $('#viewmodal').modal('show');
                $('#modal-lg').css('max-width','70%');
                }
            });

            document.getElementById("first_name").addEventListener("input", forceLower);
            document.getElementById("last_name").addEventListener("input", forceLower);
            // Event handling functions are automatically passed a reference to the
            // event that triggered them as the first argument (evt)
            function forceLower(evt) {
              // Get an array of all the words (in all lower case)
              var words = evt.target.value.toLowerCase().split(/\s+/g);

              // Loop through the array and replace the first letter with a cap
              var newWords = words.map(function(element) {
                // As long as we're not dealing with an empty array element, return the first letter
                // of the word, converted to upper case and add the rest of the letters from this word.
                // Return the final word to a new array
                return element !== "" ? element[0].toUpperCase() + element.substr(1, element.length) : "";
              });

              // Replace the original value with the updated array of capitalized words.
              evt.target.value = newWords.join(" ");
            }
        });
    </script>
    <script>
      $(document).on('click', '.deletebtn', function(){
        var school_id = $(this).attr("id");
        $.ajax({
                url:"admin-fetch-signatories.php",
                method:"POST",
                data:
                {
                  school_id:school_id
                },
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#delete_id').val(data.school_id);
                $('#deletemodal').modal('show');
                }
            });
        });
    </script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <!-- Sidebar collapse -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });
      });
    </script>
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
   <script>
    $(document).ready(function() {
        $('#admin-user-table').DataTable( {
          responsive: true,
          keys: true,
          fixedheader:true,
          bautoWidth:false,
         dom: 'Bfrtip',"bFilter": true,
         "columns": [
        { "width": "90px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "80px" },
        { "width": "150px" }
  ],
            select: 'single',
    buttons: [
   'pageLength',
      {
        extend: 'csvHtml5',
        title: 'JRU Organizations Portal Student Users'
      },
      {
        extend: 'pdfHtml5',
        title: 'JRU Organizations Portal Student Users'
      },
      {
        extend: 'print',
        title: 'JRU Organizations Portal Student Users'
      },
    ]
  });
    });
    </script>
  <script src="../assets/js/age-validation.js"></script>
</body>

</html>
