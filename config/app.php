<?php

include_once 'database.php';

$settings = $conn->query("SELECT * FROM settings where id = 1")->fetch_assoc();


if (count($settings)) {
    $app_name = $settings['app_name'];
    $admin_email = $settings['admin_email'];
} else {
    $app_name = "Service App";
    $admin_email = "d798asa@gmail.com";
};

$config = [

    "app_name" => $app_name,

    "admin_email" => $admin_email,

    "lang" => "en",

    "dir" => "ltr",

    "app_url" => "http://192.168.1.29/firstPhpCode/",

    "admin_assets" => "http://192.168.1.29/firstPhpCode/admin/template/assets/"
];
