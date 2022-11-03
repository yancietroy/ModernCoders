<nav id="sidebar">

    <div class="sidebar-header text-center">
        <a class="navbar-brand" href="student-index.php">
            <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
    </div>
    <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal</h5>
    </div>

    <ul class="list-unstyled components p-2">

        <li <?= str_starts_with($nav_selected, "Home") ? 'class="active"' : "" ?>>
            <a href="student-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
        <li <?= str_starts_with($nav_selected, "Organizations") ? 'class="active"' : "" ?>>
            <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <?php
                foreach ($_SESSION['USER-ORGS'] as $o_id => $o_name) {
                ?>
                    <li <?= str_ends_with($nav_selected, $o_name) ? 'class="active"' : "" ?>>
                        <a title="<?= $o_name ?>" href="rso.php?id=<?= $o_id ?>"><i class="bi bi-diagram-3-fill"></i> <span><?= $o_name ?></span></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <li class="d-lg-none">
            <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
        </li>
    </ul>
</nav>
