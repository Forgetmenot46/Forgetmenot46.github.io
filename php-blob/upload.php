<?php 

    session_start();
    require "config.php";


    if (isset($_FILES["image"]) &&  $_FILES["image"]["error"] == 0) {

        $image = $_FILES["image"]["tmp_name"];
        $imgContent = file_get_contents($image);

        $stmt = $conn->prepare("INSERT INTO images(image) VALUES(?)");
        $stmt->execute([$imgContent]);

        if($stmt){
            $_SESSION["success"] = "Image Upload Successfully.";
            header("Location: index.php");
        }else {
            $_SESSION["error"] = "Failed to upload image . Plase try again.";
            header("Location: index.php");
        }
    }else {
        $_SESSION["error"] = "Plase select an image file to upload.";
        header("Location: index.php");
    }

?>