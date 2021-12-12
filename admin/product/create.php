<?php
$title = "create product";
include __DIR__ . '/../template/header.php';
require_once __DIR__ . '/../../classes/upload.php';
//products2

$errors = [];
$title = "";
$description = "";
$img = "";
$price = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);





    if (empty($title)) {
        array_push($errors, 'error in Name');
    };
    if (empty($description)) {
        array_push($errors, 'error in description');
    };
    if (empty($price)) {
        array_push($errors, 'error in price');
    };

    if (empty($_FILES['image']['name'])) {
        array_push($errors, "Image is required");
    }

    // make new user
    if (!count($errors)) {
        $date = date('Ym');
        $uploads = new Upload('uploads/mer/' . $date);
        $uploads->file = $_FILES['image'];
        $errors = $uploads->upload();
    }




    if (!count($errors)) {

        $query = "insert into products2 (title, description, price, image) values ('$title', '$description', '$price', '$uploads->filePath')";
        $conn->query($query);

        if ($conn->error) {
            array_push($errors, $conn->error);
        } else {
            echo "<script>location.href = 'index.php'</script>";
        }
    }
}



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
                <label for="image">image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <hr>
            <div class="form-groug">
                <button class="btn btn-success">CREATE NEW!</button>

            </div>



        </form>
    </div>
</div>



<?php
include __DIR__ . '/../template/footer.php';
