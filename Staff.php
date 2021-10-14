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
                        <h4 class="mt-4">Staff</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Staff</li>
                        </ol>
                    </div>


                    <div>
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target=".ModelDialog">Add Staff</button>
                    </div>

                    <div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Current Staff
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>UserId</th>
                                                <th>DepartmentId</th>
                                                <th>Action</th>
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

<div id="modal" class="modal fade ModelDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="modalForm" method="post" action="API/API.php?apicall=staffdepartment&src=create">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Staff Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <select name="UserId" id="UserId" class="form-control"></select>
                        <label>Department</label>
                        <select name="DepartmentId" id="DepartmentId" class="form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var url;
    var formId;
    var form_data = new FormData();

    $(document).ready(function() {
        getData();
        getRoles();
    });

    function getData() {
        url = "staffdepartment&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#dataTable').DataTable().row.add([
                    response.results[i].Id,
                    response.results[i].UserId,
                    response.results[i].DepartmentId,
                    `<div>
                        <form id="formSubmit" action="" method="POST">
                            <a onclick="editModel(${i},${response.results[i].Id})" class=" btn btn-primary m-1">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete this?')" 
                            href='API/API.php?apicall=staffdepartment&src=delete&Id=${response.results[i].Id}' class="btn btn-danger m-1">Delete</a>
                        </form>   
                    </div>`,
                ]).draw();
            }
        });
    }

    function getRoles() {
        url = "users&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#UserId').append($('<option>', {
                    value: response.results[i].Id,
                    text: response.results[i].Names,
                }));
            }
        });

        url = "departments&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#DepartmentId').append($('<option>', {
                    value: response.results[i].Id,
                    text: response.results[i].Title,
                }));
            }
        });
    }


    function editModel(index, Id) {
        var table = $('#dataTable').DataTable();

        //get data
        var id = table.row(index).data()[0];
        var UserId = table.row(index).data()[1];
        var DepartmentId = table.row(index).data()[2];

        document.getElementById('modalForm').action = `API/API.php?apicall=staffdepartment&src=update&Id=${Id}`;
        // $('input[name=Names]').val(Names);
        // $('input[name=Email]').val(Email);

        $("#modal").modal()
    }
</script>