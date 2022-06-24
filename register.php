<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JRU Student Organizations Portal Login Page</title>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="bg">
  <form action="registered.php" method="post">
  <section class="h-100">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-8">
          <div class="card shadow-2-strong card-registration mb-5" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="row g-0 justify-content-center align-items-center ">
                    <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4">
                        <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
                          </div>
                        <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4">
                        <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
                            </div>
                            <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4">
                        <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
                          </div>
            </div>
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Student Registration Form</h3>
<<<<<<< Updated upstream
=======
              <h4 class="mb-4 pb-2 pb-md-0 mb-md-4">Personal details</h4>
>>>>>>> Stashed changes
            <!-- <form class="was-validated"> -->
                  <form>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="firstName" id="asterisk">First name</label>
                      <input type="text" name="first_name" id="FirstName" class="form-control form-control-lg" required />
                      <div class="valid-feedback"></div>
                      <div class="invalid-feedback">First name field cannot be blank!</div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="middleName">Middle name</label>
                      <input type="text" name="middle_name" id="middleName" class="form-control form-control-lg" />
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="lastName" id="asterisk">Last name</label>
                      <input type="text" name="last_name" id="lastName" class="form-control form-control-lg" required />
                      <div class="valid-feedback">Looks Good!</div>
                      <div class="invalid-feedback">Last name field cannot be blank!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="bday" id="asterisk">Birthdate</label>
                      <input id="birthDate" class="form-control form-control-lg" type="date" required />
                      <span id="birthDateSelected"></span>
                      <div class="valid-feedback">Looks Good!</div>
                      <div class="invalid-feedback">Age field cannot be blank!</div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="age" id="asterisk">Age</label>
                      <input type="text" name="age" id="age" class="form-control form-control-lg" required />
                      <div class="valid-feedback">Looks Good!</div>
                      <div class="invalid-feedback">Age field cannot be blank!</div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label class="mb-4 me-5 w-50" for="gender" id="asterisk">Gender: </label>
                    <div class="form-check form-check-inline mb-0 me-4 ">
                      <input class="form-check-input" type="radio" name="gender" id="Male" value="Male" autocomplete="off" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline mb-0 me-4">
                      <input class="form-check-input" type="radio" name="gender" id="Female" value="Female" autocomplete="off" />
                      <label class="form-check-label" for="Female">Female</label>
                    </div>
                    <div class="valid-feedback mv-up">You selected a gender!</div>
                    <div class="invalid-feedback mv-up">Please select a gender!</div>
                  </div>
<<<<<<< Updated upstream

                </div>
=======
                </div>
                <hr>
              <div class="row">
                  <h4 class="mb-4 pb-2 pb-md-0 mb-md-4 mt-2">Academic Profile</h4>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="studentid" id="asterisk">Student ID</label>
                      <input type="text" name="last_name" id="studentid" class="form-control" placeholder="##-###### "required />
                      <div class="valid-feedback">Looks Good!</div>
                      <div class="invalid-feedback">student id field cannot be blank!</div>
                    </div>
                  </div>
                      <div class="col-4 mb-4">
                        <label class="form-label select-label" id="asterisk">Year Level</label>
                        <select class=" form-select" name="year" id="select-group" required>
                          <option class="greyclr" selected disabled value="" >Select Year</option>
                          <option value="1">First Year</option>
                          <option value="2">Second Year</option>
                          <option value="3">Third Year</option>
                          <option value="4">Fourth Year</option>
                        </select>
                        <div class="valid-feedback">Looks Good!</div>
                        <div class="invalid-feedback">year field cannot be blank!</div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="form-outline">

                          <label class="form-label" for="section" id="asterisk">Section</label>
                          <input type="text" name="section" id="section" class="form-control" required />
                          <div class="valid-feedback">Looks Good!</div>
                          <div class="invalid-feedback">section field cannot be blank!</div>
                        </div>
                      </div>
                  </div>
>>>>>>> Stashed changes
                <div class="row">
                  <div class="col-4 mb-4">

                    <label class="form-label select-label" id="asterisk">College</label>
                    <select class="form-select form-select-sm" name="college" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select College</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a college program
                    </div>
                  </div>

                  <div class="col-4 mb-4">

                    <label class="form-label select-label" id="asterisk">Course</label>
                    <select class="form-select form-select-sm" name="course" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select Course</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a Course
                    </div>
                  </div>
                  <div class="col-4 mb-4">

                    <label class="form-label select-label" id="asterisk">Organization</label>
                    <select class="form-select form-select-sm" name="org" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select Organization</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a Organization
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="email" id="asterisk">Student Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="name@my.jru.edu" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" required>
                      <div class="valid-feedback">Email field is valid!</div>
                      <div class="invalid-feedback">Email field invalid!</div>
                    </div>
                  </div>

                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="password" id="asterisk">Password</label>
                      <input type="password" class="form-control" name="password" id="password" data-bs-toggle="popover" data-bs-placement="bottom" title="Password Validation" minlength="8" data-bs-content="Must be at least 8 characters long &#013;
                Must contain at least one number &#013;
                      Must contain at least one special character &#013;
                      and must contain at least one uppercase and lowercase letter" required>

                      <div class="valid-feedback">
                        Password looks good!
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                      <input type="password" class="form-control" name="confirmpassword" id="Confirmpassword" minlength="3" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 mb-4">
                  <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Register</button>

                </div>

              </form>
              <hr class="my-4">
              <p class="mt-3 text-center">Already have an account? <a href="login.php" class="text-blue-50 fw-bold">Login</a>
              </p>

            </div>
          </div>
        </div>
        <div class="text-center mt-5 text-light">
        </div>
      </div>
    </div>
  </section>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>
  </form>
</body>

</html>