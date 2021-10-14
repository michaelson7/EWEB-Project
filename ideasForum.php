<?php
require_once("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home-Dashboard</title>
    <?php require_once("includes/header.php"); ?>

    <style>
        .bdge {
            height: 21px;
            background-color: orange;
            color: #fff;
            font-size: 11px;
            padding: 8px;
            border-radius: 4px;
            line-height: 3px
        }

        .comments {
            text-decoration: underline;
            text-underline-position: under;
            cursor: pointer
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-top: 3px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .hit-voting:hover {
            color: blue
        }

        .hit-voting {
            cursor: pointer
        }
    </style>
</head>

<body class="sb-nav-fixed ">

    <!-- adding nav bar -->
    <?php require_once("includes/elements/nav.php"); ?>

    <div id="layoutSidenav">

        <!-- adding side menu -->
        <?php include("includes/elements/side_nav.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">

                    <div>
                        <div>
                            <div class="d-flex justify-content-center row">
                                <div class="d-flex flex-column col-md-12">
                                    <div class="d-flex flex-row align-items-center text-left comment-top p-2 border-bottom px-4">
                                        <div class="profile-image">
                                            <img class="rounded-circle" src="https://i.imgur.com/t9toMAQ.jpg" width="70">
                                        </div>
                                        <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                                            <i class="fa fa-sort-up fa-2x hit-voting"></i><span>127</span><i class="fa fa-sort-down fa-2x hit-voting"></i>
                                        </div>
                                        <div class="d-flex flex-column ml-3">
                                            <div class="d-flex flex-row post-title">
                                                <h5>Is sketch 3.9.1 stable?</h5><span class="ml-2">(Jesshead)</span>
                                            </div>
                                            <div class="d-flex flex-row align-items-center align-content-center post-title">
                                                <span class="bdge mr-1">video</span>
                                                <span class="mr-2 comments">13 comments&nbsp;</span>
                                                <span class="mr-2 dot"></span>
                                                <span>6 hours ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coment-bottom  p-2 px-4">
                                        <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                            <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38">
                                            <input type="text" class="form-control mr-3" placeholder="Add comment"><button class="btn btn-primary" type="button">Comment</button>
                                        </div>

                                        <div class="commented-section mt-2 bg-dark rounded p-3">
                                            <div class="d-flex flex-row align-items-center commented-user ">
                                                <h5 class="mr-2">Corey oates</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">4 hours ago</span>
                                            </div>
                                            <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                            <div class="reply-section">
                                                <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                    <h6 class="ml-2 mt-1">Reply</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="commented-section mt-2 bg-dark rounded p-3">
                                            <div class="d-flex flex-row align-items-center commented-user ">
                                                <h5 class="mr-2">Corey oates</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">4 hours ago</span>
                                            </div>
                                            <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                            <div class="reply-section">
                                                <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                    <h6 class="ml-2 mt-1">Reply</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="commented-section mt-2 bg-dark rounded p-3">
                                            <div class="d-flex flex-row align-items-center commented-user ">
                                                <h5 class="mr-2">Corey oates</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">4 hours ago</span>
                                            </div>
                                            <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                            <div class="reply-section">
                                                <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                    <h6 class="ml-2 mt-1">Reply</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
            <!-- adding footer -->
            <?php include("includes/elements/footer.php"); ?>
        </div>
    </div>
</body>

</html>
<script src="assets/js/scripts.js"></script>



<script>
    var url;
    var formId;
    var form_data = new FormData();

    $(document).ready(function() {
        //getData();
    });

    function getData() {
        url = "subjects&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                var dataList = response.results[i];
                $(`<div class="col-md-4 rounded w-100 mt-2 mb-2">
                        <div class="card">
                            <div>
                                <img height="400" class="w-100 rounded" src="${dataList.ImgPath}" alt="">
                            </div>
                            <div class=" p-3">
                                <h5 class="font-weight-bodld">${dataList.Header}</h5>
                                <p class="text-muted">
                                    ${dataList.Message}
                                </p>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <a href="ideasForum.php?Id=${dataList.Id}" class="btn btn-outline-info rounded">Read More</a>
                                    <p><i class="icofont-chat text-muted"> </i> 25</p>
                                </div>
                            </div>
                        </div>
                    </div> `)
                    .appendTo('#cardBody');
            }
        });
    }
</script>