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
                        <h4 class="mt-4">subjects</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">subjects</li>
                        </ol>
                    </div>


                    <div>
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target=".ModelDialog">Add subjects</button>
                    </div>

                    <div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Current subjects
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Thumbnail</th>
                                                <th>Header</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableData" class=""></tbody>
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
            <form id="modalForm" method="post" action="API/API.php?apicall=subjects&src=create" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">subjects Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="font-weight-bold">Thumbnail</label>
                                    <input type="file" class="form-control" name="ImgPath" id="ImgPath">
                                </div>
                                <div>
                                    <img id="imgSource" src="" width="220" height="180" class=" rounded" alt="File Not Found" onerror="this.onerror=null; 
                                    this.src='https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg'" />
                                </div>
                            </div>
                            <label>Department</label>
                            <select name="DepartmentId" id="DepartmentId" class="form-control"></select>
                            <label>Header</label>
                            <input type="text" class="form-control" name="Header" required>
                            <label>Message</label>
                            <textarea id="Message" name="Message" class="form-control" required></textarea>
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
        var DepartmentId = getCookie("DepartmentId");
        url = "subjects&src=getAll&Id=" + DepartmentId;
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#dataTable').DataTable().row.add([
                    response.results[i].Id,
                    `<img src="${response.results[i].ImgPath}" width="120" height="100" class="rounded" alt="File Not Found"
                    onerror="this.onerror=null; this.src='https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg'" />`,
                    response.results[i].Header,
                    response.results[i].Message,
                    `<div>
                        <form id="formSubmit" action="" method="POST">
                            <a onclick="editModel(${i},${response.results[i].Id})" class=" btn btn-primary m-1">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete this?')" 
                            href='API/API.php?apicall=subjects&src=delete&Id=${response.results[i].Id}' class="btn btn-danger m-1">Delete</a>
                        </form>   
                    </div>`,
                ]).draw();
            }
        });
    }


    function getRoles() {
        url = "departments&src=getAll";
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                $('#DepartmentId').append($('<option>', {
                    value: response.results[i].Id,
                    text: response.results[i].Title + ' ' + response.results[i].Id,
                }));
            }
        });
    }


    function editModel(index, Id) {
        var table = $('#dataTable').DataTable();

        //get data
        var id = table.row(index).data()[0];
        var Header = table.row(index).data()[2];
        var Message = table.row(index).data()[3];

        document.getElementById('modalForm').action = `API/API.php?apicall=subjects&src=update&Id=${Id}`;
        $('input[name=Header]').val(Header);
        $("textarea#Message").val(Message);

        $("#modal").modal()
    }

    document.getElementById('ImgPath').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById('imgSource').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
    }
</script>