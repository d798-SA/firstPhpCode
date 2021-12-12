<?php


$title = "Loge In page";
require_once 'template\header.php';
require "config\app.php";
require_once "config\database.php";


if (isset($_SESSION['logged_in'])) {

    echo '<script> window.location.href = "index.php" ; </script>';

    die();
};

$errors = [];
$email = "";
$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);



    $password = mysqli_real_escape_string($conn, $_POST['password']);



    if (empty($email)) {
        array_push($errors, 'error in Eamil');
    };
    if (empty($password)) {
        array_push($errors, 'error in password');
    };


    //usersname
    if (!count($errors)) {
        $userExists = $conn->query("SELECT id , email , password , username , role from users where email = '$email' limit 1");

        if (!$userExists->num_rows) {
            array_push($errors, 'You email ' . $email . ' not exist');
        } else {
            $userfound = $userExists->fetch_assoc();

            if (password_verify($password, $userfound['password'])) {

                // logein

                $_SESSION['logged_in'] = true;

                $_SESSION['user_id'] = $userfound['id'];

                $_SESSION['role'] = $userfound['role'];


                $_SESSION['user_name'] = $userfound['username'];

                if ($_SESSION['role'] == 'admin') {
                    echo '<script> window.location.href = "admin" ; </script>';
                } else {
                    $_SESSION['messges'] =  "Welcome to our world $userfound[username] back!";
                    echo '<script> window.location.href = "index.php" ; </script>';
                    die();
                };;
            } else {
                array_push($errors, 'Your password is wrong');
            };
        };
    };
};



?>
<div class="logein-form">

    <form method="post" action="">

        <h4>Hello there</h4>
        <h3 class="text-info">Seems not we onley who miss you</h3>
        <hr>

        <?php include 'template\errors.php'; ?>
        <div class="form-groug">
            <label for="email">Your email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Your email">

        </div>


        <hr>
        <div class="form-groug">
            <label for="password">Your password</label>
            <input type="password" class="form-control" name="password" placeholder="Your password" id="password">

        </div>
        <hr>
        <div class="form-groug">
            <button class="btn btn-success">->Come Back</button>
            <hr>
            <a href="password_reset.php">forget your password</a>
        </div>



    </form>

</div>

<?php
