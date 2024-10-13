<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $fileWritePt = fopen("data.txt", "a");
    $content = "\n Perform file operations using PHP";
    fwrite($fileWritePt, $content);
    fclose($fileWritePt);

    $filePt = fopen("data.txt", "r");

    echo "File Content:<br/>";
    while (!feof($filePt)) {
        echo fgets($filePt) . "<br/>";
    }
    fclose($filePt);
    ?>
</body>

</html>