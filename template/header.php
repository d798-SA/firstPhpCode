<?php require_once __DIR__ . '/../config/app.php';
session_start();


?>


<!DOCTYPE html>
<html dir="<?php echo $config["dir"] ?>" lang="<?php echo $config["lang"] ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="template\style.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <style>
    .custom-card-image {
      height: 200px;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;

    }
  </style>
  <style>
    .info11 {
      color: #fff;
      background-color: var(--purple);
      border-color: var(--purple);
    }
  </style>
  <title><?php echo $config["app_name"] . " | " . $title ?></title>
</head>

<body>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo $config['app_url'] ?>"><?php echo $config["app_name"] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>messages.php">Messages</a> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>contact.php">contact</a>
          </li>


        </ul>

        <ul class="navbar-nav ml-auto">

          <?php if (!isset($_SESSION['logged_in'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $config['app_url'] ?>logein.php">Logein</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo $config['app_url'] ?>register.php">new here?</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $_SESSION['user_name'] ?></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="logeout.php">>LogeOut</a>
            </li>

          <?php } ?>
        </ul>
      </div>
    </nav>



    <div class="container pt-5">

      <?php include "template\messge.php" ?>