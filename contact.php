<?php
$title = "Contact Page";

?>

<?php require_once 'template\header.php';

require_once 'template\uploadar.php';

require "classes\Service.php";



$services = $conn->query("SELECT id , name , price FROM services order by name")->fetch_all(MYSQLI_ASSOC);

?>







<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="valueName">Name : </label>
        <input type="text" name="valueName" id="valueName" class="form-control" value="<?php echo $valueName ?>" placeholder="Your Name">
        <b class="text-danger"><?php echo $nameError; ?></b>
    </div>

    <div class="form-group">
        <label for="valueEmail">Email :</label>
        <input type="email" name="valueEmail" id="valueEmail" value="<?php echo $valueEmail ?>" class="form-control" placeholder="Your Email">
        <b class="text-danger"><?php echo $emailError ?></b>

    </div>

    <!-- //loop  -->

    <div class="form-group">
        <label for="Services">Services :</label>
        <select name="Services" id="Services" class="form-control">

            <option value="null">no select </option>

            <?php foreach ($services as $servicevalue) { ?>

                <option value="<?php echo $servicevalue['id'] ?>">

                    <?php echo $servicevalue["name"] ?>

                    ( <?php echo $servicevalue["price"] ?> ) RSA


                </option>

            <?php } ?>
        </select>

    </div>



    <div class="form-group">
        <label for="uploadFile">Document</label>
        <input type="file" name="uploadFile" id="uploadFile" class="btn btn-primary">
        <b class="text-danger"><?php echo $uploadFileError ?></b>


    </div>

    <div class="form-group">
        <label for="valuecomment">Your comment</label>
        <textarea name="valuecomment" id="valuecomment" cols="30" rows="10"> <?php echo $valuecomment ?></textarea>
        <b class="text-danger"><?php echo $commentError ?></b>>


    </div>

    <button class="btn btn-primary"> >... Send Info </button>
</form>
<br>
<br>
<br>
<a class="btn info11" href="<?php $uploadsDir ?> /"> show the upload</a>





<?php require_once 'template/footer.php' ?>