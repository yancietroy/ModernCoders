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

        <li <?= str_starts_with($nav_selected, "Home") ? 'class="active"' : "" ?>>
            <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "User Management") ? 'class="active"' : "" ?>>
            <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li <?= str_ends_with($nav_selected, "Students") ? 'class="active"' : "" ?>>
                    <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Officers") ? 'class="active"' : "" ?>>
                    <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Signatories") ? 'class="active"' : "" ?>>
                    <a href="admin-signatories.php"><i class="bi bi-person-check-fill"></i> <span>Signatories</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Admin") ? 'class="active"' : "" ?>>
                    <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
                </li>
            </ul>
        </li>
        <li <?= str_starts_with($nav_selected, "Site Management") ? 'class="active"' : "" ?>>
            <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Site Management</span></a>
            <ul class="collapse list-unstyled" id="orgsSubmenu">
                <li <?= str_ends_with($nav_selected, "Organizations") ? 'class="active"' : "" ?>>
                    <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Colleges") ? 'class="active"' : "" ?>>
                    <a href="admin-college.php"><i class="bi bi-node-plus"></i> <span>Colleges</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Courses") ? 'class="active"' : "" ?>>
                    <a href="admin-course.php"><i class="bi bi-diagram-2"></i> <span>Courses</span></a>
                </li>
            </ul>
        </li>
        <li <?= str_starts_with($nav_selected, "Election") ? 'class="active"' : "" ?>>
            <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Data Analytics") ? 'class="active"' : "" ?>>
            <a href="admin-data.php"><i class="bi bi-activity"></i> <span>Data Analytics</span></a>
        </li>
        <li class="d-lg-none">
            <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
        </li>
    </ul>
</nav>
