<?php

    session_start();
    require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>MY PICTRUE</title>
    <style>
        .hover-pointer {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <h1>Upload blob image to databease</h1>
        <?php if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
                ?>
            </div>
        <?php } ?>
        <hr>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="upload"> Upload Image</label>
            <input type="file" class="form-control" name="image">
            <br>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
        <hr>
        <h3>Uploaded images</h3>
        <?php
        $result = $conn->query("SELECT * FROM images");
        $result->execute();
        $imgData = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($imgData) {
            echo "<div class='row'>";
            
            foreach ($imgData as $img) {
                echo "<div class='col-md-3 col-sm-6 col-xs-12'>";
                echo '<img class="img-fluid rounded float-start hover-pointer" src="data:image/jpeg;base64,' . base64_encode($img['image']) . '" alt="Uploaded image" style="width: 100%" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(\'' . base64_encode($img['image']) . '\')"/>';
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No Image uploaded yet.";
        }
        ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImage(imageData) {
            document.getElementById('modalImage').src = 'data:image/jpeg;base64,' + imageData;
        }
    </script>

</body>

</html>
