<div class="container">
    <div class="row">
        <div class="col-xl-12 mt-5">
            <div class="card-deck">

    <?php foreach ($this->posts as $key => $value) {
    ?>
                    <div class="card">
                        <img src="/img/<?=$value['postIMG']?>"  class="card-img-top" alt="sdfs">
                        <div class="card-body">
                            <a href="/?post/<?=$value['id']?>"><h5><?=$value['title']?></h5></a>
                            <p class="card-text"><?=$value['preview']?></p>
                            <p class="card-text"><small class="text-muted"><?=$value['postDate']?></small></p>
                        </div>
                    </div>
    <?php
}?>
                </div>
            </div>
        </div>
    </div>





