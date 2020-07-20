<div class="template-main-content">
    <h1 style="margin-left:25px;">Les cinémas :</h1>
    <div id="caroussel--full--arrow_">
        <?php foreach($cinemas as $cinema): ?>
        <img src="../public/images/<?= $cinema->getImage_url() ?>"/>
        <?php endforeach; ?>
    </div>
    <div class="front-bottom-wrapper">
        <div class="front-right-wrapper">
            <h1 style="margin-left:25px;">Films à l'affiche :</h1>
            <div id="caroussel--billboard_">
                <?php foreach($movies as $movie): ?>
                    <img class="front-fit-pic" src="../public/images/<?= $movie->getImage_poster() ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>