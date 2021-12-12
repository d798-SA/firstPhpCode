<?php
$title = "settings";
include __DIR__ . '/../template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stm = $conn->prepare("update settings set app_name = ? , admin_email = ? where id = 1");

    $stm->bind_param('ss', $upapp_name, $upapp_email);
    $upapp_name = $_POST['app_name'];
    $upapp_email = $_POST['admin_email'];

    $stm->execute();
    echo "<script>location.href = 'index.php' </script>";
}

?>

<div class="card">
    <h3 class="card-title p-3">Update Settings</h3>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="app_name">Name app</label>
                <input type="text" name="app_name" value="<?php echo $config['app_name']; ?>" class="form-control">
            </div>
            <hr>
            <div class="form-group">
                <label for="admin_email"> Email app</label>
                <input type="text" name="admin_email" value="<?php echo $config['admin_email']; ?>" class="form-control">
            </div>

            <hr>

            <div class="form-group">
                <input type="submit" class="form-control btn btn-success" value="Update Settings">

            </div>
        </form>
    </div>
</div>





<?php
include __DIR__ . '/../template/footer.php';
