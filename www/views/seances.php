<head>
    <title>Horraires</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/getSeances.js"></script>
</head>

<main class="container">

<div class="heading-banner">
    <h1 class="white">Horraires de vos diffusions</h1>
</div>
<span class="separator"> </span>
    <form method="post" id='getseance'>
        <table class="selection-table">
            <tbody>
                <tr>
                    <td class="choise" >Choissisez un cinema</td>
                    <td width="310px;">
                        <select name="cinema" id="cinema_select">
                        <option value="O">Selectionnez un cinema</option>
                        <?php foreach($cinemas as $cinema): ?>
                            <option value="<?= $cinema->getId() ?>"><?= $cinema->getName() ?></option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="choise" >Choissisez un film</td>
                    <td width="310px;">
                        <select name="movie" id="movie_select">
                        <option value="0">Selectionnez un film</option>
                        <?php foreach($movies as $movie): ?>
                            <option value="<?= $movie->getId() ?>"><?= $movie->getTitle() ?></option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="choise">Choissisez une periode</td>
                    <td width="310px;">
                        <input type="date" id='date_seance' min="<?php echo date("Y-m-d"); ?>"></input>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type=submit value="Rechercher une séance">
    </form>

    <span class="separator"> </span>

    <div id="result">

    </div>
</main>