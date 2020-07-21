<div class="front-bottom-wrapper">
    <div class="front-right-wrapper">
        <h1 style="margin-left:25px;">Films à l'affiche :</h1>
        <div id="caroussel--billboard_">
            <?php foreach($data['movies'] as $movie): ?>
                <img class="front-fit-pic" src="../public/images/<?= $movie->getImage_poster() ?>">
            <?php endforeach; ?>
        </div>
    </div>
</div>