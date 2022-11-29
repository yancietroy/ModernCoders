<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = "";
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
  if ($orgRes->num_rows > 0) {
    $row = $orgRes->fetch_assoc();
    $orgName = $row['ORG'];
  } else {
    header('location:admin-orgs.php');
  }
}

$_SESSION['ORG'] = $orgName;
$_SESSION['ORG_ID'] = $orgid;

$logoPic = getOrgLogo($orgid);
$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Site Management", "admin-users.php", ""],
  ["Organizations", "admin-orgs.php", ""],
  [$orgName, "admin-orgs-rso.php?id=$orgid", ""],
  ["Org Profile", "", ""],
];

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

  <!-- Datatable Default-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h3 id="rsotitle">Student Organization Profile</h3>
        </div>
        <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
          <!--<a class="btn btn-secondary bg-secondary btn-circle button px-3 ms-2" href="admin-orgs-rso-archive.php" role="button"><i class="bi bi-archive-fill"></i> <span id="btntitle">Member Archive</span></a>-->
        </div>
      </div>

      <div class="student-profile py-4 px-5">
        <div class="container-lg">
          <div class="row">
            <div class="col-lg-4 mb-4 col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center">
                  <div class="container">
                    <img class="profile_img" src="<?= $logoPic ?>" id="profile-pic" alt="">
                    <div class="middle">
                      <div class="upload-button"><i class="bi bi-pencil-square"></i></div>
                      <input class="file-upload" type="file" name=logoPic id=logoPic accept="image/*" />
                    </div>
                  </div>
                  <h3 class="pt-3"><?= "$orgName"; ?></h3>
                </div>
                <div class="card-body text-center">
                  <p class="mb-0"><strong class="pr-1">ORG ID:</strong><?php echo $orgid; ?></p>
                  <!--<p class="mb-0"><strong class="pr-1">Academic Year:</strong></p>-->
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-12 ">
              <div class="card shadow-sm" id="card-large">
                <div class="card-header bg-transparent border-0">
                  <h3 class="mb-0 pt-2"><i class="far fa-clone pr-1"></i>Student Organization Information</h3>
                </div>
                <div class="card-body mt-2 pt-0">
                  <table class="table table-bordered" id="proftable">

                    <tr>
                      <th width="30%">ORG NAME</th>
                      <td width="2%">:</td>
                      <td><?php echo $orgName; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">ORG TYPE</th>
                      <td width="2%">:</td>
                      <td><?php
                            $checkType = "SELECT org_type_id FROM tb_orgs WHERE ORG_ID = '$orgid'";
                            $result = @mysqli_query($conn, $checkType);
                            $row = @mysqli_fetch_array($result);
                            $typeID = $row[0];
                              if($typeID == 1)
                              {
                                echo "Academic Organization";
                              }else
                              {
                                echo "Non-Academic Organization";
                              }

                          ?>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">College</th>
                      <td width="2%">:</td>
                      <td><?php
                            $query = "SELECT tb_collegedept.college FROM tb_orgs JOIN tb_collegedept ON tb_collegedept.college_id = tb_orgs.college_id WHERE tb_orgs.ORG_ID = '$orgid'";
                            $result = @mysqli_query($conn, $query);
                            $row = @mysqli_fetch_array($result);
                            if(isset($row[0]) == NULL)
                            {
                              echo "No College affiliated";
                            }else
                            {
                              echo $row[0];
                            }
                          ?>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Status</th>
                      <td width="2%">:</td>
                      <td>Active</td>
                    </tr>

                    <tr>
                      <th width="30%">School Year</th>
                      <td width="2%">:</td>
                      <td>2022-2023</td>
                    </tr>
                    <tr>
                      <th width="30%">Student Advisers</th>
                      <td width="2%">:</td>
                      <td><?php
                            $query = "SELECT CONCAT(first_name, ' ', last_name) AS NAME FROM tb_signatories WHERE org_id = '$orgid'";
                            $result = @mysqli_query($conn, $query);
                            $a = " ";
                            if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $a = $row['NAME'];
                              echo "$a</br>";

                            }
                            }
                            elseif(isset($row['NAME']) == NULL)
                            {
                              echo "No Advisers";
                            }
                          ?></td>
                    </tr>
                  </table>
                  <div class="card-body mt-2 p-0 w-100 pt-0" id="card-show">
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">ORG NAME:<br></strong> <?php echo $orgName; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">ORG TYPE:<br></strong>
                          <?php
                            $checkType = "SELECT org_type_id FROM tb_orgs WHERE ORG_ID = '$orgid'";
                            $result = @mysqli_query($conn, $checkType);
                            $row = @mysqli_fetch_array($result);
                            $typeID = $row[0];
                              if($typeID == 1)
                              {
                                echo "Academic Organization";
                              }else
                              {
                                echo "Non-Academic Organization";
                              }

                          ?>
                    </p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">College:<br></strong>
                          <?php
                            $query = "SELECT tb_collegedept.college FROM tb_orgs JOIN tb_collegedept ON tb_collegedept.college_id = tb_orgs.college_id WHERE tb_orgs.ORG_ID = '$orgid'";
                            $result = @mysqli_query($conn, $query);
                            $row = @mysqli_fetch_array($result);
                            if(isset($row[0]) == NULL)
                            {
                              echo "No College affiliated";
                            }else
                            {
                              echo $row[0];
                            }
                          ?>
                    </p>
                  </div>
                  <div class="d-grid gap-2 pb-0 mb-0 d-md-flex justify-content-end">
                    <?php echo "<button type='button' class='btn btn-primary btn-sm viewbtn' id='" . $orgid . "' >Edit Organization</button>"; ?>
                  </div>
                </div>

              </div>
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
  <!-- org Modal -->
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> View Organization Details </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-update-org.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG_ID">Organization ID:</label>
                    <input type="text" name="ORG_ID" id="ORG_ID" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG">Organization name:</label>
                    <input type="text" name="ORG" id="ORG" class="form-control" maxlength="100" style="background-color: #fff;" />
                  </div>
                </div>
                <div class="col-12 col-md-6  mb-4">
                  <label class="form-label">College Department</label>
                  <select class="form-select" style="width:100%;" name="college_id" id="college_id">
                    <option class="greyclr" selected disabled value="">Select College</option>
                    <?php
                    $query = "SELECT * FROM tb_collegedept";
                    $result = @mysqli_query($conn, $query);
                    while ($data = @mysqli_fetch_array($result)) {
                      echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG_ID">Status</label>
                    <input type="text" name="ORG_ID" id="ORG_ID" class="form-control" style="background-color: #fff;"  />
                  </div>
                </div>
                <div class="col-12 col-md-4  mb-4">
                  <label class="form-label">School Year</label>
                  <input type="text" name="ORG" id="ORG" class="form-control" maxlength="100" style="background-color: #fff;" />
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="signatory_id">Student Adviser</label>
                    <select class="form-select" style="width:100%;" name="signatory_id" id="signatory_id">
                      <option class="greyclr" selected disabled value="">Select Adviser</option>
                      <?php
                      $query = "SELECT CONCAT(first_name, ' ', last_name) AS name, school_id FROM tb_signatories WHERE signatorytype_id=4 AND org_id IS NULL";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[1] . '">' . $data[0] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer py-2 px-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="updateOrgProfile" class="btn btn-success">Update Org</button>
          </div>
      </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <script>
    $(document).on('click', '.viewbtn', function() {
      var ORG_ID = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-org.php",
        method: "POST",
        data: {
          ORG_ID: ORG_ID
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#ORG_ID').val(data.ORG_ID);
          $('#ORG').val(data.ORG);
          $('#college_id').val(data.college_id);
          $('#viewmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#logoPic').change(function() {
        var file_data = $('#logoPic').prop('files')[0];
        var form_data = new FormData();
        form_data.append('logoPic', file_data);
        $.ajax({
          url: "admin-update-org-pic.php",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            console.log(data);
            location.reload();
          }
        });
      });
    });
  </script>
  <?php $conn->close(); ?>
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
  <!--image upload-->
  <script>
    $(document).ready(function() {


      var readURL = function(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('.profile-pic').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }


      $(".file-upload").on('change', function() {
        readURL(this);
      });

      $(".upload-button").on('click', function() {
        $(".file-upload").click();
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#admin-user-table').DataTable({
        responsive: true,
        keys: true,
        fixedheader: true,
        bautoWidth: false,
        dom: 'Bfrtip',
        "bFilter": true,
        "columns": [{
            "width": "90px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "80px"
          },
          {
            "width": "150px"
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -  Signatory Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            },
          },
          //{
          //  extend: 'csvHtml5',
          //    title: 'JRU Organizations Portal - Officer Pending List',
          //    footer: true,
          //    customize: function (csv) {
          //     return "JRU Organizations Portal - Officer Pending List\n\n"+  csv;
          //    },
          //    exportOptions: {
          //      columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
          //  },
          //    } ,
          {
            extend: 'pdfHtml5',
            title: 'JRU Organizations Portal - Signatory Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            },
            orientation: 'portrait',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -  Signatory Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            },
            customize: function(win) {

              var last = null;
              var current = null;
              var bod = [];

              var css = '@page { size: portrait; font-size: 1em;}',
                head = win.document.head || win.document.getElementsByTagName('head')[0],
                style = win.document.createElement('style');

              style.type = 'text/css';
              style.media = 'print';

              if (style.styleSheet) {
                style.styleSheet.cssText = css;
              } else {
                style.appendChild(win.document.createTextNode(css));
              }

              head.appendChild(style);
            }
          },
        ]
      });
      myTable.columns.adjust().draw();
    });
  </script>
  <script src="../assets/js/age-validation.js"></script>
  <?php
  include('include/sweetalert.php');
  ?>
</body>

</html>
