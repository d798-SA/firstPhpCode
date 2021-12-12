<?php
$title = "Edit product";
include __DIR__ . '/../template/header.php';
require_once __DIR__ . '/../../classes/upload.php';

if (!isset($_GET['id']) || !$_GET['id']) {
    die('mising id');
};


$stm = $conn->prepare('SELECT * FROM products2 WHERE id=? limit 1');

$stm->bind_param('i', $productid);

$productid = $_GET['id'];
$stm->execute();

$produc = $stm->get_result()->fetch_assoc();

$name = $produc['title'];
$description = $produc['description'];
$price = $produc['price'];
$img = $produc['image'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['title'])) {
        array_push($errors, 'error in title');
    };
    if (empty($_POST['description'])) {
        array_push($errors, 'error in description');
    };
    if (empty($_POST['price'])) {
        array_push($errors, 'error in price');
    };

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload = new Upload('uploads/Edit2');
        $upload->file = $_FILES['image'];
        $errors = $upload->upload();

        if (!count($errors)) {

            unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '/php/' . $img);
            $img = $upload->filePath;
        };
    };
    if (!count($errors)) {
        $editQ = $conn->prepare('update products2 set title = ? , description = ? , image = ?, price = ? where id = ?');

        $editQ->bind_param('sssdi', $uptitle, $updescription, $img, $upprice, $upid);

        $uptitle = $_POST['title'];
        $updescription = $_POST['description'];
        $upprice = $_POST['price'];
        $upid = $_GET['id'];


        $editQ->execute();

        if ($editQ->error) {
            array_push($errors, $editQ->error);
        } else {
            echo "<script>location.href = 'index.php' </script>";
        };
    };
};


?>


<div class="card">
    <div class="content pt-3 pl-3">
        <?php include __DIR__ . '/../template/errors.php'; ?>
        <form method="post" action="" enctype="multipart/form-data">

            <h4>Welcome to your new world!</h4>
            <h3 class="text-info">Make your info so real!</h3>
            <hr>



            <div class="form-groug">
                <label for="title">title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $title ?>">

            </div>

            <hr>

            <div class="form-groug">
                <label for="description">description</label>
                <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description ?></textarea>
            </div>

            <hr>

            <div class="form-groug">
                <label for="price">price</label>
                <input type="number" class="form-control" value="<?php echo $price ?>" name="price">

            </div>
            <hr>

            <div class="form-group">
                <img src="<?php echo $config["app_url"] . $img ?>" width="150" alt="">
                <label for="image">image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <hr>
            <div class="form-groug">
                <button class="btn btn-success">Edit NEW!</button>

            </div>



        </form>
    </div>
</div>



<?php



include __DIR__ . '/../template/footer.php';
