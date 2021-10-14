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
                case "create":
                    $Names = $_POST['Names'];
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];
                    $PhoneNumber = $_POST['PhoneNumber'];
                    $RoleId = $_POST['RoleId'];

                    $stmt = $connection->prepare("INSERT INTO $TableName (Names,Email,Password,PhoneNumber,RoleId)
                                VALUES (?,?,?,?,?)");
                    $stmt->bind_param("sssss", $Names, $Email, $Password, $PhoneNumber, $RoleId);
                    getResponse($stmt);
                    header("Location: ../users.php");
                    break;

                case 'update':
                    $Names = $_POST['Names'];
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];
                    $PhoneNumber = $_POST['PhoneNumber'];
                    $RoleId = $_POST['RoleId'];
                    $Id = $_GET['Id'];

                    $stmt = $connection->prepare("UPDATE $TableName 
                                SET Names = ?,Email = ?,Password = ?,PhoneNumber = ?,RoleId = ?
                                WHERE Id = ?");
                    $stmt->bind_param("ssssss", $Names, $Email, $Password, $PhoneNumber, $RoleId, $Id);
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
                $Id = null;

                $stmt->execute();
                $stmt->bind_result($Id, $IdeaId, $Likes, $Dislikes);
                $results = array();
                while ($stmt->fetch()) {
                    $temp = array();
                    $temp['Id'] = $Id;
                    $temp['IdeaId'] = $IdeaId;
                    $temp['Likes'] = $Likes;
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

                    $stmt = $connection->prepare("INSERT INTO $TableName (IdeaId,Likes,Dislikes)
                                    VALUES (?,?,?)");
                    $stmt->bind_param("sss", $IdeaId, $Likes, $Dislikes);
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
                    $SubjectId = $_POST['SubjectId'];
                    $UploaderId = $_POST['UploaderId'];
                    $IdeaCategoryId = $_POST['IdeaCategoryId'];
                    $Header = $_POST['Header'];
                    $Description = $_POST['Description'];

                    //uploading image 
                    $ImgName =  getFileName($TableName, 0, 'ImgPath');

                    $stmt = $connection->prepare("INSERT INTO $TableName (Name,Description,Name,Description,Name,FilePath)
                        VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ssssss",  $SubjectId, $UploaderId, $IdeaCategoryId, $Header, $Description, $FilePath);
                    if (getResponse($stmt)) {
                        if ($ImgName != null) {
                            uploadFile($ImgName, 'ImgPath');
                        }
                    };
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
