<?php

include('security.php');

if(isset($_POST['login_btn']))
{
    
    $email_login = $_POST['emaill'];
    $password_login = $_POST['password'];

        $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login'";
        $query_run = mysqli_query($connection, $query);
        $usertype  =  mysqli_fetch_array($query_run);
    
    
    if($usertype['usertype'] == "admin")
    {
        $_SESSION['usertype'] = $userrole;
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    }
    
    else
    {
        $_SESSION['status'] = "Email/password is not valid";
        header('Location: login.php');

    }
}

?>