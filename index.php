<?php

$title = "Home Page";
require_once 'template\header.php';
require "config\app.php";
require_once "config\database.php";



?>



<h1>Welcome to our website</h1>

<h2>
    <?php
    echo " this role is " . $_SESSION['role'];
    ?>
</h2>



<?php $products2 = $conn->query("select * from products2 ")->fetch_all(MYSQLI_ASSOC); ?>

<div class="row">


    <?php foreach ($products2 as $valueProduct) { ?>
        <div class="col-md-4 amnt1">
            <div class="card mb-3">

                <div class="custom-card-image" style=" background-image: url(<?php echo $valueProduct['image'] ?>)"></div>
                <div class="card-body text-center">



                    <h5 class="card-title"> <?php echo $valueProduct["title"] ?></h5>


                    <div> <?php echo $valueProduct['description'] ?></div>

                    <div class="text-success"> <?php echo $valueProduct["price"] ?> RSA</div>
                </div>
            </div>

        </div>

        <hr>



    <?php } ?>


</div>





<?php require_once 'template/footer.php' ?>