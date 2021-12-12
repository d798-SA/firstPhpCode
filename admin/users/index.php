<?php
$title = "Users";
include __DIR__.'/../template/header.php';
$Users = $conn->query("SELECT * FROM users order by id")->fetch_all(MYSQLI_ASSOC);

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $deletequ = $conn->prepare('delete from users where id = ?');

    $deletequ->bind_param('i' , $_POST['user_id']);
    
    $deletequ->execute();
   if($deletequ->error){
    array_push($errors, $deletequ->error);
   }else{
    echo "<script>location.href = 'index.php' </script>";
   };
}


?>

<div class="content">
<div class="card">

<a href="http://localhost/php/admin/users/create.php" class="btn btn-success"> create one</a>
    
    <p class="pt-3 pl-3">Users : <?php echo count($Users); ?> </p>
    <div class="table-responsive">
        <table class="table table straiped">
            <thead>
                <tr>
                    <th width="0">Id</th>
                    <th>Email</th>
                    <th>username</th>
                    <th>Role</th>
                    <th width="250">Actiona</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Users as $user): ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td> <?php echo $user['email'] ?></td>
                    <td> <?php echo $user['usersname'] ?></td>
                    <td> <?php echo $user['role'] ?></td>
                    <td>
                        <a class="btn btn-warning mr-1" href="edit.php?id=<?php echo $user['id'] ?>">Edit</a>
                         
                            <form action="" method="post">
                            <input type="hidden" name="user_id" value ="<?php echo $user['id'] ?>">
                            <button type="submit" onclick="return confirm('Are you sure')" class="btn btn-danger">delete</button>
                        </form>
                       
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    
</script>

</div>

<?php
include __DIR__.'/../template/footer.php';