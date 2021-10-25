<?php
require_once("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home-Dashboard</title>
    <?php require_once("includes/header.php"); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
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
                        <h4 class="mt-4">Department Ideas</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">D Ideas</li>
                        </ol>
                    </div>

                    <div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Current Ideas for department
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Names</th>
                                                <th>Description</th>
                                                <th>Likes</th>
                                                <th>Dislikes</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableData"></tbody>
                                    </table>
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
        getData();
    });

    function getData() {
        var DepartmentId = getCookie("DepartmentId");
        url = "ideas&src=getByDepartmentId&Id=" + DepartmentId;
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#dataTable').DataTable({
                    dom: 'Bfrtip',
                    "bDestroy": true,
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                }).row.add([
                    response.results[i].Id,
                    response.results[i].Names,
                    response.results[i].Description,
                    response.results[i].Likes,
                    response.results[i].Dislikes,
                    ` <a href="http://${response.results[i].ImgPath}">${response.results[i].ImgPath}</a> `,
                ]).draw();
            }
        });
    }
</script>