<section class="container">
<?php
    use cms\managers\CinemaManager;
    use cms\managers\MovieManager;
    use cms\managers\UserManager;

    $current_user = (new UserManager(User::class, 'user'))->read($_SESSION['userId']);

    $movieManager = new MovieManager(Movie::class, 'movie');
    $movies = $movieManager->read();

    $cinemaManager = new CinemaManager(Cinema::class, 'cinema');
    $cinemas = $cinemaManager->read();
?>
    <?php foreach ($data as $component): ?>
        <div class="col-sm-<?= $section->getSize() + 1 ?> col-md-5">
            <?php
                $this->addModal($component->getCategorie(), [
                    'movies' => $movies,
                    'cinemas' => $cinemas
                ]);
            ?>
        </div>
    <?php endforeach  ?>
    <?php for($i=count($data); $i <= $section->getSize(); $i++):?>
        <?php if(reset($current_user)->getAllow() >= 2): ?>
        <div class="center-btn-component">
            <button class="open-button" id="<?= $i ?>" onclick="openForm(this.id)">Ajout component</button>
        </div>
        <div class="form-popup" id="myForm_<?= $i ?>">
            <form action="" class="form-container" method="POST">
                <h1>Ajout component</h1>
            
                <div style="display: flex;
                justify-content: space-around;
                margin-bottom: 20px;">
                <label for="size"><b>Choix component :</b></label>
                <input type="hidden" name="section_id" value="<?= $section->getId() ?>">
                    <select type="select" name="categorie" required>
                        <option value="carousel-billboard">carousel-billboard</option>
                        <option value="carousel-full-arrow">carousel-full-arrow</option>
                    </select>
                </div>

                <button type="submit" class="btn">Valider</button>
                <button type="button" id="<?= $i ?>" class="btn cancel" onclick="closeForm(this.id)">Close</button>
            </form>
        </div>
        <?php endif; ?>
    <?php endfor;?>
</section>


