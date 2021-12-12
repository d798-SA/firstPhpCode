<?php


$title = "Register page";
require_once 'template\header.php';
require "config\app.php";
require_once "config\database.php";


if (isset($_SESSION['logged_in'])) {
    header('location: index.php');
};

$errors = [];
$email = "";

$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password_confirm = mysqli_real_escape_string($conn, $_POST['password-confirm']);


    if (empty($email)) {
        array_push($errors, 'error in Eamil');
    };
    if (empty($username)) {
        array_push($errors, 'error in username');
    };
    if (empty($password)) {
        array_push($errors, 'error in password');
    };
    if (empty($password_confirm)) {
        array_push($errors, 'error in password confirm');
    };

    if ($password != $password_confirm) {
        array_push($errors, ' password not same');
    };


    if (!count($errors)) {
        $userExists = $conn->query("SELECT id , email from users where email = '$email' limit 1");

        if ($userExists->num_rows) {
            array_push($errors, 'You Already have from to our world (:');
        };
    };

    // make new user

    if (!count($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);



        $conn->query("INSERT INTO users (email , usersname , password) VALUES('$email' , '$username' , '$password')");


        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = $username;

        $_SESSION['messges'] = " Welcome to our world $username back!";

        $_SESSION['user_id'] = $conn->insert_id;
    };
};



?>
<div class="register-form">

    <form method="post" action="">

        <h4>Welcome to your new world!</h4>
        <h3 class="text-info">Make you info so real!</h3>
        <hr>

        <?php include 'template\errors.php'; ?>
        <div class="form-groug">
            <label for="email">Your email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Your email">

        </div>

        <div class="form-groug">
            <label for="username">Your username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="Your username">

        </div>



        <div class="form-groug">
            <label for="password">Your password</label>
            <input type="password" class="form-control" name="password" placeholder="Your password" id="password">

        </div>

        <div class="form-groug">
            <label for="password-confirm">Your password confirm</label>
            <input type="password" class="form-control" name="password-confirm" placeholder="Your password confirm" id="password-confirm">

        </div>
        <hr>
        <div class="form-groug">
            <button class="btn btn-success">CREATE NEW!</button>
            <hr>
            <a href="logein.php">have an account</a>
        </div>



    </form>

</div>

<?php
