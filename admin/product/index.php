<?php
$title = "product";
include __DIR__ . '/../template/header.php';
$productsQu = $conn->query("SELECT * FROM products2 order by id")->fetch_all(MYSQLI_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deletequ = $conn->prepare('delete from products2 where id = ?');

    $deletequ->bind_param('i', $_POST['product_id']);

    $deletequ->execute();

    if ($_POST['product_image']) {

        unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '/firstPhpCode/' . $_POST['product_image']);
    }
    if ($deletequ->error) {
        array_push($errors, $deletequ->error);
    } else {
        echo "<script>location.href = 'index.php' </script>";
    };
}


?>

<div class="content">
    <div class="card">

        <a href="http://localhost/firstPhpCode/admin/product/create.php" class="btn btn-success"> create one</a>

        <p class="pt-3 pl-3">products : <?php echo count($productsQu); ?> </p>
        <div class="table-responsive">
            <table class="table table straiped">
                <thead>
                    <tr>
                        <th width="0">Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>img</th>
                        <th>Price</th>
                        <th width="250">Actiona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productsQu as $product) : ?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td> <?php echo $product['title'] ?></td>
                            <td> <?php echo $product['description'] ?></td>
                            <td> <img class="img-responsive img-fluid" src="<?php echo $config['app_url'] . $product['image'] ?>" width="100"></td>
                            <td> <?php echo $product['price'] ?></td>
                            <td>
                                <a class="btn btn-warning mr-1" href="edit.php?id=<?php echo $product['id'] ?>">Edit</a>

                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $product['image'] ?>">
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
