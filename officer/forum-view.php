<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Singapore');

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$page_no = $_GET['page'] ?? 1;

$topicid = $_GET['topic'] ?? 0;
if ($topicid <= 0) {
    header('location:forum-user.php');
}

$threadid = $_GET['thread'] ?? 0;
if ($threadid <= 0) {
    header('location:forum-user.php');
}

$data_userid = $_SESSION['USER-ID'];
$data_name = $_SESSION['USER-NAME'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Discussion Board", "forum-user.php", ""],
    ["Threads", "forum-threads.php?topic=$topicid", ""],
    ["Post", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

if (isset($_POST['post-reply'])) {
    $replymsg =  $mysqli -> real_escape_string ($_POST['reply-msg']) ?? "";
    if ($replymsg != "") {
        $timestamp = time();
        $sqlPost = "INSERT INTO tb_disc_replies(reply_id,thread_id,user_type,user_id,user_name,message) VALUES
    ('$timestamp','$threadid','2','$data_userid','$data_name','$replymsg')";
        if (@mysqli_query($conn, $sqlPost)) {
            // Increment replies
            $sqlReplyCount = "UPDATE tb_disc_threads SET replies = replies + 1,last_reply='$timestamp',last_reply_name='$data_name' WHERE thread_id='$threadid'";
            mysqli_query($conn, $sqlReplyCount);
        } else {
            echo "<script>alert('Error while posting your reply. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Unable to reply an empty message. Please try again.')</script>";
    }
} else {
    // Increment views
    $sqlView = "UPDATE tb_disc_threads SET views = views + 1 WHERE thread_id='$threadid'";
    mysqli_query($conn, $sqlView);
}



$topicsubject = "";
$sqlGroups = "SELECT subject FROM tb_disc_topics WHERE topic_id='$topicid'";
if ($res = @mysqli_query($conn, $sqlGroups)) {
    if ($res->num_rows > 0) {
        $topic = $res->fetch_assoc();
        $topicsubject = $topic['subject'];
    }
}

$sqlPost = "SELECT * FROM tb_disc_threads WHERE thread_id='$threadid'";
if ($res = @mysqli_query($conn, $sqlPost)) {
    if ($res->num_rows > 0) {
        $thread = $res->fetch_assoc();
        $threadUserId = $thread['user_id'];
        $threadUserName = $thread['name'];
        $threadUserType = $thread['user_type'];
        $threadTitle = $thread['title'];
        $threadMessage = $thread['message'];
        $threadViews = $thread['views'];
        $threadLocked = $thread['locked'];
    } else {
        header('location:forum-threads.php?id=' . $orgid . 'topic=' . $topicid);
    }
}

if ($threadUserType == 1) {
    $sqlMaker = "SELECT year_level,section,profile_pic,email FROM tb_students WHERE student_id='$threadUserId'";
} else if ($threadUserType == 2) {
    $sqlMaker = "SELECT year_level,section,profile_pic,email FROM tb_officers WHERE officer_id='$threadUserId'";
} else if ($threadUserType == 3) {
    $sqlMaker = "SELECT profile_pic,email FROM tb_signatories WHERE school_id='$threadUserId'";
} else {
    $sqlMaker = "SELECT profile_pic,email FROM tb_admin WHERE ADMIN_ID='$threadUserId'";
}

if ($res = @mysqli_query($conn, $sqlMaker)) {
    if ($res->num_rows > 0) {
        $maker = $res->fetch_assoc();
        $makerName = $threadUserName;
        $makerYear = $maker['year_level'] ?? "";
        $makerSection = $maker['section'] ?? "";
        $makerPic =  getProfilePicture($threadUserType, $threadUserId);
        $makerEmail = $maker['email'] ?? "";
    }
}

$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM tb_disc_replies WHERE thread_id='$threadid'"
);

$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);

if (isset($_POST['post-reply'])) {
    $offset = ($total_no_of_pages - 1) * $total_records_per_page;
    $page_no = $total_no_of_pages;
}
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

    <style>
        .msg-body p {
            font-weight: normal;
            font-size: 14px;
            margin: 0;
        }
    </style>
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
                  <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
                      <div class="card-body px-2 mx-3 py-3 pt-4 ">

                            <div class="row">
                              <div class="col-12 col-md-2 mb-4 text-center">
                                  <h6 class="mt-3"><?= $makerName ?></h6>
                                  <img class="rounded-circle me-lg-2" src="<?= $makerPic ?>" alt="" style="width: 120px; height: 120px;border: 2px solid #F2AC1B;">
                                  <div style="overflow: hidden; text-overflow: ellipsis;">
                                      <h6 class="mt-3" style="color:#F2AC1B; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $makerEmail ?></h6>
                                  </div>
                                  <?php
                                  if ($threadUserType == 0) {
                                  ?>
                                      <h6 style="font-size: 13px;">ADMINISTRATOR</h6>
                                  <?php
                                  } else if ($threadUserType == 3) {
                                  ?>
                                      <h6 style="font-size: 13px;">SIGNATORY</h6>
                                  <?php
                                  } else if ($threadUserType == 2) {
                                  ?>
                                      <h6 style="font-size: 13px;">OFFICER</h6>
                                      <h6 style="font-size: 13px;">Year <?= $makerYear ?> Section <?= $makerSection ?></h6>
                                  <?php
                                  } else if ($threadUserType == 1) {
                                  ?>
                                      <h6 style="font-size: 13px;">STUDENT</h6>
                                      <h6 style="font-size: 13px;">Year <?= $makerYear ?> Section <?= $makerSection ?></h6>
                                  <?php
                                  }
                                  ?>
                                  <h6 class="mt-3 text-secondary" style="font-size: 12px;">Date Posted: <?= date('M. d Y', $threadid) ?></h6>
                              </div>
                               <div class="col-12 col-md-10 border p-3">
                                    <div style="overflow: hidden; text-overflow: ellipsis;">
                                        <h3 class="" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $threadTitle ?></h2>
                                    </div>
                                    <hr style="color: #dee2e6; margin-top: 5px;">

                                    <div class="msg-body">
                                        <?= $threadMessage ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ibox-content forum-container m-0">
                            <?php
                            if ($total_records > 0) {
                            ?>
                                <h6>Replies</h6>

                                <div>
                                    <?php
                                    $sqlReplies = "SELECT * FROM tb_disc_replies WHERE thread_id='$threadid' ORDER BY reply_id ASC LIMIT $offset,$total_records_per_page";
                                    if ($resReply = @mysqli_query($conn, $sqlReplies)) {
                                        while ($reply = $resReply->fetch_assoc()) {
                                            $replyUserId = $reply['user_id'];
                                            if ($reply['user_type'] == 1) {
                                                $sqlReplyOwner = "SELECT profile_pic,email FROM tb_students WHERE student_id='$replyUserId'";
                                            } else if ($reply['user_type'] == 2) {
                                                $sqlReplyOwner = "SELECT profile_pic,email FROM tb_officers WHERE officer_id='$replyUserId'";
                                            } else if ($reply['user_type'] == 3) {
                                                $sqlReplyOwner = "SELECT profile_pic,email FROM tb_signatories WHERE school_id='$replyUserId'";
                                            } else {
                                                $sqlReplyOwner = "SELECT profile_pic,email FROM tb_admin WHERE ADMIN_ID='$replyUserId'";
                                            }

                                            $ownerPic = "img_avatar.png";
                                            $ownerEmail = "unknown email";
                                            $ownerType = $reply['user_type'];
                                            if ($resOwner = @mysqli_query($conn, $sqlReplyOwner)) {
                                                if ($resOwner->num_rows > 0) {
                                                    $owner = $resOwner->fetch_assoc();
                                                    $ownerPic = $owner['profile_pic'];
                                                    $ownerEmail = $owner['email'];
                                                }
                                            }
                                            if ($reply['user_type'] == 0) {
                                                $ownerEmail = "Administrator";
                                            } else if ($reply['user_type'] == 3) {
                                                $ownerEmail = "Signatory";
                                            }
                                    ?>
                                            <div class="w-100 border p-3 mt-3 mb-3" style="min-height: 100px;">
                                                <div class="row">
                                                    <div class="col-12 col-md-10">
                                                        <div class="d-flex flex-row">
                                                            <img class="rounded-circle me-lg-2" src="<?= checkProfilePicture($ownerType, $ownerPic) ?>" alt="" style="width: 38px; height: 38px;border: 2px solid #F2AC1B;">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <h6 style="font-size: 16px; margin: 0px;"><?= $reply['user_name'] ?></h6>
                                                                </div>
                                                                <div class="row">
                                                                    <h6 class="text-gray" style="font-size: 12px; margin: 0px;"><?= $ownerEmail ?></h6>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-12 col-lg-4 col-md-4 d-none d-sm-block">
                                                        <h6 class="text-secondary text-right" style="font-size: 12px;"><?= date('M. d, Y h:i A', $reply['reply_id']) ?></h6>
                                                    </div>
                                                </div>
                                                <hr style="color: #dee2e6;">
                                                <div class="msg-body">
                                                    <?= $reply['message'] ?>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }

                                    ?>
                                </div>

                                <nav class="mt-4 d-flex flex-row justify-content-end">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a href="?page=1&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link text-dark">First</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="?page=<?php if ($page_no == 1) echo "1";
                                                            else echo $page_no - 1; ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link text-dark">Previous</a>
                                        </li>

                                        <?php
                                        if ($total_no_of_pages <= 5) {
                                            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                                        ?>
                                                <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                                                    <a href="?page=<?= $i ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
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
                                                        <a href="?page=<?= $i ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                                                    </li>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>

                                        <li class="page-item">
                                            <a href="?page=<?php if ($page_no == $total_no_of_pages) echo $total_no_of_pages;
                                                            else echo $page_no + 1; ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link text-dark">Next</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="?page=<?= $total_no_of_pages ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" class="page-link text-dark">Last</a>
                                        </li>
                                    </ul>
                                </nav>

                                <hr style="color: #dee2e6; margin-top: 40px;">
                            <?php
                            }
                            ?>

                            <?php
                            if ($threadLocked == 1) {
                            ?>
                                <div>
                                    <h6 class="text-secondary text-center">This thread has been locked.</h6>
                                </div>
                            <?php
                            } else {
                            ?>
                                <form action="?topic=<?= $topicid ?>&thread=<?= $threadid ?>" method="POST">
                                    <h6>Reply to this thread</h6>
                                    <textarea id="replybox" name="reply-msg"></textarea>
                                    <div class="d-flex flex-row justify-content-end mt-3">
                                        <button type="submit" name="post-reply" class="btn btn-primary small">Post Reply</button>
                                    </div>
                                </form>
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

        <?php
        if (isset($_POST['post-reply'])) {
            $offset = ($total_no_of_pages - 1) * $total_records_per_page;
            echo "<script>window.scrollTo(0,document.body.scrollHeight)</script>";
        }
        ?>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!-- form validation/sidebar toggle -->
        <script src="../assets/js/form-validation.js"></script>
        <!-- waves js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
        <!-- JavaScript validation -->
        <script type="text/javascript">
            Waves.attach('#sidebar ul li a');
            Waves.attach('.button');
            Waves.init();
        </script>
        <script src="../assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#replybox',
                plugins: 'link image textcolor',
                height: 300,
                menubar: 'edit view insert format',
                toolbar: 'undo redo | styles | bold italic underline forecolor backcolor | link | alignleft aligncenter alignright',
            });
        </script>
</body>

</html>
