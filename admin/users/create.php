<?php
$title = "create users";
include __DIR__.'/../template/header.php';


$errors = [];
$email = "";
$role = "";

$username = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    $email = mysqli_real_escape_string($conn , $_POST['email']);

    $username = mysqli_real_escape_string($conn , $_POST['username']);

    $password = mysqli_real_escape_string($conn , $_POST['password']);

    $role = mysqli_real_escape_string($conn , $_POST['role']);

    


    if(empty($email)){array_push($errors , 'error in Eamil');};
    if(empty($username)){array_push($errors , 'error in username');};
    if(empty($password)){array_push($errors , 'error in password');};
    if(empty($role)){array_push($role , 'error in role');};
    
 

    // if(!count($errors)){
    //     $userExists = $conn->query("SELECT id , email from users where email = '$email' limit 1");

    //     if($userExists->num_rows){
    //         array_push($errors , 'You Already have from to our world (:');
    //     };



    // };

        // make new user

        if(!count($errors)){
            $password = password_hash($password , PASSWORD_DEFAULT);

            

            $conn->query("INSERT INTO users (email , usersname , password , role) VALUES('$email' , '$username' , '$password' , '$role')");

            if($conn->error){
                array_push($errors , $conn->error);
            }else{
                echo "<script>location.href = 'index.php' </script>";
            };
           

        };

};



?>







<div class="card">
    <div class="content pt-3 pl-3">
        <?php include __DIR__.'/../template/errors.php'; ?>
    <form method="post" action="">

<h4>Welcome to your new world!</h4>
<h3 class="text-info" >Make you info so real!</h3>
<hr>

<?php //include 'template\errors.php'; ?>
<div class="form-groug">
    <label for="email">Your email</label>
    <input type="email" class="form-control" name="email" placeholder="Your email">

</div>

<div class="form-groug">
    <label for="username">Your username</label>
    <input type="text" class="form-control" name="username"  placeholder="Your username">

</div>

<div class="form-groug">
    <label for="password">Your password</label>
    <input type="password" class="form-control" name="password" placeholder="Your password" id="password">

</div>


<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control">
        <option value="user"
        
        <?php if($role == 'user') echo 'selected' ?>
        >User</option>
        <option value="admin"
        <?php if($role == 'admin') echo 'selected' ?>
        >Admin</option>
    </select>
</div>





<hr>
<div class="form-groug">
<button class="btn btn-success">CREATE NEW!</button>

</div>



</form>
    </div>
</div>



<?php
include __DIR__.'/../template/footer.php';

