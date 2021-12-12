<?php

if(isset($_SESSION['messges'])){ ?>

    <h3 class="alert alert-success" ><?php echo $_SESSION['messges'] ?></h3>

    <?php 
   
   unset($_SESSION['messges']);
};
    