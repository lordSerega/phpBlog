<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-deck">


<?php foreach ($this->posts as $key => $value) {
    $show_img = base64_encode($value['IMG']);
    ?>


                    <div class="card">
                        <img src="/img/<?=$value['postIMG']?>"  class="card-img-top" alt="sdfs">
                        <div class="card-body">
                            <h5 class="card-title"><?=$value['title']?></h5>
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





