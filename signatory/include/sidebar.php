<nav id="sidebar">

    <div class="sidebar-header text-center">
        <a class="navbar-brand" href="signatory-index.php">
            <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
    </div>
    <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Signatory</h5>
    </div>

    <ul class="list-unstyled components p-2">

        <li <?= str_starts_with($nav_selected, "Home") ? 'class="active"' : "" ?>>
            <a href="signatory-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Organizations") ? 'class="active"' : "" ?>>
            <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>Org Management</span></a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li <?= str_ends_with($nav_selected, "Organization") ? 'class="active"' : "" ?>>
                    <a href="signatory-orgs.php"><i class="bi bi-diagram-3-fill"></i> <span>Organization</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Officers") ? 'class="active"' : "" ?>>
                    <a href="signatory-orgs-rso-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
                </li>
                <li <?= str_ends_with($nav_selected, "Discussion Forum") ? 'class="active"' : "" ?>>
                    <a href="forum-user.php"><i class="bi bi-clipboard-fill"></i> <span>Discussion Forum</span></a>
                </li>

                <li <?= str_starts_with($nav_selected, "Calendar") ? 'class="active"' : "" ?>>
                    <a href="event-calendar.php"><i class="bi bi-calendar2-fill"></i> <span>Event Calendar</span></a>
                </li>
            </ul>
        </li>
        <li <?= str_starts_with($nav_selected, "Projects") ? 'class="active"' : "" ?>>
            <a href="signatory-projects.php"><i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <li class="d-lg-none">
            <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
        </li>
    </ul>
</nav>
