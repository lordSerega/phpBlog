<div class="container mt-5">
    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 p-5 card">
            <h1 class="text-center">Добавление нового поста</h1>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input type="text" class="form-control" name="title" value="<?=@$this->admin['title']?>">
                </div>
                <div class="form-group">
                    <label>Дата</label>
                    <input type="date" class="form-control" id="date" name="postDate" placeholder="Дата" value="<?=@$this->admin['postDate']?>" required>
                </div>
                <div class="form-group">
                    <label>Анонс</label>
                    <input type="text" class="form-control" name="preview" value="<?=@$this->admin['preview']?>">
                </div>
                <div class="form-group">
                    <label>Полный текст</label>
                    <textarea type="text" class="form-control" name="full"><?=@$this->admin['full']?></textarea>
                </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label ">Фотография (до 1 мб)</label>
                        <div class="col-sm-10">
                            <input type="file" class="" name="image">

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
        <div class="col-xl-3"></div>
    </div>
</div>