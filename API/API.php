<?php
require_once 'starter.php';
require_once 'scripts.php';

if (isset($_GET['apicall'])) {

    switch ($_GET['apicall']) {

            //academic Year
        case 'AcademicYear':

            $src = $_GET['src'];
            $TableName = 'AcademicYear';

            function GetData($stmt)
            {
                $Title = null;
                $ClosureDate = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Title, $ClosureDate);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Title'] = $Title;
                    $temp['ClosureDate'] = $ClosureDate;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Title = $_POST['Title'];
                    $ClosureDate = $_POST['ClosureDate'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Title,ClosureDate)
                        VALUES (?,?)");
                    $stmt->bind_param("ss", $Title, $ClosureDate);
                    getResponse($stmt);
                    header("Location: ../AcademicYear.php");
                    break;

                case 'update':
                    $Title = $_POST['Title'];
                    $ClosureDate = $_POST['ClosureDate'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                        SET Title = ?,ClosureDate = ?
                        WHERE Id = ?");
                    $stmt->bind_param("sss", $Title, $ClosureDate, $Id);
                    getResponse($stmt);
                    header("Location: ../AcademicYear.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                        Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../AcademicYear.php");
                    break;
            }
            break;
            //end

        case 'roles':

            $src = $_GET['src'];
            $TableName = 'roles';

            function GetData($stmt)
            {
                $Title = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Title);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Title'] = $Title;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Title = $_POST['Title'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Title)
                            VALUES (?)");
                    $stmt->bind_param("s", $Title);
                    getResponse($stmt);
                    header("Location: ../roles.php");
                    break;

                case 'update':
                    $Title = $_POST['Title'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                            SET Title = ?
                            WHERE Id = ?");
                    $stmt->bind_param("ss", $Title, $Id);
                    getResponse($stmt);
                    header("Location: ../roles.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                            WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                            Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                            WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../roles.php");
                    break;
            }
            break;
            //end

        case 'users':

            $src = $_GET['src'];
            $TableName = 'users';

            function GetData($stmt)
            {
                $Names = null;
                $Email = null;
                $Password = null;
                $PhoneNumber = null;
                $RoleId  = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Names, $Email, $Password, $PhoneNumber, $RoleId);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Names'] = $Names;
                    $temp['Email'] = $Email;
                    $temp['Password'] = $Password;
                    $temp['PhoneNumber'] = $PhoneNumber;
                    $temp['RoleId'] = $RoleId;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case 'signin':
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];

                    $stmt = $connection->prepare("SELECT u.Id,u.Names,R.title,d.DepartmentId 
                        from $TableName u  
                        INNER JOIN roles R on R.id = u.RoleId
                        Left Join staffdepartment d on d.UserId = u.id 
                        WHERE u.Email = ? and u.Password = ?");
                    $stmt->bind_param("ss", $Email, $Password);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows == 0) {
                        $response['error'] = true;
                        $response['message'] = 'Account false';
                        Response($response);
                         header("Location: ../login.php?error=true");
                        $stmt->close();
                    } else {
                        $stmt->execute();
                        $stmt->bind_result($Id, $Names, $title, $DepartmentId);
                        $results = array();
                        while ($stmt->fetch()) {
                            $temp = array();
                            $temp['Id'] = $Id;
                            $temp['Names'] = $Names;
                            $temp['Roletitle'] = $title;
                            $temp['DepartmentId'] = $DepartmentId;
                            array_push($results, $temp);
                        }
                        $response['error'] = false;
                        $response['results'] = $results;
                        Response($response);

                        //set sessions
                        setcookie("DepartmentId", $DepartmentId, time() + (86400 * 30), "/");
                        setcookie("Role", $title, time() + (86400 * 30), "/");
                        setcookie("UserName", $Names, time() + (86400 * 30), "/");
                        setcookie("UserId", $Id, time() + (86400 * 30), "/");

                        header("Location: ../index.php");
                        $stmt->close();
                    }
                    break;
                case "create":
                    $Names = $_POST['Names'];
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];
                    $PhoneNumber = $_POST['PhoneNumber'];
                    $RoleId = $_POST['RoleId'];
                    $DepartmentId = $_POST['DepartmentId'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Names,Email,Password,PhoneNumber,RoleId)
                                VALUES (?,?,?,?,?)");
                    $stmt->bind_param("sssss", $Names, $Email, $Password, $PhoneNumber, $RoleId);
                    if (!$stmt->execute()) {
                        $state = false;
                        $response['error'] = true;
                        $response['message'] = $connection->errno . ' ' . $connection->error;
                    } else {
                        $Id = $connection->insert_id;

                        $stmt = $connection->prepare("INSERT INTO staffdepartment (UserId,DepartmentId)
                        VALUES (?,?)");
                        $stmt->bind_param("ss",  $Id, $DepartmentId);
                        getResponse($stmt);
                    }
                    header("Location: ../users.php");
                    break;

                case 'update':
                    $Names = $_POST['Names'];
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];
                    $PhoneNumber = $_POST['PhoneNumber'];
                    $RoleId = $_POST['RoleId'];
                    $Id = $_GET['Id'];
                    $DepartmentId = $_POST['DepartmentId'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                SET Names = ?,Email = ?,Password = ?,PhoneNumber = ?,RoleId = ?
                                WHERE Id = ?");
                    $stmt->bind_param("ssssss", $Names, $Email, $Password, $PhoneNumber, $RoleId, $Id);
                    getResponse($stmt);

                    $stmt = $connection->prepare("UPDATE staffdepartment
                                    SET UserId = ?,DepartmentId = ?
                                    WHERE UserId = ?");
                    $stmt->bind_param("sss",  $UserId, $DepartmentId, $UserId);
                    getResponse($stmt);

                    header("Location: ../users.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                                Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../users.php");
                    break;
            }
            break;
            //end

        case 'departments':

            $src = $_GET['src'];
            $TableName = 'departments';

            function GetData($stmt)
            {
                $Title = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Title);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Title'] = $Title;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Title = $_POST['Title'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Title)
                                VALUES (?)");
                    $stmt->bind_param("s", $Title);
                    getResponse($stmt);
                    header("Location: ../departments.php");
                    break;

                case 'update':
                    $Title = $_POST['Title'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                SET Title = ?
                                WHERE Id = ?");
                    $stmt->bind_param("ss", $Title, $Id);
                    getResponse($stmt);
                    header("Location: ../departments.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                                Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../departments.php");
                    break;
            }
            break;
            //end

        case 'staffdepartment':

            $src = $_GET['src'];
            $TableName = 'staffdepartment';

            function GetData($stmt)
            {
                $DepartmentId  = null;
                $UserId = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $UserId, $DepartmentId);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['UserId'] = $UserId;
                    $temp['DepartmentId'] = $DepartmentId;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $UserId = $_POST['UserId'];
                    $DepartmentId = $_POST['DepartmentId'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (UserId,DepartmentId)
                                    VALUES (?,?)");
                    $stmt->bind_param("ss",  $UserId, $DepartmentId);
                    getResponse($stmt);
                    header("Location: ../staff.php");
                    break;

                case 'update':
                    $UserId = $_POST['UserId'];
                    $DepartmentId = $_POST['DepartmentId'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                    SET UserId = ?,DepartmentId = ?
                                    WHERE Id = ?");
                    $stmt->bind_param("sss",  $UserId, $DepartmentId, $Id);
                    getResponse($stmt);
                    header("Location: ../staff.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                                    Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../staff.php");
                    break;
            }
            break;
            //end

        case 'subjects':

            $src = $_GET['src'];
            $TableName = 'subjects';

            function GetData($stmt)
            {
                $Header = null;
                $Message = null;
                $ImgPath = null;
                $DepartmentId  = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Header, $Message, $ImgPath, $DepartmentId);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Header'] = $Header;
                    $temp['Message'] = $Message;
                    $temp['DepartmentId'] = $DepartmentId;
                    $temp['ImgPath'] = GET_IMG . $ImgPath;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Header = $_POST['Header'];
                    $Message = $_POST['Message'];
                    $DepartmentId = $_POST['DepartmentId'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, 0, 'ImgPath');

                    $stmt = $connection->prepare("INSERT INTO $TableName (Header,Message,ImgPath,DepartmentId)
                        VALUES (?,?,?,?)");
                    $stmt->bind_param("ssss", $Header, $Message, $ImgName, $DepartmentId);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    header("Location: ../IdeaSubjects.php");
                    break;

                case 'update':
                    $Header = $_POST['Header'];
                    $Message = $_POST['Message'];
                    $DepartmentId = $_POST['DepartmentId'];
                    $Id = $_GET['Id'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, $Id, 'ImgPath');

                    if ($ImgName != null) {
                        //remove old image
                        unlinkFile($TableName, $Id, 'ImgPath');
                    }

                    $stmt = $connection->prepare("UPDATE $TableName 
                        SET Header = ?,Message = ?,ImgPath = ?,DepartmentId = ?
                        WHERE Id = ?");
                    $stmt->bind_param("sssss", $Header, $Message, $ImgName, $DepartmentId, $Id);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    header("Location: ../IdeaSubjects.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT s.* from $TableName s
                        INNER JOIN Departments d on d.id = s.departmentId
                        where d.id = $Id
                        Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    unlinkFile($TableName, $Id, 'ImgPath');
                    $stmt = $connection->prepare("DELETE from $TableName 
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../IdeaSubjects.php");
                    break;
            }
            break;
            //end

        case 'ideacategory':

            $src = $_GET['src'];
            $TableName = 'ideacategory';

            function GetData($stmt)
            {
                $Title = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Title);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Title'] = $Title;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Title = $_POST['Title'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Title)
                                VALUES (?)");
                    $stmt->bind_param("s", $Title);
                    getResponse($stmt);
                    header("Location: ../IdeaCategories.php");
                    break;

                case 'update':
                    $Title = $_POST['Title'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                SET Title = ?
                                WHERE Id = ?");
                    $stmt->bind_param("ss", $Title, $Id);
                    getResponse($stmt);
                    header("Location: ../IdeaCategories.php");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                                Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                                WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    header("Location: ../IdeaCategories.php");
                    break;
            }
            break;
            //end

        case 'ideastats':

            $src = $_GET['src'];
            $TableName = 'ideastats';

            function GetData($stmt)
            {
                $IdeaId = 'IdeaId';
                $Likes = 'Likes';
                $Dislikes = 'Dislikes';
                $UserId = 'Dislikes';
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $IdeaId, $Likes, $Dislikes, $UserId);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['IdeaId'] = $IdeaId;
                    $temp['Likes'] = $Likes;
                    $temp['UserId'] = $UserId;
                    $temp['Dislikes'] = $Dislikes;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $IdeaId = $_POST['IdeaId'];
                    $Likes = $_POST['Likes'];
                    $Dislikes = $_POST['Dislikes'];
                    $UserId  = $_POST['UserId'];

                    $stmt = $connection->prepare("SELECT *
                    from $TableName  
                    WHERE IdeaId = ? and UserId = ?");
                    $stmt->bind_param("ss", $IdeaId, $UserId);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        $stmt->close();
                        $stmt = $connection->prepare("DELETE
                        from $TableName  
                        WHERE IdeaId = ? and UserId = ?");
                        $stmt->bind_param("ss", $IdeaId, $UserId);
                        $stmt->execute();
                    }
                    $stmt->close();

                    $stmt = $connection->prepare("INSERT INTO $TableName (IdeaId,Likes,Dislikes,UserId)
                                    VALUES (?,?,?,?)");
                    $stmt->bind_param("ssss", $IdeaId, $Likes, $Dislikes, $UserId);
                    getResponse($stmt);
                    break;

                case 'update':
                    $IdeaId = $_POST['IdeaId'];
                    $Likes = $_POST['Likes'];
                    $Dislikes = $_POST['Dislikes'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                    SET IdeaId = ?,Likes=?,Dislikes=?
                                    WHERE Id = ?");
                    $stmt->bind_param("ssss",  $IdeaId, $Likes, $Dislikes, $Id);
                    getResponse($stmt);
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                                    Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("DELETE from $TableName 
                                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    break;
            }
            break;
            //end

        case 'ideas':

            $src = $_GET['src'];
            $TableName = 'ideas';

            function GetData($stmt)
            {
                $SubjectId  = null;
                $UploaderId  = null;
                $IdeaCategoryId  = null;
                $Header  = null;
                $Description  = null;
                $FilePath  = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $SubjectId, $UploaderId, $IdeaCategoryId, $Header, $Description, $FilePath);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['SubjectId'] = $SubjectId;
                    $temp['UploaderId'] = $UploaderId;
                    $temp['IdeaCategoryId'] = $IdeaCategoryId;
                    $temp['Header'] = $Header;
                    $temp['Description'] = $Description;
                    $temp['ImgPath'] = GET_IMG . $FilePath;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $SubjectId = $_GET['SubjectId'];
                    $UploaderId = $_POST['UploaderId'];
                    $IdeaCategoryId = $_POST['IdeaCategoryId'];
                    $Header = $_POST['Header'];
                    $Description = $_POST['Description'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, 0, 'ImgPath');

                    $stmt = $connection->prepare("INSERT INTO $TableName (SubjectId,UploaderId,IdeaCategoryId,Header,Description,ImgPath)
                        VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ssssss",  $SubjectId, $UploaderId, $IdeaCategoryId, $Header, $Description, $ImgName);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    header("Location: ../IdeasForum.php?Id=$SubjectId");
                    break;

                case 'update':
                    $SubjectId = $_POST['SubjectId'];
                    $UploaderId = $_POST['UploaderId'];
                    $IdeaCategoryId = $_POST['IdeaCategoryId'];
                    $Header = $_POST['Header'];
                    $Description = $_POST['Description'];
                    $Id = $_GET['Id'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, $Id, 'ImgPath');

                    if ($ImgName != null) {
                        //remove old image
                        unlinkFile($TableName, $Id, 'ImgPath');
                    }

                    $stmt = $connection->prepare("UPDATE $TableName 
                        SET SubjectId = ?,UploaderId = ?,IdeaCategoryId = ?,Header = ?,Description = ?,ImgPath = ?
                        WHERE Id = ?");
                    $stmt->bind_param("sssssss",  $SubjectId, $UploaderId, $IdeaCategoryId, $Header, $Description, $FilePath, $Id);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    header("Location: ../IdeasForum.php?Id=$IdeaCategoryId");
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getByDepartmentId':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT i.Id,i.Header,i.Description,i.ImgPath,u.Names,
                    (SELECT SUM(likes) from ideastats where IdeaId = i.Id) as Likes,
                    (SELECT SUM(Dislikes) from ideastats where IdeaId = i.Id) as Dislikes
                    from  ideas i
                    Left Join  ideastats iss on i.Id = iss.IdeaId
                    Inner Join users u on u.id = i.UploaderId 
                    INNER JOIN subjects s on s.id = i.SubjectId 
                    Where s.DepartmentId = $Id
                    group by i.Id 
                    ");

                    $stmt->execute();
                    $stmt->bind_result($Id, $Header, $Description, $ImgPath, $Names, $Likes, $Dislikes);
                    $results = array();
                    while ($stmt->fetch()) {
                        $temp = array();
                        $temp['Id'] = $Id;
                        $temp['Header'] = $Header;
                        $temp['Description'] = $Description;
                        $temp['Dislikes'] = $Dislikes;
                        $temp['Names'] = $Names;
                        $temp['Likes'] = $Likes;
                        $temp['ImgPath'] = GET_IMG . $ImgPath;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;

                case 'getAll':
                    $filter = $_GET['filter'];
                    $subjectId = $_GET['subjectId'];
                    $whereClause = "";

                    if ($filter == "Date") {
                        $whereClause = "ORDER BY i.id DESC";
                    } else if ($filter == "Likes") {
                        $whereClause = "ORDER BY Likes DESC";
                    } else if ($filter == "Disliked") {
                        $whereClause = "ORDER BY Dislikes DESC";
                    }

                    $stmt = $connection->prepare("SELECT i.Id,i.Header,i.Description,i.ImgPath,u.Names,
                    (SELECT SUM(likes) from ideastats where IdeaId = i.Id) as Likes,
                    (SELECT SUM(Dislikes) from ideastats where IdeaId = i.Id) as Dislikes
                    from  ideas i
                    Left Join  ideastats iss on i.Id = iss.IdeaId
                    Inner Join users u on u.id = i.UploaderId 
                    Where i.SubjectId = $subjectId
                    group by i.Id
                    $whereClause
                    ");

                    $stmt->execute();
                    $stmt->bind_result($Id, $Header, $Description, $ImgPath, $Names, $Likes, $Dislikes);
                    $results = array();
                    while ($stmt->fetch()) {
                        $temp = array();
                        $temp['Id'] = $Id;
                        $temp['Header'] = $Header;
                        $temp['Description'] = $Description;
                        $temp['Dislikes'] = $Dislikes;
                        $temp['Names'] = $Names;
                        $temp['Likes'] = $Likes;
                        $temp['ImgPath'] = GET_IMG . $ImgPath;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;

                case 'getAll2':

                    $stmt = $connection->prepare("SELECT i.Id,i.Header,i.Description,i.ImgPath,u.Names,
                        (SELECT SUM(likes) from ideastats where IdeaId = i.Id) as Likes,
                        (SELECT SUM(Dislikes) from ideastats where IdeaId = i.Id) as Dislikes
                        from  ideas i
                        Left Join  ideastats iss on i.Id = iss.IdeaId
                        Inner Join users u on u.id = i.UploaderId  
                        group by i.Id 
                        ");

                    $stmt->execute();
                    $stmt->bind_result($Id, $Header, $Description, $ImgPath, $Names, $Likes, $Dislikes);
                    $results = array();
                    while ($stmt->fetch()) {
                        $temp = array();
                        $temp['Id'] = $Id;
                        $temp['Header'] = $Header;
                        $temp['Description'] = $Description;
                        $temp['Dislikes'] = $Dislikes;
                        $temp['Names'] = $Names;
                        $temp['Likes'] = $Likes;
                        $temp['ImgPath'] = GET_IMG . $ImgPath;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    unlinkFile($TableName, $Id, 'ImgPath');
                    $stmt = $connection->prepare("DELETE from $TableName 
                        WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    break;
            }
            break;

        case 'stats':

            $src = $_GET['src'];

            switch ($src) {
                case 'cardStats':
                    $stmt = $connection->prepare("SELECT 
                    (Select COUNT(*) from users) as userCount,
                    (Select COUNT(*) from departments) as departmentCount,
                    (Select COUNT(*) from subjects) as subjectsCount,
                    (Select COUNT(*) from ideas) as ideasCount
                    ");

                    $stmt->execute();
                    $stmt->bind_result($userCount, $departmentCount, $subjectsCount, $ideasCount);
                    $results = array();
                    while ($stmt->fetch()) {
                        $temp = array();
                        $temp['userCount'] = $userCount;
                        $temp['departmentCount'] = $departmentCount;
                        $temp['subjectsCount'] = $subjectsCount;
                        $temp['ideasCount'] = $ideasCount;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;

                case 'subjectStats':
                    $stmt = $connection->prepare("SELECT COUNT(s.departmentId) as count,s.departmentId, d.title
                    FROM subjects s
                    INNER JOIN departments d on s.departmentId = d.Id
                    group by s.departmentId
                    ");

                    $stmt->execute();
                    $stmt->bind_result($Count, $departmentId, $title);
                    $results = array();
                    while ($stmt->fetch()) {
                        $temp = array();
                        $temp['Count'] = $Count;
                        $temp['title'] = $title;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;

                case 'ideaPercentages':
                    $stmt = $connection->prepare("SELECT (select COUNT(*) from ideas) as ideaCount, COUNT(i.id) as count, d.title
                        FROM ideas i
                        INNER JOIN subjects s on s.id = i.subjectId
                        INNER JOIN departments d on s.departmentId = d.Id
                        group by s.departmentId
                        ");

                    $stmt->execute();
                    $stmt->bind_result($IdeaCount, $Count, $title);
                    $results = array();
                    while ($stmt->fetch()) {
                        $percent = ($Count / $IdeaCount) * 100;
                        $temp = array();
                        $temp['percent'] = $percent;
                        $temp['title'] = $title;
                        array_push($results, $temp);
                    }
                    $response['error'] = false;
                    $response['results'] = $results;
                    Response($response);
                    break;
            }
            break;

        case 'sample':

            $src = $_GET['src'];
            $TableName = '';

            function GetData($stmt)
            {
                $Name = null;
                $ImgPath = null;
                $Description = null;
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $Name, $Description, $ImgPath);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['Name'] = $Name;
                    $temp['Description'] = $Description;
                    $temp['ImgPath'] = GET_IMG . $ImgPath;
                    array_push($results, $temp);
                }
                $response['error'] = false;
                $response['results'] = $results;

                Response($response);
            }

            switch ($src) {
                case "create":
                    $Name = $_POST['Name'];
                    $Description = $_POST['Description'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, 0, 'ImgPath');

                    $stmt = $connection->prepare("INSERT INTO $TableName (Name,Description,ImgPath)
                    VALUES (?,?,?)");
                    $stmt->bind_param("sss", $Name, $Description, $ImgName);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    break;

                case 'update':
                    $Name = $_POST['Name'];
                    $Description = $_POST['Description'];
                    $Id = $_GET['Id'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, $Id, 'ImgPath');

                    if ($ImgName != null) {
                        //remove old image
                        unlinkFile($TableName, $Id, 'ImgPath');
                    }

                    $stmt = $connection->prepare("UPDATE $TableName 
                    SET Name = ?,Description = ?,ImgPath = ?
                    WHERE Id = ?");
                    $stmt->bind_param("ssss", $Name, $Description, $ImgName, $Id);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
                    break;

                case 'get':
                    $Id = $_GET['Id'];
                    $stmt = $connection->prepare("SELECT * from $TableName
                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    GetData($stmt, $connection);
                    break;

                case 'getAll':
                    $stmt = $connection->prepare("SELECT * from $TableName
                    Order by Id DESC");
                    GetData($stmt, $connection);
                    break;

                case 'delete':
                    $Id = $_GET['Id'];
                    unlinkFile($TableName, $Id, 'ImgPath');
                    $stmt = $connection->prepare("DELETE from $TableName 
                    WHERE Id = ?");
                    $stmt->bind_param("s", $Id);
                    getResponse($stmt);
                    break;
            }
            break;
            //end

    }
} else {
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}
