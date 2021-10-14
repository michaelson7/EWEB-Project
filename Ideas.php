<?php
require_once("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home-Dashboard</title>
    <?php require_once("includes/header.php"); ?>
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
                        <h4 class="mt-4">users</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">users</li>
                        </ol>
                    </div>

                    <div>
                        <div class="row" id="cardBody">
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
        getData();
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