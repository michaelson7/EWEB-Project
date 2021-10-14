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
                        <h4 class="mt-4">ideacategory</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">ideacategory</li>
                        </ol>
                    </div>


                    <div>
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target=".ModelDialog">Add ideacategory</button>
                    </div>

                    <div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Current ideacategory
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
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
            <form id="modalForm" method="post" action="API/API.php?apicall=ideacategory&src=create">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ideacategory Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="Title" required>
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
    });

    function getData() {
        url = "ideacategory&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#dataTable').DataTable().row.add([
                    response.results[i].Id,
                    response.results[i].Title,
                    `<div>
                        <form id="formSubmit" action="" method="POST">
                            <a onclick="editModel(${i},${response.results[i].Id})" class=" btn btn-primary m-1">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete this?')" 
                            href='API/API.php?apicall=ideacategory&src=delete&Id=${response.results[i].Id}' class="btn btn-danger m-1">Delete</a>
                        </form>   
                    </div>`,
                ]).draw();
            }
        });
    }


    function editModel(index, Id) {
        var table = $('#dataTable').DataTable();

        //get data
        var id = table.row(index).data()[0];
        var Title = table.row(index).data()[1];

        document.getElementById('modalForm').action = `API/API.php?apicall=ideacategory&src=update&Id=${Id}`;
        $('input[name=Title]').val(Title);

        $("#modal").modal()
    }
</script>