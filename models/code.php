<?php
error_reporting(E_ERROR | E_PARSE);
include('security.php');
//$connection = mysqli_connect("localhost","root", "", "admin");

//  if(isset($_POST['registerbtn']))

//  {

//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $cpassword = $_POST['confirmpassword'];

//     $usertypeupdate = $_POST['updateusertype'];
//     if($password === $cpassword)
//     {
//         $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username', '$email', '$password','$usertypeupdate')";
//         $query_run = mysqli_query($connection, $query);

//         if($query_run)
//         {
//             //echo "Saved";
//             $_SESSION['success'] = "Admin Profile Added";
//             header('Location: register.php');
//         }
//         else
//         {
//            // echo "Not Saved";
//             $_SESSION['status'] = "Admin Profile NOT Added";
//             header('Location: register.php');
//         }
//     }
//     else {
//         $_SESSION['status'] = "Password doesnt Match";
//         header('Location: register.php');
//     }
//  }

//  if(isset($_POST['edit_btn']))
//  {
//     $id = $_POST['edit_id'];


//     $query = "SELECT * FROM register where id='$id' ";
//     $query_run = mysqli_query($connection, $query);
//  }

//  if(isset($_POST['updatebtn']))
//  {
//     $id = $_POST['edit_id'];
//     $username = $_POST['edit_username'];
//     $email = $_POST['edit_email'];
//     $password = $_POST['edit_password'];
//     $usertypeupdate = $_POST['updateusertype'];
//     $query= "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' where id='$id' ";
//     $query_run = mysqli_query($connection, $query);

//     if($query_run)
//     {
//         $_SESSION['success'] = "Your data is updated";
//         header('Location: register.php');
//     }
//     else
//     {
//         $_SESSION['status'] = "Your data is NOT updated";
//         header('Location: register.php');
//     }

//  }

if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register where id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Yor Data is DELETED";
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Yor Data is NOT DELETED";
        header('Location: register.php');
    }
}

if (isset($_POST['uploadfilebtn'])) {
    error_reporting(E_ERROR | E_PARSE);

    $name = $_FILES['file']['name'];

    $tmp_name = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    if ($size > 500000) {
        $_SESSION['status'] = "File is too large";
        header('Location: public_folder.php');
    }
    $submitbutton = $_POST['submit'];

    $position = strpos($name, ".");

    $fileextension = substr($name, $position + 1);

    $fileextension = strtolower($fileextension);

    $Title = $_POST['Title'];

    $description = $_POST['Description'];

    $created_by = $_SESSION['username'];





    $path = 'Uploads';

    if (!empty($name)) {
        if (file_exists($name)) {
            $_SESSION['status'] = "Could not save";
        }
        // Check file size
        else if ($size > 1000000000) {
            $_SESSION['status'] = "File size is more than 1GB";
        }
        if (
            $fileextension != "jpg" && $fileextension != "png" && $fileextension != "jpeg"
            && $fileextension != "pdf" &&  $fileextension != "xlsx" &&  $fileextension != "docx"
        ) {
            $_SESSION['status'] = "Could not save";
        }
        if (move_uploaded_file($tmp_name, $path . $name)) {

            $query = "INSERT INTO files (title,description, filename, created_by)
                        VALUES ('$Title','$description', '$name' ,'$created_by')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] =  "Your FILE is added";
                header('Location: index.php');
            } else {
                $_SESSION['status'] = "Yor FILE is NOT Added";
                header('Location: index.php');
            }
        }
    }
}
if (isset($_POST['deletefile_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM files where id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Yor Data is DELETED";
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "Yor Data is NOT DELETED";
        header('Location: indx.php');
    }
}

if (isset($_POST['sharefile_btn'])) {

    $url = $_POST["url"];
    $short_code = substr(md5(uniqid(rand(), true)), 0, 3); // creates a 3 digit unique short id. You can maximize it but remember to change .htacess value as well

    $sql = "INSERT INTO url_shorten (url, short_code)
           VALUES ('$url', '$short_code')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {

       echo  "success";
    }
}
