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
                        <h4 class="mt-4">ideas</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">ideas</li>
                        </ol>
                    </div>

                    <div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Current ideas
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

<div id="modal" class="modal fade ModelDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="modalForm" method="post" action="API/API.php?apicall=ideas&src=create">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ideas Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Names</label>
                        <input type="text" class="form-control" name="Names" required>
                        <label>Email</label>
                        <input type="text" class="form-control" name="Email" required>
                        <label>Password</label>
                        <input type="password" class="form-control" name="Password" required>
                        <label>PhoneNumber</label>
                        <input type="text" class="form-control" name="PhoneNumber" required>
                        <label>Role</label>
                        <select name="RoleId" id="RoleId" class="form-control"></select>
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
        //getRoles();
    });

    function getData() {
        url = "ideas&src=getAll2";
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

    function getRoles() {
        url = "roles&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#RoleId').append($('<option>', {
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
        var Names = table.row(index).data()[1];
        var Email = table.row(index).data()[2];
        var PhoneNumber = table.row(index).data()[3];

        document.getElementById('modalForm').action = `API/API.php?apicall=ideas&src=update&Id=${Id}`;
        $('input[name=Names]').val(Names);
        $('input[name=Email]').val(Email);
        $('input[name=PhoneNumber]').val(PhoneNumber);

        $("#modal").modal()
    }
</script>