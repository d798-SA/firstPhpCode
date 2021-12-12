<?php
$title = "create Services";
include __DIR__ . '/../template/header.php';


$errors = [];
$name = "";
$description = "";
$price = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);





    if (empty($name)) {
        array_push($errors, 'error in Name');
    };
    if (empty($description)) {
        array_push($errors, 'error in description');
    };
    if (empty($price)) {
        array_push($errors, 'error in price');
    };




    if (!count($errors)) {




        $conn->query("INSERT INTO services (name , description , price) VALUES('$name' , '$description' , '$price')");

        if ($conn->error) {
            array_push($errors, $conn->error);
        } else {
            echo "<script>location.href = 'index.php' </script>";
        };
    };
};



?>





<div class="card">
    <div class="content pt-3 pl-3">
        <?php include __DIR__ . '/../template/errors.php'; ?>
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
                <button class="btn btn-success">CREATE NEW!</button>

            </div>



        </form>
    </div>
</div>



<?php
include __DIR__ . '/../template/footer.php';
