<div class="front-bottom-wrapper">
    <div class="front-right-wrapper">
        <h1 style="margin-left:25px;">Les cinémas :</h1>
        <div id="caroussel--full--arrow_">
            <?php
            foreach($data['cinemas'] as $cinema): ?>
                <img class="front-fit-pic" src="../public/images/<?= $cinema->getImage_url() ?>">
            <?php endforeach;?>
        </div>
    </div>
</div>