<?php 
include('mysql_connect.php');
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
</head>

<style>
.input-field i {
    margin-right: 10px;
    cursor: pointer;
    color: lightgrey;
}
.input-field i:hover {
    margin-right: 10px;
    cursor: pointer;
    color: lightgrey;
}
.input-field {
border-radius: 5px;
padding: 5px;
display: flex;
align-items: center;
cursor: pointer;
border: 1px solid lightgrey;
color: lightgrey;
}

.input-field:hover {
color: #F2AC1B;
border: 1px solid #F2AC1B;
}

input {
border: none;
outline: none;
box-shadow: none;
width: 100%;
padding: 0px 2px;
font-family: 'Poppins', sans-serif
}

.fa-eye-slash.btn {
border: none;
outline: none;
box-shadow: none
}

#forgot {
  font-size: 15px;
}
</style>
<body class="bg min-vh-100">
   <div class="d-flex flex-column min-vh-100 min-vw-100">
  <div class="d-flex flex-grow-1 justify-content-center align-items-center">
  <div class="card text-center">
    <div class="card-header h5 text-white bg-primary">Password Reset</div>
    <div class="card-body px-5">
        <p class="card-text py-2">
            Please enter your new password.
        </p>
                <form method="post" action="" id="form" name="form" data-parsley-validate data-parsley-trigger="keyup" data-parsley-validate class="requires-validation" novalidate>
        <div class="form-group py-1 pb-2">
        <div class="input-field"> <span class="fas fa-lock p-2"></span>
          <input type="password" class=" password" name="password" id="txtNewPassword" placeholder="New Password" data-parsley-minlength="8" maxlength="20" data-parsley-errors-container=".errorspannewpassinput" data-parsley-required-message="Please enter your password." data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required required />
        </div>
        </div>
          <span class="errorspannewpassinput"></span>
        <div class="form-group py-1 pb-2 mb-3">
        <div class="input-field"> <span class="fas fa-lock p-2"></span>
          <input type="password" class=" password" name="confirmpassword" placeholder="Confirm Password" id="txtConfirmPassword" maxlength="20" onChange="checkPasswordMatch();" data-parsley-minlength="8" data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your password." data-parsley-equalto="#txtNewPassword" data-parsley-required required />

         </div>
             <span class="errorspanconfirmnewpassinput"></span>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Reset password</button>
        <div class="d-flex justify-content-between mt-4">
            <a class="" href="index.php">Login</a>
            <a class="" href="register.php">Register</a>
        </div>
      </form>
    </div>
</div>
</div>
</div>
<?php
if (isset($_POST['submit']) || isset($_POST['password'])) {
  $pass = $_POST['password'];
  $email = $_GET['m'] ?? -1;
  if ($email <= 0) {
      echo "<script>alert('Email is invalid.'); location.href='index.php';</script>";
  } else {
      $query = "SELECT * FROM tb_students WHERE EMAIL = $email";
      if ($res = @mysqli_query($conn, $query)) {
          if ($res->num_rows > 0) {
              $row = $res->fetch_assoc();
              $student_id = $row['STUDENT_ID'];
              $sql = "UPDATE tb_students SET PASSWORD = SHA('$pass') WHERE STUDENT_ID='$student_id'";
              @mysqli_query($conn, $sql);
              echo "<script type='text/javascript'>
                        Swal.fire({
                             allowOutsideClick: false,
                             icon: 'success',
                             title: 'Password Set!',
                             text:'Please login JRU email to with your new password',
                             confirmButtonColor: '#F2AC1B'
                         }).then(function() {
                              window.location = 'index.php';
                          });
                          </script>";
          } else {
              echo "<script>alert('Email is invalid.'); location.href='index.php';</script>";
          }
      }
  }
}
?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("bi-eye");
    });

    // prevent form submit
    const form = document.querySelector("form");
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });
</script>
  <!-- waves js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script> <!-- JavaScript validation -->
  <script type="text/javascript">
    Waves.attach('.button');
    Waves.init();
  </script>
  <!-- form validation/sidebar toggle -->
  <script src="assets/js/form-validation.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script src="assets/js/pass-validation.js"></script>
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
