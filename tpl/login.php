<div class="container mt-5">
    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 p-5 card">
            <h1 class="text-center">Авторизация</h1>
            <?php if($this->error) {?>
                <div class="alert alert-danger" role="alert">
                    <?=@$this->error;?>
                </div>
            <?php }?>

            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Логин</label>
                    <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
                </div>



                <button type="submit" class="btn btn-primary">Войти</button>



            </form>
        </div>
        <div class="col-xl-3"></div>
    </div>
</div>