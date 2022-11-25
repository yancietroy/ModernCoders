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

                        <li>
                            <p class="m-0 mb-2 px-3">Notifications</p>

                        </li>

                        <?php
                        $count = 0;
                        $showAllBadge = false;
                        $uid = $_SESSION['USER-ID'];
                        $sql = "SELECT * FROM tb_notification WHERE receiver='$uid' ORDER BY notif_id DESC LIMIT 0,6";
                        if ($resNotif = @mysqli_query($conn, $sql)) {
                            if ($resNotif->num_rows > 0) {
                                while ($row = $resNotif->fetch_assoc()) {
                                    $id = $row['id'];
                                    $data = $row['data'];
                                    $isread = $row['is_read'];

                                    $count++;
                                    if ($count == 6 && $isread == "0") $showAllBadge = true;
                                    if ($count == 6) continue;
                        ?>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="<?= $data != "" ? "notifClick('$id','$data','$isread')" : "notifClick('$id','#','$isread')" ?>">
                                            <strong class="me-2"><?= $row['title'] ?><?php if ($isread == 0) echo ' <span class="badge badge-pill badge-danger align-top">new</span>' ?></strong><br />
                                            <small class="text-muted  me-2"><em><?= $row['message'] ?></em></small>
                                        </a>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <p class="text-secondary px-5 py-3 text-nowrap" style="font-size: 14px;">No Recent Notification</p>

                                </li>
                        <?php
                            }
                        }
                        ?>
                        <hr class="m-0 p-0 mt-3 mb-2 mx-3 text-secondary">
                        <li>
                            <a class="dropdown-item m-0 p-0 text-center me-2" href="notifications.php">View All
                                <?php if ($showAllBadge) {
                                ?>
                                    <span class="badge badge-pill badge-danger align-top">more</span>
                                <?php
                                } ?>
                            </a>
                        </li>
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

<script>
    function notifClick(id, link, read) {
        if (read == "0") {
            $.ajax({
                type: 'POST',
                url: 'include/read-notification.php',
                data: {
                    id: id
                },
                success: function(data) {}

            });
        }

        if (link != "#" && link != "signatory-projects.php") {
            location.href = link;
        } else {
            location.href = "signatory-projects.php?time=" + Math.floor(Math.random() * 1000);
        }

    }
</script>

<script src="../assets/js/download-table.js"></script>
<script src="../assets/js/export2csv.js"></script>
