<?php

$connection = [
    "servername" => "localhost",

    "username" => "root",

    "password" => "",

    "datastore" => "storeApp"

];

// Create connection
$conn = new mysqli(
    $connection["servername"],
    $connection["username"],
    $connection["password"],
    $connection["datastore"]
);

// Check connection
if ($conn->connect_error) {
    die("there was an error connecting to database" . $conn->connect_error);
};
