<head>
    <title>Séances</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/getSeances.js"></script>
    <style>
		#onglets{
			display: none;
            margin: auto;
            padding-right: 25px;
		}
		#onglets li{
			position: relative;
			float: left;
			list-style: none;
			padding: 2px 5px 7px;
			margin-right: 75px;
			cursor: pointer;
			color: #EF3535;
			z-index: 1;
		}
		#onglets .actif{
			border-bottom: 1px solid #EF3535;
			font-weight: bold;
			z-index: 10;
		}
		#contenu{
			clear: both;
			position: relative;
			margin: 0 20px;
			padding: 10px;
			z-index: 5;
			top: -6px;
			overflow: hidden;
			border-radius: 15px;
		}
	</style>
</head>

<main class="container" style="width:100%">

<?php 
if(isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<p style="width: 100%; background-color: #5aab5a40; color: #07750a; padding: 10px; margin: auto; text-align:center">' . urldecode($_GET['message']) . '</p>';
} 
?>

<div id="head-title">
    <h2 style="font-size:32px;">Séances</h2>
    <div class="quick-tools" style="margin-top:0; margin-right:25px;">
        <div id="space-icons" >
            <a title="Ajouter une séance" href="<?= cms\core\Helpers::getUrl('MovieSession','addSeance') ?>" class="fas fa-plus fa-lg"></a>
        </div>
    </div>
</div>
<div id="separation-bar"></div>

<div id="head-title">
    <ul id="onglets">
        <li class="actif">Recherchez une séance</li> 
        <li>Recherchez une reservation</li> 
    </ul>
</div>
<div id="separation-bar"></div>
<span class="separator"> </span>
<div id="contenu">
    <div id="seance-onglet" class="item">
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
                    <tr>
                        <td class="choise"></td>
                        <td width="310px;">
                            <input type=submit value="Rechercher une séance">
                            <input type=reset value="Reset">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <span class="separator"> </span>

        <div id="resultgetseance">

        </div>
    </div>
    <div class="item">
        <form method="post" id='getreservation'>
            <table class="selection-table">
                <tbody>
                    <tr>
                        <td class="choise" >Entrez l'adresse mail</td>
                        <td width="310px;">
                            <input type="email" name="email" id="email_input" placeholder="mail@gmail.com">
                        </td>
                    </tr>
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
                        <td class="choise">Sélectionnez la date</td>
                        <td width="310px;">
                            <input type="date" id='date_resa' min="<?php echo date("Y-m-d"); ?>"></input>
                        </td>
                    </tr>
                    <tr>
                        <td class="choise"></td>
                        <td width="310px;">
                            <input type=submit value="Rechercher la reservation">
                            <input type=reset value="Reset">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <span class="separator"> </span>

        <div id="resultgetreservation">

        </div>
    </div>
</div>
</main>