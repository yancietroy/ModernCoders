<?php
ob_start();
session_start();
session_destroy();
session_start();
if(isset($_SESSION['message'])){
    print_r($_SESSION['message']);#display message
    unset($_SESSION['message']); #remove it from session array, so it doesn't get displayed twice
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JRU Student Organizations Portal</title>
  <!-- Our Custom CSS  -->
  <link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">
  <!-- Waves CSS  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Bootstrap CSS  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg-admin min-vh-100">
  <div class="container  align-items-center justify-content-center">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-10 col-lg-5 col-xl-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
          <div class="card-body px-4 ">
            <div class="row g-0 justify-content-center align-items-center mt-2">
              <div class="col-xs-12 col-md-3 col-md-offset-3 mb-2  d-none d-sm-block">
                <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
              </div>
              <div class="col-xs-12 col-md-4 col-md-offset-3 mb-2 d-none d-sm-block">
                <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
              </div>
              <div class="col-xs-12 col-md-3 col-md-offset-3 mb-2 d-none d-sm-block">
                <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
              </div>
            </div>
            <h4 class=" mb-2 text-center">JRU Student Organizations Portal</h4>
            <form method="POST" class="requires-validation" novalidate autocomplete="off">
              <h1 class="fs-4 card-title fw-bold mb-3 text-uppercase text-center text-muted">Signatory Login</h1>
              <?php
            if(isset ($_POST['submit']))
            {
            	include('mysql_connect.php');
            	$e = $_POST['email'];
            	$p = $_POST['password'];

            	if(!empty($_POST['email']) || !empty($_POST['password'])) {
            		ob_start();

            		$query = "Select school_ID FROM tb_signatories WHERE EMAIL='$e' AND PASSWORD=SHA('$p')";
            		$result = @mysqli_query($conn, $query);
            		$row = mysqli_fetch_array ($result);

            		if($row)
            		{
            			$_SESSION['msg'] = '<script>alert("Login Successful")</script>';
                $_SESSION['use'] = $row[0];
                if(isset($_SESSION['use'])){
                header("Location:signatory/signatory-index.php");
                @mysqli_close($conn);
                exit();
                }
                }
                else
                {
                  echo "<div class='callout bs-callout-warning pb-0' id='box'>
                        <h4>Error!</h4>
                        <p>Invalid email or password!</p></div>";

                  }
                  }
                  else
                  echo "<div class='callout bs-callout-warning pb-0' id='box'>
                        <h4>Error!</h4>
                        <p>Please enter email and password!</p></div>";
                mysqli_close($conn);

                ob_end_flush();
                }
                ?>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@jru.edu" pattern=".+@jru\.edu" title="Please provide a Jose Rizal University e-mail address" required>
                <label class="text-muted" for="email">Email address</label>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Email field invalid!</div>
              </div>

              <div class="form-floating mb-2">
                <input type="password" class="form-control" name="password" id="password" minlength="8" maxlength="20" value="" placeholder="password" required>
                <label class=" text-muted " for="password">Password</label>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Password field invalid!</div>
              </div>
              <div class="form-outline mb-2">
                <select class="selectpicker form-select mt-4" id="select-opt">
                  <option class="greyclr text-muted" selected disabled value="" >Select User</option>
                  <option value="index.php">Student</option>
                  <option value="officer-login.php">Officer</option>
                  <option value="signatory-login.php">Signatory</option>
                  <option value="admin-login.php">Admin</option>
                </select>
              </div>
              <button class="w-100 btn btn-lg btn-primary mt-4 mb-4 button" type="submit" name='submit'>Sign in</button>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- waves js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script> <!-- JavaScript validation -->
  <script type="text/javascript">
    Waves.attach('.button');
    Waves.init();
  </script>
  <!-- form validation/sidebar toggle -->
  <script src="assets/js/form-validation.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    document.addEventListener('click', function handleClickOutsideBox(event) {
      const box = document.getElementById('box');

      if (!box.contains(event.target)) {
        box.style.display = 'none';
      }
    });

    </script>
    <script type="text/javascript">
    $(document).ready(function () {
    $("#select-opt").change(function() {
      var $option = $(this).find(':selected');
      var url = $option.val();
      if (url != "") {
        url += "?text=" + encodeURIComponent($option.text());
        // Show URL rather than redirect
        window.location.href = url;
      }
    });
  });
    </script>

</body>

</html>
