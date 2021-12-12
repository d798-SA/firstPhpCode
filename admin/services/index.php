<?php
$title = "services";
include __DIR__ . '/../template/header.php';
$ServicesQu = $conn->query("SELECT * FROM services order by id")->fetch_all(MYSQLI_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deletequ = $conn->prepare('delete from services where id = ?');

    $deletequ->bind_param('i', $_POST['service_id']);

    $deletequ->execute();
    if ($deletequ->error) {
        array_push($errors, $deletequ->error);
    } else {
        echo "<script>location.href = 'index.php' </script>";
    };
}


?>

<div class="content">
    <div class="card">

        <a href="http://localhost/firstPhpCode/admin/services/create.php" class="btn btn-success"> create one</a>

        <p class="pt-3 pl-3">services : <?php echo count($ServicesQu); ?> </p>
        <div class="table-responsive">
            <table class="table table straiped">
                <thead>
                    <tr>
                        <th width="0">Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th width="250">Actiona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ServicesQu as $Service) : ?>
                        <tr>
                            <td><?php echo $Service['id'] ?></td>
                            <td> <?php echo $Service['name'] ?></td>
                            <td> <?php echo $Service['description'] ?></td>
                            <td> <?php echo $Service['price'] ?></td>
                            <td>
                                <a class="btn btn-warning mr-1" href="edit.php?id=<?php echo $Service['id'] ?>">Edit</a>

                                <form action="" method="post">
                                    <input type="hidden" name="service_id" value="<?php echo $Service['id'] ?>">
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
include __DIR__ . '/../template/footer.php';
