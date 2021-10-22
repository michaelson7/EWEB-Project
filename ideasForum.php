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
                                            <img id="headerImg" class=" rounded-circle" src="https://i.imgur.com/t9toMAQ.jpg" width="200" height="180">
                                        </div>
                                        <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                                            <i class="fa fa-sort-up fa-2x hit-voting"></i><span>127</span><i class="fa fa-sort-down fa-2x hit-voting"></i>
                                        </div>
                                        <div class="d-flex flex-column ml-3">
                                            <div class="">
                                                <h5 id="header">Header</h5>
                                                <p id="message" class=" text-muted">Message</p>
                                            </div>
                                            <div class="d-flex flex-row align-items-center align-content-center post-title">
                                                <span class="bdge mr-1">post</span>
                                                <span class="mr-2 comments"> comments&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coment-bottom  p-2 px-4 ">
                                        <div class=" mb-4 bg-dark p-2 rounded">
                                            <form id="modalForm" method="post" action="API/API.php?apicall=ideas&src=create&SubjectId=<?php echo $_GET["Id"] ?>" enctype="multipart/form-data">
                                                <input class="d-none" name="Title" value="">
                                                <input class="d-none" name="Header" value="">
                                                <input class="d-none" name="UploaderId" value="<?php echo $_COOKIE["UserId"] ?>">
                                                <input class="d-none" name="IdeaCategoryId" value="4">
                                                <input type="file" class="form-control d-none" name="ImgPath" id="ImgPath">

                                                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                                    <img class=" rounded-circle mr-2" width="45" height="45" src="https://images.unsplash.com/photo-1543610892-0b1f7e6d8ac1?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8YXZhdGFyfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
                                                    <input type="text" class="form-control mr-3" name="Description" placeholder="Add comment">
                                                    <button class="btn btn-primary" type="submit" disabled id="button">Comment</button>
                                                </div>

                                                <div class=" d-flex justify-content-between align-content-center">
                                                    <div>
                                                        <label class="font-weight-bold">Attach</label>
                                                        <input type="file" class="form-control w-100" name="ImgPath" id="ImgPath">
                                                    </div>
                                                    <div>
                                                        <input id="checkBtn" onclick="validate()" type="checkbox" name="" id="">
                                                        <label for="">By uploading, you agree to out <a href="https://www.websitepolicies.com/uploads/docs/terms-and-conditions-template.pdf">Terms and conditions</a></label>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <div class=" mt-4">
                                            <label>Filter By</label>
                                            <select onchange="filter()" name="filterFunction" id="filterFunction" class="form-control w-100">
                                                <option value="Date">Date</option>
                                                <option value="Likes">Most Liked</option>
                                                <option value="Disliked">Most Disliked</option>
                                            </select>
                                        </div>



                                        <div id="cardBody" class=" mt-4"></div>

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

    // button
    function validate() {
        var checkBox = document.getElementById("checkBtn");
        if (checkBox.checked == true) {
            document.getElementById("button").disabled = false;

        } else {
            document.getElementById("button").disabled = true;
        }
    }

    $(document).ready(function() {
        getData("Date");
    });

    function hide(id) {
        $(`#${id}`).hide();
    }

    function filter() {
        var filterValue = $("#filterFunction :selected").val();
        $('#cardBody').html('');
        getData(filterValue);
    }

    function getData(filter) {
        var id = getUrlParameter("Id");
        console.log(id);
        url = `subjects&src=get&Id=${id}`;
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                var dataList = response.results[i];
                console.log(dataList);
                $('#header').html(dataList.Header);
                $('#message').html(dataList.Message);
                $("#headerImg").attr("src", dataList.ImgPath);
                headerImg
            }
        });
        getMoreData(filter);
    }

    function getMoreData(filter) {
        $('#cardBody').html('');
        url = `ideas&src=getAll&filter=${filter}&subjectId=<?php echo $_GET["Id"] ?>`;
        sendRequest(form_data, url).then(response => {
            for (i in response.results) {
                var dataList = response.results[i];
                $(`<div class="commented-section mt-2 bg-dark rounded p-3">
                        <div class="d-flex flex-row align-items-center commented-user justify-content-between">
                            <h5 class="mr-2">${dataList.Names}</h5>
                            <i class=" icofont-close text-danger" onclick="deletePost('${dataList.Id}')"></i>
                        </div>
                        <div class="comment-text-sm"><span>${dataList.Description}</span></div>
                        <div class=" text-center">
                            <img src="${response.results[i].ImgPath}" width="500" height="300" class="rounded" id="image_${i}" alt="File Not Found" onerror="this.onerror=hide('image_${i}'); 
                            this.src='https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg'" />
                        </div>
                        <div class="d-flex flex-row align-items-center voting-icons">
                            <div class="d-flex flex-row align-items-center voting-icons">
                                <i onClick="likeIdea('${dataList.Id}')" class="fa fa-sort-up fa-2x mt-3 hit-voting"></i>
                                <i onClick="DislikeIdea('${dataList.Id}')" class="fa fa-sort-down fa-2x mb-3 hit-voting "></i>
                            </div>
                            <div class=" ml-5">
                                <i class="p-2">Likes: ${dataList.Likes}</i>
                                <i class="p-2">Dislikes: ${dataList.Dislikes}</i>
                            </div>
                        </div>
                    </div>`)
                    .appendTo('#cardBody');
            }
        });
    }

    function deletePost(id) {
        var url = "ideas&src=delete&Id=" + id;
        sendRequest(form_data, url).then(response => {
            if (!response.error) {
                alertify.success("Idea Removed");
                getData("Date");
            } else {
                alertify.error("ERROR, check logs");
            }
        });
    }

    function likeIdea(id) {
        var url = "ideastats&src=create";
        form_data.append("IdeaId", id);
        form_data.append("Likes", 1);
        form_data.append("Dislikes", 0);
        form_data.append("UserId", <?php echo $_COOKIE["UserId"] ?>);
        sendRequest(form_data, url).then(response => {
            if (!response.error) {
                alertify.success("Idea Liked");
                getData("Date");
            } else {
                alertify.error("ERROR, check logs");
            }
        });
    }

    function DislikeIdea(id) {
        var url = "ideastats&src=create";
        form_data.append("IdeaId", id);
        form_data.append("Likes", 0);
        form_data.append("Dislikes", 1);
        form_data.append("UserId", <?php echo $_COOKIE["UserId"] ?>);
        sendRequest(form_data, url).then(response => {
            if (!response.error) {
                alertify.success("Idea Disliked");
                getData("Date");
            } else {
                alertify.error("ERROR, check logs");
            }
        });
    }
</script>