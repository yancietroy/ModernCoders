<nav class="navbar shadow navbar-expand navbar-light bg-light" aria-label="navbar" id="topbar">
    <div class="container-fluid">
        <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                    </a>
                </li>
                <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDarkDropdownMenuNotif" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell me-lg-2 mt-2" style="width:  25px; height: 25px;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuNotif">
          <li><a class="dropdown-item" href="#">
                <strong class="me-2">Project Name</strong><br/>
  <small class="text-muted  me-2"><em>By Officer Name</em></small></a></li>
        </ul>
      </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-lg-inline-flex mr-3"><?= $_SESSION["USER-NAME"] ?? "No Name" ?></span>
                        <img class="rounded-circle me-lg-2" src="<?= $data_picture ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="signatory-profile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="../logout.php?type=3">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
