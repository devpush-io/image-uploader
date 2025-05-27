<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dbConnect.php';

$message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['file'])) {
    $filename = $_FILES['file']['name'];
    $filePath = '/images/' . $filename;

    // Store image locally
    move_uploaded_file(
        $_FILES['file']['tmp_name'],
        __DIR__ . $filePath
    );

    // Store the image filepath to the DB
    $sql = 'INSERT INTO images (filename, url) VALUES (?, ?)';
    $pdoStatement = $pdo->prepare($sql);

    $result = $pdoStatement->execute([$filename, $filePath]);

    if ($result) {
        $message = 'Image has been uploaded';
    } else {
        $message = 'Image could not be added';
    }
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Image Uploader</title>
        <!-- Centered viewport -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
    </head>
    <body>
        <header>
            <h1>Image Project</h1>
            <a href="index.php">Go Back</a>
        </header>
        <main>
            <div style="max-width: 300px; margin-top: 20px">
                <h3>Upload Image</h3>
                <?php
                if ($message) { ?>
                    <article class="pico-background-black-50 pico-color-white-50">
                        <div><?= $message ?></div>
                    </article>
                <?php
                } ?>
                <form
                    action="upload.php"
                    method="post"
                    enctype="multipart/form-data">
                    <div>
                        <input
                            type="file"
                            id="file"
                            name="file"
                            accept=".jpg, .jpeg, .png" />
                    </div>
                    <input type="submit" value="Upload" />
                </form>
            </div>
        </main>
    </body>
</html>