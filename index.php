<?php

require __DIR__ . '/dbConnect.php';

// Get all images from the DB
$sql = 'SELECT * FROM images';
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute();

$images = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); ?>
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
            <h1>Image Uploader</h1>
        </header>
        <main>
            <a href="/upload.php">Upload Image</a>
            <div>
                <?php
                foreach ($images as $image): ?>
                    <div style="margin-top: 40px">
                        <div><?= $image['filename'] ?></div>
                        <img src="<?= $image['url'] ?>" width="300" />
                    </div>
                <?php
                endforeach ?>
            </div>
        </main>
    </body>
</html>