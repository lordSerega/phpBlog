<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Установка</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"></head>

</head>
<body>

<?php
//Если файл конфигураций пресуцтвует то просим его удалить :D
$filename = 'lib/conf.php';/* Папка/Файл.php */
if (file_exists($filename)) {
    print "<div class='continer'><div class='row'><div class='col-xl-12 text-center'><h2>Ошибка</h2><h5>Для того что бы продолжить установку удалите $filename и <a href=install.php >обновите</a> страницу.</h5></div></div></div>";
} else {}
?>

<div class="container mt-5">

    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6  p-5">
            <h1 class="text-center">Установка</h1>
            <?php
            if(!$_GET['go']) {
            ?>
            <form method="post" action="install.php?go=true">
                <div class="form-group">
                    <label>Хост</label>
                    <input type="text" class="form-control" name="host" value="localhost">
                </div>
                <div class="form-group">
                    <label>Имя пользователя</label>
                    <input type="text" class="form-control"  name="log" value="root" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="pass" ">
                </div>
                <div class="form-group">
                    <label>Название БД</label>
                    <input type="text" class="form-control" name="db" ">
                </div>

                <button type="submit" class="btn btn-block btn-dark">Установить</button>
            </form>
        </div>

        <div class="col-xl-3"></div>
    </div>
</div>

    <?php
    }else {
    ?>

        <div class="container">
            <div class="row">
                <div class="col-xl-3"></div>
                <?php
                    echo 'Файл conf.php ';
                    $fp = fopen ("lib/conf.php","w");  //Желательно не менять , но если заменили то ниже там где заполнение бд укажите путь к конфигу
                    flock($fp,LOCK_EX);
                    fputs($fp,"<?php\n\r");
                    fputs($fp," \$this->mysqli = new mysqli('".$_POST['host']."','".$_POST['log']."','".$_POST['pass']."','".$_POST['db']."');\n\r");
                    flock($fp,LOCK_UN);
                    fclose($fp);
                    echo 'создан';

                    $blogHost = $_POST['host'];
                    $blogLogin = $_POST['log'];
                    $blogPass = $_POST['pass'];
                    $blogDB = $_POST['db'];
                try {


                    $link = new PDO("mysql:host=$blogHost", $blogLogin, $blogPass);
                    $link->exec("CREATE DATABASE `$blogDB`")
                     or die(print_r("База данных $blogDB уже существует.", true));


                    $sql ="CREATE TABLE `$blogDB`.`admin`( 
                            `id` INT NOT NULL AUTO_INCREMENT ,
                            `login` VARCHAR(100) NOT NULL ,
                            `pass` VARCHAR(100) NOT NULL ,
                            `cookie`  VARCHAR(100)  NULL,
                
                            PRIMARY KEY (`id`)) ENGINE = InnoDB;";

                    $link->exec($sql);


                    $sql_admin_insert = "INSERT INTO `$blogDB`.`admin` (`login`, `pass`) 
                                    VALUES ('admin', '272f70ade892de33a03ab51296ec1a73');";
                    $link->exec($sql_admin_insert);


                    $sql ="CREATE TABLE `$blogDB`.`post`( 
                            `id` INT NOT NULL AUTO_INCREMENT ,
                            `title` VARCHAR(50) NOT NULL ,
                            `textFull` TEXT NOT NULL ,
                            `postDate`  DATE NOT NULL ,
                            `preview`  VARCHAR(100) NOT NULL ,
                            `postIMG` VARCHAR(100) NULL ,
                            PRIMARY KEY (`id`)) ENGINE = InnoDB;";

                    $link->exec($sql);

                    echo "       <a href=\"/\"><h1 class=\"text-center\">На главную</h1></a>";


                } catch (PDOException $e) {
                    die("Ошибка: ". $e->getMessage());
                }

                ?>

                <div class="col-xl-3"></div>
            </div>
        </div>

    <?php
    }
    ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>