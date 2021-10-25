<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon">
                        <i class="icofont-dashboard-web"></i>
                    </div>
                    Dashboard
                </a>

                <!-- meta data -->
                <div id="adminBlock" class=" d-none">
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link" href="AcademicYear.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-book-alt"></i>
                        </div>
                        Academic Year
                    </a>
                    <a class="nav-link" href="Roles.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                        Roles
                    </a>
                    <!-- <a class="nav-link" href="Staff.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                        Staff
                    </a> -->
                    <a class="nav-link" href="Users.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                        Users
                    </a>
                    <a class="nav-link" href="Departments.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                        Departments
                    </a>
                </div>

                <div id="qamBlock" class=" d-none">
                    <div class="sb-sidenav-menu-heading">QAM</div>
                    <a class="nav-link" href="IdeaCategories.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-school-bag"></i>
                        </div>
                        Idea Categories
                    </a>
                    <a class="nav-link" href="AllIdeas.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-school-bag"></i>
                        </div>
                        All Ideas
                    </a>
                </div>

                <div id="qacBlock" class=" d-none">
                    <div class="sb-sidenav-menu-heading">QAC</div>
                    <a class="nav-link" href="DepartmentIdeas.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-school-bag"></i>
                        </div>
                        Department Ideas
                    </a>
                    <a class="nav-link" href="IdeaSubjects.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-school-bag"></i>
                        </div>
                        Idea Subjects
                    </a>
                </div>

                <div id="staffBlock" class=" d-none">
                    <div class="sb-sidenav-menu-heading">Staff</div>
                    <a class="nav-link" href="Ideas.php">
                        <div class="sb-nav-link-icon">
                            <i class="icofont-school-bag"></i>
                        </div>
                        Ideas
                    </a>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <p id="UserName"></p>
        </div>
    </nav>
</div>

<script>
    var role = getCookie("Role");
    document.getElementById(`UserName`).innerHTML = getCookie("UserName");;

    if (role == "Admin") {
        $('#adminBlock').removeClass('d-none');
    } else if (role == "Quality+Assurance+Manager") {
        $('#qamBlock').removeClass('d-none');
    } else if (role == "Quality+Assurance+Coordinator") {
        $('#qacBlock').removeClass('d-none');
    } else if (role == "Staff") {
        $('#staffBlock').removeClass('d-none');
    }
</script>