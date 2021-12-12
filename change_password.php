<?php


$title = "Change password page";
require_once 'template\header.php';
require "config\app.php";
require_once "config\database.php";


if (isset($_SESSION['logged_in'])) {
    echo '<script> window.location.href = "index.php" ; </script>';
};

if (!isset($_GET['token']) || !$_GET['token']) {
    die('Error');
};

$now = date('Y-m-d H:i:s');

$stmt = $conn->prepare("SELECT * FROM password_resets where token = ? and expires_at > '$now'");
$stmt->bind_param('s', $token);
$token = $_GET['token'];
$stmt->execute();

$result = $stmt->get_result();

if (!$result->num_rows) {
    die('Error this Page don\'t found');
};

$errors = [];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password_confirm = mysqli_real_escape_string($conn, $_POST['password-confirm']);


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

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $userId = $result->fetch_assoc()['user_id'];

        $conn->query("update users set password = '$hashed_password' where id='$userId'");

        $conn->query("delete from password_resets where user_id='$userId'");

        $_SESSION['messges'] = "your password NOW chaned";


        echo '<script> window.location.href = "logein.php" ; </script>';
        die();
    };
};







?>
<div class="password-reset">

    <form method="post" action="">

        <h4 class="text-info">we here to help you come back to your WORLD</h4>

        <hr>

        <?php include 'template\errors.php'; ?>
        <div class="form-groug">
            <label for="password">Your new password</label>
            <input type="password" class="form-control" name="password" placeholder="Your password">

        </div>
        <hr>

        <div class="form-groug">
            <label for="password-confirm">Your new password confirmation</label>
            <input type="password" class="form-control" name="password-confirm" placeholder="Your password confirmation">

        </div>

        <hr>
        <div class="form-groug">
            <button class="btn btn-primary">->MAKE NEW PASSWORD!</button>
        </div>



    </form>

</div>

<?php
