<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Singapore');

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_name = $_SESSION['USER-NAME'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Discussion Board", "forum-user.php", ""],
    ["Threads", "", ""],
];

$topicid = $_GET['topic'] ?? 0;
if ($topicid <= 0) {
    header('location:forum-user.php?id=' . $orgid);
}

$page_no = $_GET['page'] ?? 1;

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}


if (isset($_POST['create-thread'])) {
    $addtitle = $_POST['add-title'];
    $addmsg = $_POST['add-msg'];
    $addmsg =  str_replace("'", "''", $addmsg);
    $timestamp = time();
    $sqlInsert = "INSERT INTO tb_disc_threads(thread_id,topic_id,user_id,user_type,name,title,message,views,replies,last_reply,last_reply_name) VALUES
  ('$timestamp','$topicid','$data_userid','2','$data_name','$addtitle','$addmsg','0','0','$timestamp','$data_name')";
    if ($res = @mysqli_query($conn, $sqlInsert)) {
        header('location:forum-view.php?topic=' . $topicid . '&thread=' . $timestamp);
    } else {
        echo "<script>alert('Failed Creating a thread. Please try again.')</script>";
    }
}

if (isset($_POST['lock-thread'])) {
    $threadlock = $_POST['lock-id'] ?? -1;
    $sqlLock = "UPDATE tb_disc_threads SET locked='1' WHERE thread_id='$threadlock'";
    if (mysqli_query($conn, $sqlLock)) {
        echo "<script>alert('Thread has been locked successfully.')</script>";
    } else {
        echo "<script>alert('Failed locking the thread. Please try again.')</script>";
    }
}

if (isset($_POST['unlock-thread'])) {
    $threadunlock = $_POST['unlock-id'] ?? -1;
    $sqlUnlock = "UPDATE tb_disc_threads SET locked='0' WHERE thread_id='$threadunlock'";
    if (mysqli_query($conn, $sqlUnlock)) {
        echo "<script>alert('Thread has been unlocked successfully.')</script>";
    } else {
        echo "<script>alert('Failed unlocking the thread. Please try again.')</script>";
    }
}

$topicsubject = "";
$topicdesc = "";
$topicicon = "";

$sqlGroups = "SELECT * FROM tb_disc_topics WHERE topic_id='$topicid'";
if ($res = @mysqli_query($conn, $sqlGroups)) {
    if ($res->num_rows > 0) {
        $topic = $res->fetch_assoc();
        $topicsubject = $topic['subject'];
        $topicdesc = $topic['description'];
        $topicicon = $topic['icon'];
    }
}

$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM tb_disc_threads WHERE topic_id='$topicid'"
);

$total_records_per_page = 20;
$offset = ($page_no - 1) * $total_records_per_page;

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
    <title>JRU Student Organizations Portal Officer</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- waves CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar  -->
        <?php include("include/sidebar.php") ?>

        <div id="content">

            <!-- Navbar/Header  -->
            <?php include("include/header.php") ?>

            <!-- breadcrumb -->
            <?php include("include/breadcrumb.php") ?>

            <!-- Page content -->
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="wrapper wrapper-content animated fadeInRight shadow px-auto mb-4 ">


                        <div class="ibox-content forum-container ">
                            <div class="d-flex flex-row mb-4 align-items-center">
                                <div class="forum-title flex-grow-1">
                                    <h3>
                                        <span>
                                            <i class="mr-2 bi <?= $topicicon == "" ? "bi-chat-square-dots-fill" : $topicicon ?>"></i>
                                        </span> <?= $topicsubject ?>
                                    </h3>
                                </div>
                                <div>
                                    <button class="btn btn-primary small createbtn">Create Post</button>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <th>Thread</th>
                                    <th>Created</th>
                                    <th>Statistics</th>
                                    <th>Last Post</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlThreads = "SELECT thread_id,name,title,views,replies,last_reply,last_reply_name,locked FROM tb_disc_threads WHERE topic_id='$topicid' ORDER BY last_reply DESC LIMIT $offset,$total_records_per_page";

                                    $res = $conn->query($sqlThreads);
                                    if ($res->num_rows > 0) {
                                        while ($thread = $res->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td style="min-width: 400px; max-width: 400px;">
                                                    <div class="row">
                                                        <div class="col-md-9" style="overflow: hidden; text-overflow: ellipsis;">
                                                            <a href="forum-view.php?topic=<?= $topicid ?>&thread=<?= $thread['thread_id'] ?>" class="forum-item-title" style="font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                                <?= $thread['title'] ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex flex-row">
                                                                <?php
                                                                if ($thread['locked'] == 0) {
                                                                ?>
                                                                    <a href="#" onclick="lockThread(<?= $thread['thread_id'] ?>)" class="text-primary mr-2" style="font-size: 10px;">Lock</a>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <a href="#" onclick="unlockThread(<?= $thread['thread_id'] ?>)" class="text-warning mr-2" style="font-size: 10px;">Unlock</a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <div class="forum-sub-title small">By <?= $thread['name'] ?></div>
                                                            <div class="forum-sub-title small text-secondary" style="font-size: 12px;">on <?= date('m/d/Y', $thread['thread_id']) ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <div class="forum-sub-title small"><?= $thread['replies'] ?> Replies</div>
                                                            <div class="forum-sub-title small"><?= $thread['views'] ?> Views</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <?php
                                                            if ($thread['last_reply'] > 0) {
                                                            ?>
                                                                <div class="forum-sub-title small">By <?= $thread['last_reply_name'] ?></div>
                                                                <div class="forum-sub-title small text-secondary" style="font-size: 12px;">on <?= date('m/d/Y h:i A', $thread['last_reply']) ?></div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No threads in this Topic</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <?php
                            if ($total_records > 0) {
                            ?>
                                <nav class="mt-4 d-flex flex-row justify-content-end">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a href="?page=1&topic=<?= $topicid ?>" class="page-link text-dark">First</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="?page=<?php if ($page_no == 1) echo "1";
                                                            else echo $page_no - 1; ?>&topic=<?= $topicid ?>" class="page-link text-dark">Previous</a>
                                        </li>

                                        <?php
                                        if ($total_no_of_pages <= 5) {
                                            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                                        ?>
                                                <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                                                    <a href="?page=<?= $i ?>&topic=<?= $topicid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            $mid;
                                            $after = $total_no_of_pages - $page_no;
                                            $before = $page_no - 1;

                                            if ($before >= 2 && $after >= 2) {
                                                $x = $page_no - 2;
                                                $y = $page_no + 2;
                                            } else if ($before < 2 && $after >= 2) {
                                                $x = $page_no - $before;
                                                $y = $page_no + 2 + (2 - $before);
                                            } else if ($before >= 2 && $after < 2) {
                                                $x = $page_no - 2 - (2 - $after);
                                                $y = $total_no_of_pages;
                                            }

                                            for ($i = $x; $i <= $y; $i++) {
                                                if ($page_no == $i) {
                                                ?>
                                                    <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                                                        <a href="?page=<?= $i ?>&topic=<?= $topicid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                                                    </li>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>

                                        <li class="page-item">
                                            <a href="?page=<?php if ($page_no == $total_no_of_pages) echo $total_no_of_pages;
                                                            else echo $page_no + 1; ?>&topic=<?= $topicid ?>" class="page-link text-dark">Next</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="?page=<?= $total_no_of_pages ?>&topic=<?= $topicid ?>" class="page-link text-dark">Last</a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div id="layoutAuthentication_footer">
                <footer class="py-2 bg-light">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Modern Coders 2022</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="lockModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Lock Thread </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="?topic=<?= $topicid ?>" method="POST">
                        <div class="modal-body">
                            <div class="col-12 col-md-12 justify-content-center ">
                                <p>Are you sure do you want to lock this thread?</p>
                                <input type="text" id="lock-id" name="lock-id" style="display: none;">
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="lock-thread" class="btn btn-primary">Lock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="unlockModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Unlock Thread </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="?topic=<?= $topicid ?>" method="POST">
                        <div class="modal-body">
                            <div class="col-12 col-md-12 justify-content-center ">
                                <p>Are you sure do you want to unlock this thread?</p>
                                <input type="text" id="unlock-id" name="unlock-id" style="display: none;">
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="unlock-thread" class="btn btn-primary">Unlock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Create a new Thread </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="?topic=<?= $topicid ?>" method="POST">
                        <div class="modal-body">
                            <div class="col-12 col-md-12 justify-content-center ">
                                <div class="form-outline">
                                    <label class="form-label" for="delete_id">Title</label>
                                    <input type="text" name="add-title" id="add-title" class="form-control" />
                                    <label class="form-label mt-3" for="delete_id">Message</label>
                                    <textarea type="text" name="add-msg" id="add-msg" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="create-thread" class="btn btn-info">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!-- form validation/sidebar toggle -->
        <script src="../assets/js/form-validation.js"></script>
        <!-- waves js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script> <!-- JavaScript validation -->
        <script type="text/javascript">
            Waves.attach('#sidebar ul li a');
            Waves.attach('.button');
            Waves.init();
        </script>
        <script src="../assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#add-msg',
                plugins: 'link image textcolor',
                menubar: 'edit view insert format',
                toolbar: 'undo redo | styles | bold italic underline forecolor backcolor | link | alignleft aligncenter alignright',
            });
            document.addEventListener('focusin', (e) => {
                if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                    e.stopImmediatePropagation();
                }
            });
            $(document).on('click', '.createbtn', function() {
                $('#createModal').modal('show');
            });

            function lockThread(id) {
                $('#lock-id').val(id);
                $('#lockModal').modal('show');
            }

            function unlockThread(id) {
                $('#unlock-id').val(id);
                $('#unlockModal').modal('show');
            }
        </script>
</body>

</html>