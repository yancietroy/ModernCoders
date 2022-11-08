<?php
ob_start();
session_start();
session_destroy();
session_start();
$_SESSION['loggedIn'] = true;
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
  <div class="card text-center" style="width: 350px;">
    <div class="card-header h5 text-white bg-primary">Password Reset</div>
    <div class="card-body px-5">
        <p class="card-text py-2">
            Enter your email address and we'll send you an email with instructions to reset your password.
        </p>
        <div class="form-outline">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@my.jru.edu" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" required>
            <label class="text-muted" for="email">Email address</label>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Email field invalid!</div>
          </div>
        </div>
        <a href="#" class="btn btn-primary w-100">Reset password</a>
        <div class="d-flex justify-content-between mt-4">
            <a class="" href="index.php">Login</a>
            <a class="" href="register.php">Register</a>
        </div>
    </div>
</div>
</div>
</div>
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
