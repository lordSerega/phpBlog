<?php

class ctrlIndex extends ctrl {
    function index() {

        $page = 1; // текущая страница
        $kol = 3;  //количество записей для вывода
        $art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить

        $this->posts = $this->db->query("SELECT * FROM post ORDER BY postDate DESC LIMIT $art, $kol")->all();

        $this->navigation = $this->db->query("SELECT COUNT(*) FROM post")->assoc();

        $total = $this->navigation[0];

        $str_pag = ceil($total / $kol);



        $this->out('posts.php');
    }
    function login() {

        if (!empty($_POST)) {
            $user = $this->db->query("SELECT * FROM admin WHERE login = ? AND pass = ?",$_POST['login'],md5($_POST['pass']))->assoc();
            if ($user) {
                $key = md5(microtime().rand(0,10000));
                setcookie('uid', $user['id'], time()+86400*30, '/');
                setcookie('key', md5($key), time()+86400*30, '/');
                $this->db->query("UPDATE admin SET cookie = ? WHERE id = ?",$key,$user['id']);
                header("Location: /");
            } else
                $this->error = 'Неправильный емейл или пароль';
        }
        $this->out('login.php');
    }

    function admin() {

        if (!$this->user) return header("Location: /");

        if (!empty($_POST)) {

            $image = $_FILES['image']['name'];

            $target = "img/".basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

                [$imageWidth, $imageHeight] = getimagesize($target);

                if ($imageWidth <= 300 && $imageHeight <= 300) {
                    $this->db->query("INSERT INTO post (title,postDate,preview,textFull,postIMG) VALUES(?,?,?,?,?)", $_POST['title'], $_POST['postDate'], $_POST['preview'], $_POST['full'],$image);

                    header("Location: /");

                } else {

                    echo "Файл больше";



                }

            }
        }
        $this->out('admin.php');

    }

    function post($id){
        $this->post = $this->db->query("SELECT * FROM post WHERE id = ?", $id)->assoc();
        $this->out('post.php');
    }
}