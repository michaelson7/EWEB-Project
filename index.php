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
        <?php require_once("includes/elements/side_nav.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h4 class="mt-4">University Dashboard</h4>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <!-- colored cards stats -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <!-- fetch user# -->
                                    <h4> Users</h4>
                                    <span id="userNum"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h4>Events</h4>
                                    <span id="eventNum"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h4>Resources</h4>
                                    <span id="resourceNum"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h4>Faculties</h4>
                                    <span id="facultyNum"><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- charts -->
                    <div class="row">
                        <!-- sold products -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area mr-1"></i>
                                    User Growth
                                </div>
                                <div class="card-body"><canvas id="growthChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>

                        <!-- best selling products -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Popular Resource
                                </div>
                                <div class="card-body"><canvas id="resourceChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>

                    <!-- database table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Current Resources
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Pdf File</th>
                                            <th>Unloader</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Pdf File</th>
                                            <th>Unloader</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tableData">

                                    </tbody>
                                </table>
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
    //sorting tables by id
    $('#dataTable').DataTable({
        "order": [
            [0, "desc"]
        ]
    });

    //set up chart
    Chart.defaults.global.defaultFontColor = 'white';
    var ctx = document.getElementById('growthChart').getContext('2d');
    var rChart = document.getElementById('resourceChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['10 jan', '20 jan', '15 feb', '20 feb', '12 march'],
            datasets: [{
                label: '# of New Users',
                data: [18, 23, 5, 34, 27],
                backgroundColor: ['#2c80a754'],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var myChart = new Chart(rChart, {
        type: 'pie',
        data: {
            labels: ['Economics', 'Art', 'Law', 'ICT', 'ECommerce'],
            datasets: [{
                data: [23, 12, 4, 33, 11],
                backgroundColor: [
                    '#3d5c7a',
                    '#5da72c',
                    '#a75d2c',
                    '#9d2ca7',
                    '#a72c4b',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {}
    });

    //get stats
    function getStatResult(url, formId, form_data) {
        var x = 0;
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                x += 1;
            }
            document.getElementById(`${formId}`).innerHTML = x;
        });
    }

    //get Resource data
    function getResourceTbl(url, formId, form_data) {
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#dataTable').DataTable().row.add([
                    response.results[i].Id,
                    response.results[i].Name,
                    response.results[i].Description,
                    `<a href=" ${response.results[i].PdfPath}" target="_blank">Read File</a> `,
                    response.results[i].UserName,
                ]).draw();
            }
        });
    }
</script>