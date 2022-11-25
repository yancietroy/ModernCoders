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
                    <?php
                    if($data_signatorytype == 1){
                    ?>
                    <a href="signatory-orgs.php"><i class="bi bi-diagram-3-fill"></i> <span>Organizations</span></a>
                    <?php
                    }
                    elseif($data_signatorytype == 2){
                    ?>
                    <a href="signatory-orgs.php"><i class="bi bi-diagram-3-fill"></i> <span><?php echo "$collName"; ?></span></a>
                    <?php
                    }
                    elseif($data_signatorytype == 3){
                    ?>
                    <a href="signatory-orgs.php"><i class="bi bi-diagram-3-fill"></i> <span><?php echo "$collName"; ?></span></a>
                    <?php
                    }elseif($data_signatorytype == 4){
                    ?>
                    <a href="signatory-orgs-rso.php?id=<?= $data_orgid ?>"><i class="bi bi-diagram-3-fill"></i> <span><?php echo "$orgName"; ?></span></a>
                    <?php
                    }
                    ?>
                </li>
        </li>
        <li class="d-lg-none">
            <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
        </li>
    </ul>
</nav>
