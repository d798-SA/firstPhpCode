<?php


$title = "Reset password page";
require_once 'template\header.php';
require "config\app.php";
require_once "config\database.php";


if (isset($_SESSION['logged_in'])) {

    echo '<script> window.location.href = "index.php" ; </script>';

    die();
};

$errors = [];


$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);






    if (empty($email)) {
        array_push($errors, 'error in Eamil');
    };



    if (!count($errors)) {
        $userExists = $conn->query("SELECT id , email  from users where email = '$email' limit 1");

        if ($userExists->num_rows) {

            $userExists = $userExists->fetch_assoc();

            $tokenExists = $conn->query("delete from password_resets where user_id='$userExists[id]'");

            $token = bin2hex(random_bytes(15));
            $tess = strtotime('now');

            $expires_at = date("Y-m-d H:i:s", strtotime('+1 day'));

            $conn->query("INSERT INTO password_resets (user_id  , token , expires_at)
         values('$userExists[id]' , '$token' , '$expires_at')
         ");

            $changePasswordUrl = $config['app_url'] . 'change_password.php?token=' . $token;

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'content-type: tex/html; charset=UFT-8' . "\r\n";
            $headers .= 'From: ' . $config['admin_email'] . "\r\n" .
                'Reply-to: ' . $config['admin_email'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $messagEm = '<html><body>';
            $messagEm .= '<p> style="color:#ff0000;" > <a>' . $changePasswordUrl . '</a></p>';

            $messagEm .= '</body></html>';



            mail($email, 'password reset link ready Now!', $messagEm, $headers);






            $_SESSION['messges'] = "check your email $email";

            echo '<script> window.location.href = "password_reset.php" ; </script>';
        } else {
            array_push($errors, 'Your email ' . $email . ' not exist');
            $_SESSION['messges'] = "you have not account here";

            echo '<script> window.location.href = "password_reset.php" ; </script>';
        };
    };
};



?>
<div class="password-reset">

    <form method="post" action="">

        <h4>Don't Be sad ;(</h4>
        <h3 class="text-info">We will get you back</h3>
        <hr>

        <?php include 'template\errors.php'; ?>
        <div class="form-groug">
            <label for="email">Your email</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email = $email : $email = "" ?>" placeholder="Your email">

        </div>

        <hr>
        <div class="form-groug">
            <button class="btn btn-primary">->Reset your password!</button>
        </div>



    </form>

</div>

<?php
