<?php
$title = "Users";
include __DIR__.'/../template/header.php';
if(!isset($_GET['id']) || !$_GET['id']){
    die('mising id');
};

$stm = $conn->prepare('SELECT * FROM users WHERE id=? limit 1');

$stm->bind_param('i' , $userid);

$userid = $_GET['id'];
$stm->execute();

$user = $stm->get_result()->fetch_assoc();

$email = $user['email'];
$role = $user['role'];
$username = $user['usersname'];

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['email'])){array_push($errors , 'error in Eamil');};
    if(empty($_POST['usersname'])){array_push($errors , 'error in username');};
    if(empty($_POST['role'])){array_push($errors , 'error in role');};
   
    if(!count($errors)){
        $editQ = $conn->prepare('update users set email = ? , usersname = ? , role = ? , password = ?  where id = ?');

        $editQ->bind_param('ssssi' , $upemail , $upusersname , $dprole , $dppassword , $upid);

        $upemail = $_POST['email'];
        $upusersname = $_POST['usersname'];
        $dprole = $_POST['role'];
        $_POST['password'] ? $dppassword = password_hash($_POST['password'] , PASSWORD_DEFAULT) : $dppassword = $user['password'];
        $upid = $_GET['id'];

        $editQ->execute();

        if($editQ->error){
            array_push($errors , $editQ->error);
        }else{
            echo "<script>location.href = 'index.php' </script>";
        };

    };
};


?>


<div class="card">
    <div class="content pt-3 pl-3">
        <?php //include __DIR__.'/../template/errors.php'; ?>
    <form method="post" action="">

<h4>Welcome to your new world!</h4>
<h3 class="text-info" >Make you info so real!</h3>
<hr>

<?php //include 'template\errors.php'; ?>
<div class="form-groug">
    <label for="email">Your email</label>
    <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Your email">

</div>

<div class="form-groug">
    <label for="usersname">Your username</label>
    <input type="text" class="form-control" name="usersname" value="<?php echo $username ?>" placeholder="Your username">

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
<button class="btn btn-success">Update!</button>

</div>



</form>
    </div>
</div>


<?php



include __DIR__.'/../template/footer.php';