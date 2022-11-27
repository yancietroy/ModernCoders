<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Singapore');

include('../router.php');
route(3);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;

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
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
$data_orgid = $_SESSION['USER-ORG'];
$data_collegeid = $_SESSION['USER-COLLEGE'];
$orgName = "";
$_SESSION['ORG'] = $orgName;
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
    if ($orgRes->num_rows > 0) {
        $row = $orgRes->fetch_assoc();
        $orgName = $row['ORG'];
    }
}

$collName = "";
$_SESSION['college'] = $collName;
$query = "SELECT college FROM tb_collegedept WHERE college_id='$data_collegeid'";
if ($collRes = @mysqli_query($conn, $query)) {
    if ($collRes->num_rows > 0) {
        $row = $collRes->fetch_assoc();
        $collName = $row['college'];
    }
}
$data_picture = getProfilePicture(3, $data_userid);
$nav_selected = "Organizations / Organization";
$nav_breadcrumbs = [
    ["Home", "signatory-index.php", "bi-house-fill"],
    ["Discussion Forum", "", ""],
    ["Threads", "forum-threads.php?topic=$topicid", ""],
    ["Post", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$error = -1;
if (isset($_POST['post-reply'])) {
    $replymsg =  $mysqli->real_escape_string($_POST['reply-msg']) ?? "";
    if ($replymsg != "") {
        $timestamp = time();
        $sqlPost = "INSERT INTO tb_disc_replies(reply_id,thread_id,user_type,user_id,user_name,message) VALUES
    ('$timestamp','$threadid','3','$data_userid','$data_name','$replymsg')";
        if (@mysqli_query($conn, $sqlPost)) {
            // Increment replies
            $sqlReplyCount = "UPDATE tb_disc_threads SET replies = replies + 1,last_reply='$timestamp',last_reply_name='$data_name' WHERE thread_id='$threadid'";
            mysqli_query($conn, $sqlReplyCount);
        } else {
            $errro = 0;
            //echo "<script>alert('Error while posting your reply. Please try again.')</script>";
        }
    } else {
        $errro = 1;
        //echo "<script>alert('Unable to reply an empty message. Please try again.')</script>";
    }
} else if (isset($_POST['delete-reply'])) {
    $replyid = $_POST['delete-id'];
    $sqlDel = "UPDATE tb_disc_replies SET status='0' WHERE reply_id='$replyid'";
    if (@mysqli_query($conn, $sqlDel)) {
        $errro = 2;
        //echo "<script>alert('Reply has been deleted successfully.')</script>";
    } else {
        $errro = 3;
        //echo "<script>alert('Error while delete the reply. Please try again.')</script>";
    }
} else if (isset($_POST['edit-reply'])) {
    $replyid = $_POST['edit-id'];
    $msg = $mysqli->real_escape_string($_POST['edit-msg']) ?? "";
    $timestamp = time();
    $sqlUpd = "UPDATE tb_disc_replies SET message='$msg', edited='$timestamp' WHERE reply_id='$replyid'";
    if (@mysqli_query($conn, $sqlUpd)) {
        $errro = 4;
        //echo "<script>alert('Reply has been edited successfully.')</script>";
    } else {
        $errro = 5;
        //echo "<script>alert('Error while editing your reply. Please try again.')</script>";
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                  <img class="rounded-circle me-lg-2" src="<?= $makerPic ?>" alt="" style="width: 120px; height: 120px;border: 2px solid #F2AC1B;">
                  <h6 class="mt-3"><?= $makerName ?></h6>
                  <div style="overflow: hidden; text-overflow: ellipsis;">
                    <h6 class="mt-1" style="color:#F2AC1B; font-size: 11px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $makerEmail ?></h6>
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
                  <h6 class="mt-3 text-secondary" style="font-size: 10px;">Date Posted: <?= date('M. d Y', $threadid) ?></h6>
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
                                                    <div class="col">
                                                        <div class="d-flex flex-row">
                                                            <img class="rounded-circle me-lg-2" src="<?= checkProfilePicture($ownerType, $ownerPic) ?>" alt="" style="width: 38px; height: 38px;border: 2px solid #F2AC1B;">
                                                            <div class="col-12 col-md-10">
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
                                                        <div class="row">
                                                            <h6 class="text-secondary text-right m-0" style="font-size: 12px;">
                                                                <?php
                                                                if ($reply['edited'] > 0) {
                                                                    echo "Edited " . date('M. d, Y h:i A', $reply['edited']);
                                                                } else {
                                                                    echo date('M. d, Y h:i A', $reply['reply_id']);
                                                                }
                                                                ?>
                                                            </h6>

                                                        </div>
                                                        <?php
                                                        if ($reply['status'] == 1 &&  $replyUserId == $data_userid) {
                                                        ?>
                                                            <div class="row">
                                                                <div class="d-flex flex-row justify-content-end">
                                                                    <a href="#" onclick="editReply('<?= $reply['reply_id'] ?>')" class="text-primary text-right m-0 mr-3" style="font-size: 12px;">Edit</a>
                                                                    <a href="#" onclick="deleteReply('<?= $reply['reply_id'] ?>')" class="text-danger text-right m-0" style="font-size: 12px;">Delete</a>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                                <hr style="color: #dee2e6;">
                                                <div class="msg-body" id="reply-body-<?= $reply['reply_id'] ?>">
                                                    <?php
                                                    if ($reply['status'] == 1) {
                                                        echo $reply['message'];
                                                    } else if ($reply['status'] == -1) {
                                                    ?>
                                                        <p class="text-secondary text-center text-danger">This reply has been deleted by an administrator.</p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="text-secondary text-center">This reply has been deleted.</p>
                                                    <?php
                                                    }
                                                    ?>
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

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Reply </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="?page=<?= $page_no ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" method="POST">
                        <div class="modal-body">
                            <div class="col-12 col-md-12 justify-content-center ">
                                <p>Are you sure do you want to delete this reply? This action is not reversible.</p>
                                <input type="text" id="delete-id" name="delete-id" style="display: none;">
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="delete-reply" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Reply </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="?page=<?= $page_no ?>&topic=<?= $topicid ?>&thread=<?= $threadid ?>" method="POST">
                        <div class="modal-body">
                            <div class="col-12 col-md-12 justify-content-center ">
                                <div class="form-outline">
                                    <input type="text" id="edit-id" name="edit-id" style="display: none;">
                                    <textarea name="edit-msg" id="edit-msg"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2 px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="edit-reply" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['post-reply'])) {
            $offset = ($total_no_of_pages - 1) * $total_records_per_page;
            echo "<script>window.scrollTo(0,document.body.scrollHeight)</script>";
        }

        if ($error == 0) {
            $_SESSION["sweetalert"] = [
                "title" => "Post Reply",
                "text" => "Error while posting your reply. Please try again.",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
            ];
        } else if ($error == 1) {
            $_SESSION["sweetalert"] = [
                "title" => "Post Reply",
                "text" => "Unable to reply an empty message. Please try again.",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
            ];
        } else if ($error == 2) {
            $_SESSION["sweetalert"] = [
                "title" => "Delete Reply",
                "text" => "Reply has been deleted successfully.",
                "icon" => "success", //success,warning,error,info
                "redirect" => null,
            ];
        } else if ($error == 3) {
            $_SESSION["sweetalert"] = [
                "title" => "Delete Reply",
                "text" => "Error while delete the reply. Please try again.",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
            ];
        } else if ($error == 4) {
            $_SESSION["sweetalert"] = [
                "title" => "Edit Reply",
                "text" => "Reply has been edited successfully.",
                "icon" => "success", //success,warning,error,info
                "redirect" => null,
            ];
        } else if ($error == 5) {
            $_SESSION["sweetalert"] = [
                "title" => "Edit Reply",
                "text" => "Error while editing your reply. Please try again.",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
            ];
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
                plugins: 'link image',
                height: 300,
                menubar: 'edit view insert format',
                toolbar: 'undo redo | styles | bold italic underline forecolor backcolor | link | alignleft aligncenter alignright',
            });
            tinymce.init({
                selector: '#edit-msg',
                plugins: 'link image',
                menubar: 'edit view insert format',
                toolbar: 'undo redo | styles | bold italic underline forecolor backcolor | link | alignleft aligncenter alignright',
            });
            document.addEventListener('focusin', (e) => {
                if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                    e.stopImmediatePropagation();
                }
            });
        </script>


        <script>
            function deleteReply(id) {
                $('#delete-id').val(id);
                $('#deleteModal').modal('show');
            }

            function editReply(id) {
                $('#edit-id').val(id);
                console.log('#reply-body-' + id);
                var content = $('#reply-body-' + id).html();
                tinyMCE.get("edit-msg").setContent(content);
                $('#editModal').modal('show');
            }
        </script>
        <?php
        include('include/sweetalert.php');
        ?>
</body>
</html>