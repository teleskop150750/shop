<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ошибка</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">
<!--    <link type="text/css" rel="stylesheet" href="/errors/style.css"/>-->

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h2>Произошла ошибка</h2>
            <p><b>Код ошибки:</b> <?= $errno ?></p>
            <p><b>Текст ошибки:</b> <?= $errstr ?></p>
            <p><b>Файл, в котором произошла ошибка:</b> <?= $errfile ?></p>
            <p><b>Строка, в которой произошла ошибка:</b> <?= $errline ?></p>
        </div>

        <a href="<?= PATH ?>">Homepage</a>
    </div>
</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>