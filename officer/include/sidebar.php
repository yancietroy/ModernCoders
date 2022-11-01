<nav id="sidebar">

    <div class="sidebar-header text-center">
        <a class="navbar-brand" href="admin-index.php">
            <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
    </div>
    <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Officer</h5>
    </div>

    <ul class="list-unstyled components p-2">

        <li <?= str_starts_with($nav_selected, "Home") ? 'class="active"' : "" ?>>
            <a href="officer-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Organizations") ? 'class="active"' : "" ?>>
            <a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Projects") ? 'class="active"' : "" ?>>
            <a href="officer-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Election") ? 'class="active"' : "" ?>>
            <a href="election-index.php"><i class="bi bi-check2-square"></i> <span>JRUSOC Election</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Survey") ? 'class="active"' : "" ?>>
            <a href="officer-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>

        </li>
        <li class="d-lg-none">
            <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
        </li>
    </ul>
</nav>