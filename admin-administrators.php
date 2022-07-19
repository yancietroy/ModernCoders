<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:admin-login.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

<!-- Datatable Default
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
--><!-- Datatable BS5-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

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
          <img src="assets/img/jru-logo.png" alt="..." width="90" height="90">
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
                <a href="admin-users.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
                <a href="admin-officers.php"><i class="las la-chalkboard-teacher"></i> <span>Officers</span></a>
            </li>
            <li  class="active">
                <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
          <ul class="collapse list-unstyled" id="orgsSubmenu">
              <li>
                <a href="#"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-copy"></i> <span>Projects</span></a>
            </li>
            <li>
                <a href="#"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="#"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="#"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>
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
                  <img class="rounded-circle me-lg-2" src="assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex">John Doe</span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#!">Profile</a></li>
                  <li><a class="dropdown-item" href="#!">Settings</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="#!">About</a></li>
                  <li><a class="dropdown-item" href="admin-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
              <li class="breadcrumb-item" aria-label="desc"> <i class="bi bi-people-fill"></i> User Management</li>
          <li class="breadcrumb-item active" aria-current="page"><i class="ri-user-2-fill"></i> Administrators</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="table-responsive" id="tb">
  <div class="row justify-content-center align-items-center">
  <div class="col-md-11 ">
    <div class="row">
   <div class="col-xs-12">
                  <?php
                  $query = "SELECT ADMIN_ID, CONCAT(FIRST_NAME, ' ', LAST_NAME) AS NAME, EMAIL FROM tb_admin";
                  $result = @mysqli_query($conn,$query);
                  $i = 0;
                  $sid = " ";
                  $name = " ";
                  $email = " ";
                  $ylevel = " ";
                  $bdate = " ";
                  $age = " ";
                  echo "<table id='example' class='table table-striped table-hover' style='width:100%'>
                        <thead>
                          <tr>
                              <th>Admin ID</th>
                              <th>Name</th>
                              <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
                  if ($result !== false && $result->num_rows > 0)
                  {
                      // output data of each row
                      while($row = $result->fetch_assoc())
                      {
                      $sid = $row["ADMIN_ID"];
                      $name = $row["NAME"];
                      $email = $row["EMAIL"];

                      echo "<tr>
                            <td> $sid  </td>
                            <td> $name  </td>
                            <td> $email  </td>
                            </tr>
                          ";
                      }
                  echo "</tbody>
                        <tfoot>
                            <tr>
                                <th>ADMIN ID</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </tfoot>
                        </table>";
                  }
                  $conn->close();
                  ?>
                  <!--<thead>
                      <tr>
                          <th>Student ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Year Level</th>
                          <th>Birth date</th>
                          <th>Age</th>
                      </tr>
                      </thead>
                  <tbody>
                      <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011-04-25</td>
                          <td>$320,800</td>
                      </tr>
                      <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011-07-25</td>
                          <td>$170,750</td>
                      </tr>
                      <tr>
                          <td>Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          <td>66</td>
                          <td>2009-01-12</td>
                          <td>$86,000</td>
                      </tr>
                      <tr>
                          <td>Cedric Kelly</td>
                          <td>Senior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>22</td>
                          <td>2012-03-29</td>
                          <td>$433,060</td>
                      </tr>
                      <tr>
                          <td>Airi Satou</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>33</td>
                          <td>2008-11-28</td>
                          <td>$162,700</td>
                      </tr>
                      <tr>
                          <td>Brielle Williamson</td>
                          <td>Integration Specialist</td>
                          <td>New York</td>
                          <td>61</td>
                          <td>2012-12-02</td>
                          <td>$372,000</td>
                      </tr>
                      <tr>
                          <td>Herrod Chandler</td>
                          <td>Sales Assistant</td>
                          <td>San Francisco</td>
                          <td>59</td>
                          <td>2012-08-06</td>
                          <td>$137,500</td>
                      </tr>
                      <tr>
                          <td>Rhona Davidson</td>
                          <td>Integration Specialist</td>
                          <td>Tokyo</td>
                          <td>55</td>
                          <td>2010-10-14</td>
                          <td>$327,900</td>
                      </tr>
                      <tr>
                          <td>Colleen Hurst</td>
                          <td>Javascript Developer</td>
                          <td>San Francisco</td>
                          <td>39</td>
                          <td>2009-09-15</td>
                          <td>$205,500</td>
                      </tr>
                      <tr>
                          <td>Sonya Frost</td>
                          <td>Software Engineer</td>
                          <td>Edinburgh</td>
                          <td>23</td>
                          <td>2008-12-13</td>
                          <td>$103,600</td>
                      </tr>
                      <tr>
                          <td>Jena Gaines</td>
                          <td>Office Manager</td>
                          <td>London</td>
                          <td>30</td>
                          <td>2008-12-19</td>
                          <td>$90,560</td>
                      </tr>
                      <tr>
                          <td>Quinn Flynn</td>
                          <td>Support Lead</td>
                          <td>Edinburgh</td>
                          <td>22</td>
                          <td>2013-03-03</td>
                          <td>$342,000</td>
                      </tr>
                      <tr>
                          <td>Charde Marshall</td>
                          <td>Regional Director</td>
                          <td>San Francisco</td>
                          <td>36</td>
                          <td>2008-10-16</td>
                          <td>$470,600</td>
                      </tr>
                      <tr>
                          <td>Haley Kennedy</td>
                          <td>Senior Marketing Designer</td>
                          <td>London</td>
                          <td>43</td>
                          <td>2012-12-18</td>
                          <td>$313,500</td>
                      </tr>
                      <tr>
                          <td>Tatyana Fitzpatrick</td>
                          <td>Regional Director</td>
                          <td>London</td>
                          <td>19</td>
                          <td>2010-03-17</td>
                          <td>$385,750</td>
                      </tr>
                      <tr>
                          <td>Michael Silva</td>
                          <td>Marketing Designer</td>
                          <td>London</td>
                          <td>66</td>
                          <td>2012-11-27</td>
                          <td>$198,500</td>
                      </tr>
                      <tr>
                          <td>Paul Byrd</td>
                          <td>Chief Financial Officer (CFO)</td>
                          <td>New York</td>
                          <td>64</td>
                          <td>2010-06-09</td>
                          <td>$725,000</td>
                      </tr>
                      <tr>
                          <td>Gloria Little</td>
                          <td>Systems Administrator</td>
                          <td>New York</td>
                          <td>59</td>
                          <td>2009-04-10</td>
                          <td>$237,500</td>
                      </tr>
                      <tr>
                          <td>Bradley Greer</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>41</td>
                          <td>2012-10-13</td>
                          <td>$132,000</td>
                      </tr>
                      <tr>
                          <td>Dai Rios</td>
                          <td>Personnel Lead</td>
                          <td>Edinburgh</td>
                          <td>35</td>
                          <td>2012-09-26</td>
                          <td>$217,500</td>
                      </tr>
                      <tr>
                          <td>Jenette Caldwell</td>
                          <td>Development Lead</td>
                          <td>New York</td>
                          <td>30</td>
                          <td>2011-09-03</td>
                          <td>$345,000</td>
                      </tr>
                      <tr>
                          <td>Yuri Berry</td>
                          <td>Chief Marketing Officer (CMO)</td>
                          <td>New York</td>
                          <td>40</td>
                          <td>2009-06-25</td>
                          <td>$675,000</td>
                      </tr>
                      <tr>
                          <td>Caesar Vance</td>
                          <td>Pre-Sales Support</td>
                          <td>New York</td>
                          <td>21</td>
                          <td>2011-12-12</td>
                          <td>$106,450</td>
                      </tr>
                      <tr>
                          <td>Doris Wilder</td>
                          <td>Sales Assistant</td>
                          <td>Sydney</td>
                          <td>23</td>
                          <td>2010-09-20</td>
                          <td>$85,600</td>
                      </tr>
                      <tr>
                          <td>Angelica Ramos</td>
                          <td>Chief Executive Officer (CEO)</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2009-10-09</td>
                          <td>$1,200,000</td>
                      </tr>
                      <tr>
                          <td>Gavin Joyce</td>
                          <td>Developer</td>
                          <td>Edinburgh</td>
                          <td>42</td>
                          <td>2010-12-22</td>
                          <td>$92,575</td>
                      </tr>
                      <tr>
                          <td>Jennifer Chang</td>
                          <td>Regional Director</td>
                          <td>Singapore</td>
                          <td>28</td>
                          <td>2010-11-14</td>
                          <td>$357,650</td>
                      </tr>
                      <tr>
                          <td>Brenden Wagner</td>
                          <td>Software Engineer</td>
                          <td>San Francisco</td>
                          <td>28</td>
                          <td>2011-06-07</td>
                          <td>$206,850</td>
                      </tr>
                      <tr>
                          <td>Fiona Green</td>
                          <td>Chief Operating Officer (COO)</td>
                          <td>San Francisco</td>
                          <td>48</td>
                          <td>2010-03-11</td>
                          <td>$850,000</td>
                      </tr>
                      <tr>
                          <td>Shou Itou</td>
                          <td>Regional Marketing</td>
                          <td>Tokyo</td>
                          <td>20</td>
                          <td>2011-08-14</td>
                          <td>$163,000</td>
                      </tr>
                      <tr>
                          <td>Michelle House</td>
                          <td>Integration Specialist</td>
                          <td>Sydney</td>
                          <td>37</td>
                          <td>2011-06-02</td>
                          <td>$95,400</td>
                      </tr>
                      <tr>
                          <td>Suki Burks</td>
                          <td>Developer</td>
                          <td>London</td>
                          <td>53</td>
                          <td>2009-10-22</td>
                          <td>$114,500</td>
                      </tr>
                      <tr>
                          <td>Prescott Bartlett</td>
                          <td>Technical Author</td>
                          <td>London</td>
                          <td>27</td>
                          <td>2011-05-07</td>
                          <td>$145,000</td>
                      </tr>
                      <tr>
                          <td>Gavin Cortez</td>
                          <td>Team Leader</td>
                          <td>San Francisco</td>
                          <td>22</td>
                          <td>2008-10-26</td>
                          <td>$235,500</td>
                      </tr>
                      <tr>
                          <td>Martena Mccray</td>
                          <td>Post-Sales support</td>
                          <td>Edinburgh</td>
                          <td>46</td>
                          <td>2011-03-09</td>
                          <td>$324,050</td>
                      </tr>
                      <tr>
                          <td>Unity Butler</td>
                          <td>Marketing Designer</td>
                          <td>San Francisco</td>
                          <td>47</td>
                          <td>2009-12-09</td>
                          <td>$85,675</td>
                      </tr>
                      <tr>
                          <td>Howard Hatfield</td>
                          <td>Office Manager</td>
                          <td>San Francisco</td>
                          <td>51</td>
                          <td>2008-12-16</td>
                          <td>$164,500</td>
                      </tr>
                      <tr>
                          <td>Hope Fuentes</td>
                          <td>Secretary</td>
                          <td>San Francisco</td>
                          <td>41</td>
                          <td>2010-02-12</td>
                          <td>$109,850</td>
                      </tr>
                      <tr>
                          <td>Vivian Harrell</td>
                          <td>Financial Controller</td>
                          <td>San Francisco</td>
                          <td>62</td>
                          <td>2009-02-14</td>
                          <td>$452,500</td>
                      </tr>
                      <tr>
                          <td>Timothy Mooney</td>
                          <td>Office Manager</td>
                          <td>London</td>
                          <td>37</td>
                          <td>2008-12-11</td>
                          <td>$136,200</td>
                      </tr>
                      <tr>
                          <td>Jackson Bradshaw</td>
                          <td>Director</td>
                          <td>New York</td>
                          <td>65</td>
                          <td>2008-09-26</td>
                          <td>$645,750</td>
                      </tr>
                      <tr>
                          <td>Olivia Liang</td>
                          <td>Support Engineer</td>
                          <td>Singapore</td>
                          <td>64</td>
                          <td>2011-02-03</td>
                          <td>$234,500</td>
                      </tr>
                      <tr>
                          <td>Bruno Nash</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>38</td>
                          <td>2011-05-03</td>
                          <td>$163,500</td>
                      </tr>
                      <tr>
                          <td>Sakura Yamamoto</td>
                          <td>Support Engineer</td>
                          <td>Tokyo</td>
                          <td>37</td>
                          <td>2009-08-19</td>
                          <td>$139,575</td>
                      </tr>
                      <tr>
                          <td>Thor Walton</td>
                          <td>Developer</td>
                          <td>New York</td>
                          <td>61</td>
                          <td>2013-08-11</td>
                          <td>$98,540</td>
                      </tr>
                      <tr>
                          <td>Finn Camacho</td>
                          <td>Support Engineer</td>
                          <td>San Francisco</td>
                          <td>47</td>
                          <td>2009-07-07</td>
                          <td>$87,500</td>
                      </tr>
                      <tr>
                          <td>Serge Baldwin</td>
                          <td>Data Coordinator</td>
                          <td>Singapore</td>
                          <td>64</td>
                          <td>2012-04-09</td>
                          <td>$138,575</td>
                      </tr>
                      <tr>
                          <td>Zenaida Frank</td>
                          <td>Software Engineer</td>
                          <td>New York</td>
                          <td>63</td>
                          <td>2010-01-04</td>
                          <td>$125,250</td>
                      </tr>
                      <tr>
                          <td>Zorita Serrano</td>
                          <td>Software Engineer</td>
                          <td>San Francisco</td>
                          <td>56</td>
                          <td>2012-06-01</td>
                          <td>$115,000</td>
                      </tr>
                      <tr>
                          <td>Jennifer Acosta</td>
                          <td>Junior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>43</td>
                          <td>2013-02-01</td>
                          <td>$75,650</td>
                      </tr>
                      <tr>
                          <td>Cara Stevens</td>
                          <td>Sales Assistant</td>
                          <td>New York</td>
                          <td>46</td>
                          <td>2011-12-06</td>
                          <td>$145,600</td>
                      </tr>
                      <tr>
                          <td>Hermione Butler</td>
                          <td>Regional Director</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2011-03-21</td>
                          <td>$356,250</td>
                      </tr>
                      <tr>
                          <td>Lael Greer</td>
                          <td>Systems Administrator</td>
                          <td>London</td>
                          <td>21</td>
                          <td>2009-02-27</td>
                          <td>$103,500</td>
                      </tr>
                      <tr>
                          <td>Jonas Alexander</td>
                          <td>Developer</td>
                          <td>San Francisco</td>
                          <td>30</td>
                          <td>2010-07-14</td>
                          <td>$86,500</td>
                      </tr>
                      <tr>
                          <td>Shad Decker</td>
                          <td>Regional Director</td>
                          <td>Edinburgh</td>
                          <td>51</td>
                          <td>2008-11-13</td>
                          <td>$183,000</td>
                      </tr>
                      <tr>
                          <td>Michael Bruce</td>
                          <td>Javascript Developer</td>
                          <td>Singapore</td>
                          <td>29</td>
                          <td>2011-06-27</td>
                          <td>$183,000</td>
                      </tr>
                      <tr>
                          <td>Donna Snider</td>
                          <td>Customer Support</td>
                          <td>New York</td>
                          <td>27</td>
                          <td>2011-01-25</td>
                          <td>$112,000</td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                      </tr>
                  </tfoot>
              </table>-->
         </div>
       </div>
     </div>
        <!--   <div class="col">
        Card with right text alignment
          <div class="card text-end">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some dummy text to make up the card's content. You can replace it anytime.</p>
              <a href="#" class="btn btn-primary">Know more</a>
            </div>
          </div>
        </div>
      </div> -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
  </script>
    <!-- Datatable
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
     --><!-- Datatable bs5-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>

    <script>
      $(document).ready(function() {
          $('#example').DataTable( {
            responsive: true,
             fixedHeader: true,
              keys: true,
               select: true,
            //  dom: 'Bfrtip',"bFilter": true,
              dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>","bFilter": true,
      "aLengthMenu": [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"]
      ],
              buttons: [
                'pageLength',
                  'copyHtml5',
                //  {
                // extend: 'excelHtml5',
              //   title: 'JRU Organizations Portal Student Users'
          //   },
             {
            extend: 'csvHtml5',
            title: 'JRU Organizations Portal Admin Users'
        },
             {
                 extend: 'pdfHtml5',
                 title: 'JRU Organizations Portal Admin Users'
             },
             {
            extend: 'print',
            title: 'JRU Organizations Portal Admin Users'
        }
         ],
          } );
      } );

      </script>

</body>

</html>
