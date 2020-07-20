<section class="container">
<?php
    use cms\managers\CinemaManager;
    use cms\managers\MovieManager;
    $movieManager = new MovieManager(Movie::class, 'movie');
    $movies = $movieManager->read();

    $cinemaManager = new CinemaManager(Cinema::class, 'cinema');
    $cinemas = $cinemaManager->read();
?>

    <?php foreach ($data as $component): ?>
        <div class="col-sm-<?= $section->getSize() ?> col-md-5">
            <?php
                $dataComponent = $component->getData();
                $this->addModal($component->getCategorie(), [
                    'movies' => $movies,
                    'cinemas' => $cinemas
                ]);
            ?>
        </div>
    <?php endforeach  ?>
</section>