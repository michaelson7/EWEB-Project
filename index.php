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
                    <h4 class="mt-4"> Dashboard</h4>
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
                                    <h4>Departments</h4>
                                    <span id="departmentNum"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h4>Subjects</h4>
                                    <span id="subjectNum"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h4>Ideas</h4>
                                    <span id="ideaNum"><br>
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
                                    Posts Per Subject
                                </div>
                                <div class="card-body"><canvas id="growthChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>

                        <!-- best selling products -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Percentage Per Department
                                </div>
                                <div class="card-body"><canvas id="resourceChart" width="100%" height="40"></canvas></div>
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
    //set up chart

    $(document).ready(function() {
        getChartData();
        getData();
    });

    function getData() {
        url = "stats&src=cardStats";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                var date = response.results[i];
                $('#userNum').html(date.userCount);
                $('#departmentNum').html(date.departmentCount);
                $('#subjectNum').html(date.subjectsCount);
                $('#ideaNum').html(date.ideasCount);
            }
        });

        getChartData();
    }

    function getChartData() {
        Chart.defaults.global.defaultFontColor = 'white';
        var ctx = document.getElementById('growthChart').getContext('2d');
        var rChart = document.getElementById('resourceChart').getContext('2d');

        var department = [];
        var value = [];

        url = "stats&src=subjectStats";
        sendRequest(form_data, url).then(response => {
            console.log(response.results);
            for (i in response.results) {
                var data = response.results[i];
                department.push(data.title);
                value.push(data.Count);
            }
        });

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: department,
                datasets: [{
                    label: 'posts per department',
                    data: value,
                    backgroundColor: ['#2c80a754'],
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

        var department2 = [];
        var value2 = [];
        url = "stats&src=ideaPercentages";
        sendRequest(form_data, url).then(response => {
            console.log(response.results);
            for (i in response.results) {
                var data2 = response.results[i];
                department2.push(data2.title);
                value2.push(data2.percent);
            }
        });

        var myChart = new Chart(rChart, {
            type: 'pie',
            data: {
                labels: department2,
                datasets: [{
                    data: value2,
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
    }
</script>