<?php
$title = "Edit Services";
include __DIR__ . '/../template/header.php';
if (!isset($_GET['id']) || !$_GET['id']) {
    die('mising id');
};

$stm = $conn->prepare('SELECT * FROM services WHERE id=? limit 1');

$stm->bind_param('i', $servicesid);

$servicesid = $_GET['id'];
$stm->execute();

$service = $stm->get_result()->fetch_assoc();

$name = $service['name'];
$description = $service['description'];
$price = $service['price'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        array_push($errors, 'error in name');
    };
    if (empty($_POST['description'])) {
        array_push($errors, 'error in description');
    };
    if (empty($_POST['price'])) {
        array_push($errors, 'error in price');
    };

    if (!count($errors)) {
        $editQ = $conn->prepare('update services set name = ? , description = ? , price = ? where id = ?');

        $editQ->bind_param('ssdi', $upname, $updescription, $upprice, $upid);

        $upname = $_POST['name'];
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

        <form method="post" action="">

            <h4>Welcome to your new world!</h4>
            <h3 class="text-info">Make your info so real!</h3>
            <hr>



            <div class="form-groug">
                <label for="name">name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>">

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


            <hr>
            <div class="form-groug">
                <button class="btn btn-success">Update</button>

            </div>



        </form>
    </div>
</div>


<?php



include __DIR__ . '/../template/footer.php';
