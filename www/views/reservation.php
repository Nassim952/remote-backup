<head>
    <title>Reservation</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2>Reservation</h2>
    </div>
    <div id="separation-bar"></div>
</br>
</br>
    <div><?php 
    echo 'Afin de valider votre réservation pour le film '.$datas['film'].', dans la salle '.$datas['salle'].' du cinema '.$datas['cinema'].' le '.$datas['seance'];
    ?>

    </div>
</br>
</br>
    <div id="separation-bar"></div>
</br>
</br>
    <div class=form-add>
        <?php $this->formView('configFormUser')?>
    </div>
</div>